<?php
    if(!isset($mysqli)) include "../config/config.php";

    class presencas {
        private $mysqli;
        
        public $aluno_id;
        
        public $total;
        public $total_presencas;
        public $total_faltas;
        public $porPresencas;
        public $porFaltas;

        function __construct($aluno_id, $turma){
            global $mysqli;
            
            $this->aluno_id = $aluno_id;

            $this->total = 0;
            $this->total_presencas = 0;
            $this->total_faltas = 0;

            $this->porPresencas = 0;
            $this->porFaltas = 0;
            
            if(!isset($turma) || !isset($aluno_id)){
                echo "Erro!<br>Não autorizado!";
                return;
            }

            $sql = "SELECT count(id) as total FROM tb_presenca
                    WHERE id_turma=$turma";
            $query = mysqli_query($mysqli, $sql);
            if(!$query){
                echo "Não foi possivel obter o total das presenças!";
                return;
            }

            $this->total = mysqli_fetch_assoc($query)["total"];

            $sql = "SELECT alunos_id, presencas FROM tb_presenca
                    WHERE (alunos_id LIKE '%$aluno_id,%' OR alunos_id LIKE '%,$aluno_id' OR alunos_id LIKE '$aluno_id') AND id_turma=$turma";
            $query = mysqli_query($mysqli, $sql);
            if(!$query){
                echo "Não foi possivel obter as presenças do aluno!";
                return;
            }

            $total_aluno = mysqli_num_rows($query);

            if($total_aluno == 0){
                echo "Nenhum aluno encontrado!";
                return;
            }

            while($res = mysqli_fetch_assoc($query)){
                $alunos=$res["alunos_id"];
                $presencas=$res["presencas"];
                
                $alunos = explode(",", $alunos);
                $presencas = explode(",", $presencas);
                
                if(count($alunos) == count($presencas)){
                    $findAluno = array_search($aluno_id, $alunos);
                    
                    $this->total_presencas += ($presencas[$findAluno]=="1") ? 1 : 0;
                }else{
                    echo "Desculpe, mas por algum motivo estranho, os alunos não conferem com as presenças!";
                    return;
                }
            }

            $this->total_faltas = $this->total - $this->total_presencas;

            $this->porPresencas = ($this->total_presencas * 100 / $this->total);
            $this->porFaltas = ($this->total_faltas * 100 / $this->total);
            
            $this->porPresencas = number_format($this->porPresencas, 2, ".", "") . "%";
            $this->porFaltas = number_format($this->porFaltas, 2, ".", "") . "%";
        }
    }