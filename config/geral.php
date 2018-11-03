<?php
	function getToken($lenToken = 15){
		$tmp=array_merge(range("A", "Z"), range(0, 9));
		
		$token = "";
		
		for($a=0; $a<=$lenToken; $a+=1){
			$token .= $tmp[rand(0, count($tmp)-1)];
		}
		
		return $token;
	}

    function getTipoIcones(){
        return ["noneType", "pdf", "ppt", "xls", "doc", "txt", "img", "code"];
    }

    function getTipoEncontrado($arquivo, $tipos_icones){
        $tipoEncontrado = "";
        
        switch(substr($arquivo, strrpos($arquivo, ".")+1)){
            case "jpeg":
            case "jpg":
            case "png":
            case "gif":
                $tipoEncontrado = $tipos_icones[array_search("img", $tipos_icones)];
                break;
            case "pdf":
                $tipoEncontrado = $tipos_icones[array_search("pdf", $tipos_icones)];
                break;
            case "ppt":
            case "pptx":
                $tipoEncontrado = $tipos_icones[array_search("ppt", $tipos_icones)];
                break;
            case "xls":
            case "xlsx":
                $tipoEncontrado = $tipos_icones[array_search("xls", $tipos_icones)];
                break;
            case "doc":
            case "docx":
                $tipoEncontrado = $tipos_icones[array_search("doc", $tipos_icones)];
                break;
            case "txt":
                $tipoEncontrado = $tipos_icones[array_search("txt", $tipos_icones)];
                break;
            case "js":
            case "css":
            case "html":
            case "htm":
            case "php":
            case "c":
            case "h":
            case "cs":
            case "cpp":
            case "java":
            case "py":
                $tipoEncontrado = $tipos_icones[array_search("code", $tipos_icones)];
                break;
            default:
                $tipoEncontrado = $tipos_icones[array_search("noneType", $tipos_icones)];
        }
        
        return $tipoEncontrado;
    }

    function arquivoNaoLido(){
        ?><p id='erroArquivo'>Desculpe não foi possivel gerar a previsualização desse arquivo!</p><?php
    }
    
    function downloadFile($arquivo, $downRate=20.5){
        if(file_exists($arquivo) && is_file($arquivo))
        {
            header('Cache-control: private');
            header('Content-Type: application/octet-stream');
            header('Content-Length: '.filesize($arquivo));
            header('Content-Disposition: attachment; filename=' . substr($arquivo, strrpos($arquivo, "/") + 1));
            header('Content-Transfer-Encoding: binary');

            flush();
            $f = fopen($arquivo, "r");
            while(!feof($f))
            {
                print fread($f, round($downRate * 1024));
                flush();
                
                sleep(1);
            }
            fclose($f);
        }else {
            ?>
            <script>
                alert("Erro!\nArquivo não encontrado!");
            </script>
            <?php
        }
        exit();
    }
?>