<?php
    define ("quantMaxNotas", 15);
    
    function getTableNotasHeader($quantNotas=quantMaxNotas){
        $nome_prova = "Nota ";

        $strTable =
        "<tr>
            <td style=\"width:180px\">Id</td>
            <td style=\"width:180px\">Nome</td>";

        for ($a=0; $a<$quantNotas; $a+=1){
            $strTable .=
            "<td class=\"tb_td_nota\">" . $nome_prova . ($a+1) . "</td>";
        }
        
        $strTable .= "</tr>";
        
        return $strTable;
    }

    function getTableNotasBody($id_aluno, $nome_aluno, $notas=null /*["", "", "", ""]*/){
        if($notas == null){
            $notas = array();
            for($a=0; $a< quantMaxNotas; $a+=1){
                $notas[$a] = "";
            }
        }
        
        $attr = "type=\"text\" maxlength=\"4\" onkeypress=\"return somenteFloat(event, this);\" onfocus=\"salvarEnvioNotas(this);\" onblur=\"enviarNotas(this);\" style='width:60px; text-align:center'";
        
        $strTable =
        "<tr>
            <td>" . $id_aluno . "</td>
            <td>" . $nome_aluno . "</td>";

        for ($a=0; $a<count($notas); $a+=1){
            
            $strTable .=
            "<td class=\"tb_td_nota\">";
            
            if(isset($_SESSION['prof']) && isset($_SESSION["token"]) && (strpos($_SESSION["token"], "professorX2") == 0)){
                $strTable .= "<input value=\"" . $notas[$a] . "\" " . $attr . "tag=\"" . ($a+1) . "\" aluno=\"" . $nome_aluno . "-" . $id_aluno . "\" /></td>";
            }else{
                $strTable .= $notas[$a] . "</td>";
            }
        }
        $strTable .= "</tr>";

        return $strTable;
    }

    class notas{
        public $notas;
        public $dts_envio;
        public $media;
        public $mediaAtual;
        
        function __construct($aluno_id, $turma){
            global $mysqli;
            
            $this->notas = array();
            $this->dts_envio = array();
            $this->media = "-";
            $this->mediaAtual = "-";
            
            if(!isset($turma) || !isset($aluno_id)){
                echo "Erro!<br>Não autorizado!";
                return;
            }
            if(!isset($mysqli)) include "../config/config.php";
            
            $notasStr = "";
            for($a=0; $a < quantMaxNotas; $a+=1){
                $notasStr .= "n.nota" . ($a+1) . ", n.envio_nota" . ($a+1);
                
                if($a != quantMaxNotas -1) $notasStr .= ",\n\t      ";
            }
            
            $sql = "SELECT $notasStr FROM tb_notas n
                    JOIN tb_turma_aluno t ON t.idtb_turma_aluno = n.id_turma_aluno
                    JOIN tb_aluno a ON a.idtb_aluno = t.tb_aluno_idtb_aluno
                    WHERE a.idtb_aluno=$aluno_id AND t.tb_turma_idtb_turma=$turma";

            $query = mysqli_query($mysqli, $sql);
            
            if(mysqli_num_rows($query) == 0) return;
            $res = mysqli_fetch_assoc($query);
            
            for ($a=0; $a < quantMaxNotas; $a+=1){
                $this->notas[$a] = $res['nota' . ($a +1)];
                $this->dts_envio[$a] = $res['envio_nota' . ($a +1)];
            }
            
            /*
            $this->notas[0] = $res['nota1'];
            $this->notas[1] = $res['nota2'];
            $this->notas[2] = $res['nota3'];
            $this->notas[3] = $res['nota4'];
            
            $this->dts_envio[0] = $res['envio_nota1'];
            $this->dts_envio[1] = $res['envio_nota2'];
            $this->dts_envio[2] = $res['envio_nota3'];
            $this->dts_envio[3] = $res['envio_nota4'];
            */
            
            for($a=0; $a<count($this->dts_envio); $a+=1){
                $tmpDt = $this->dts_envio[$a];
                
                if($tmpDt == "" || $tmpDt == "null") $this->dts_envio[$a] = "-";
                else{
                    $tmpDt = new DateTime($tmpDt);
                    $tmpDt = $tmpDt->format('d/m/Y');
                    
                    $this->dts_envio[$a] = $tmpDt;
                }
            }
            
            $soma = 0;
            foreach($this->notas as $n){
                $soma += $n;
            }
            
            if (count($this->notas) > 0) $this->media = number_format(($soma / count($this->notas)), 2);
            else $this->media = "-";
            
            $notasStr = "";
            for($a=0; $a < quantMaxNotas; $a+=1){
                $notasStr .= "max(n.envio_nota" . ($a+1) . ") AS envio_nota" . ($a+1);
                
                if($a != quantMaxNotas -1) $notasStr .= ",\n\t      ";
            }
            
            $sql = "SELECT $notasStr FROM tb_notas n
                    JOIN tb_turma_aluno t ON t.idtb_turma_aluno = n.id_turma_aluno
                    JOIN tb_aluno a ON a.idtb_aluno = t.tb_aluno_idtb_aluno
                    WHERE t.tb_turma_idtb_turma=$turma";
            
            $query = mysqli_query($mysqli, $sql);
            if(!$query) return;
            
            $res = mysqli_fetch_assoc($query);
            
            $m = 0;
            
            /*
            if($res["envio_nota1"] == null) $m = 0;
            else if($res["envio_nota2"] == null) $m = 1;
            else if($res["envio_nota3"] == null) $m = 2;
            else if($res["envio_nota4"] == null) $m = 3;
            else $m = 4;
            */
            
            for ($a=0; $a < quantMaxNotas; $a+=1){
                if($res['envio_nota' . ($a +1)] == null){
                    $m = $a;
                    break;
                }else if($a == quantMaxNotas -1) $m = quantMaxNotas;
            }
            
            if ($m > 0) $this->mediaAtual = number_format(($soma / $m), 2);
            else $this->mediaAtual = "-";
        }
    }