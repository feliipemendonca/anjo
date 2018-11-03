<!DOCYTPE html>
<html>
	<head>
		<title>Galeria cursos - admin</title>
		<link media="screen" rel="stylesheet" type="text/css" href="index.css" />
        <meta charset="utf-8" />
	</head>
	<body>
		<?php
			session_start();
            if(@$_GET["redirect"] && !isset($_SESSION["admin"])){
                session_destroy();
                header("refresh: 0");
                exit();
            }
            
			if (!isset($_SESSION['idtb_login'])){ ?>
				<iframe src="../adm/" style="width:100%; height: 100%; border: 0;" onload="check_login(this)" ></iframe>
				<div id="div_redirect_wait" style="display: none;">
					<span></span>
				</div>
				<script>
					function check_login(el) {
						var win = el.contentWindow,
							doc = el.contentDocument,
							form = doc.getElementsByTagName('form')[0],
							form2 = doc.getElementsByTagName('form')[1];
							
						if(form == null){
							document.body.removeChild(el);
							refresh_wait();
						}else{
							form.removeChild(form.ownerDocument.getElementsByName("professor")[0]);
							form.removeChild(form.ownerDocument.getElementsByName("aluno")[0]);
							
							form.innerHTML = form.innerHTML.replace("Professor", "");
							form.innerHTML = form.innerHTML.replace("Aluno", "");
							
							form.ownerDocument.getElementsByName("adm")[0].checked = true;
							
							if(form2 != null) form2.parentElement.removeChild(form2);
						}
					}
					
					var wait_seconds = 5;
					
					function refresh_wait(){
                        if(wait_seconds == 0){
                            location.href = "?redirect=";
                            return;
                        }
                        
						var el = document.getElementById("div_redirect_wait"),
							span = el.getElementsByTagName("span")[0];
							
						if (el.style.display == "none") el.style.display = "block";
						
						span.innerHTML = "Redirecionando em ${wait}".replace("${wait}", wait_seconds);
						wait_seconds -= 1;
						
						setTimeout("refresh_wait()", 1000);
					}
				</script>
		<?php
			exit();
		}
		?>
        <button class="div_background" id="bt_fecharBackground" style="display: none;" onclick="hideAlbum();">Fechar</button>
		<div class="div_background" id="div_background" style="display: none;" onclick="hideAlbum();"></div>
		<?php
			include "../config/config.php";
            include "../adm/checkSession.php";
			include "config_imgs.php";
			
			if(((@$album_nome = $_POST["enviarImagem"]) || (@$newAlbum = $_POST["novoAlbum"])) && (@$imagens = $_FILES["imgs_post"]) && !empty($res["curso"])){
				if (!file_exists($pasta)){
					mkdir($pasta);
					touch($album);
					file_put_contents($album, "Albuns do curso: " . $res["curso"] . "\n");
				}
				
				if(!file_exists($album)) die("Erro ao criar arquivo de definição dos albuns!");
				
				$strContent = file_get_contents($album);
				
				$inicioStr = "";
				$tmpStr = "";
				$finalStr = "";
				if(isset($album_nome)){
					$inicioStr = substr($strContent, 0, strpos($strContent, "\n[" . $album_nome . "]") + 1);
					$tmpStr = substr($strContent, strpos($strContent, "[" . $album_nome . "]"));
					
					$tmpPos = strpos($tmpStr, "\n[");
					if(!$tmpPos) $tmpPos = strlen($tmpStr);
					
					$finalStr = substr($tmpStr, $tmpPos) . "";
					$tmpStr = substr($tmpStr, 0, $tmpPos);
				}else if (isset($newAlbum)){
					$inicioStr = $strContent;
					$tmpStr = "\n[" . $newAlbum . "]";
					$finalStr = "";
				}else{
					die("Erro!<br>Nome do album não expecificado!");
				}
				
				$erros = array();
				for($a=0; $a<count($imagens["name"]); $a+=1){
                    if($imagens["name"])
					$tmpName = genFileName($pasta);
					if(move_uploaded_file($imagens["tmp_name"][$a], $pasta . "/" . $tmpName)) $tmpStr .= "\n" . $tmpName;
					else $erros[] = $imagens["name"][$a];
				}
				
				file_put_contents($album, $inicioStr . $tmpStr . $finalStr);
				
				if(count($erros) > 0){
					?>
					<script>
						alert("Ocorreu alguns erros ao tentar enviar esses arquivos: <?php echo implode("; ", $erros); ?>");
					</script>
					<?php
				}
			}
			
			$album_content = file_exists($pasta) ? file_get_contents($album) : "";
			$albuns = explode("\n", $album_content);
			$antDiv = 0;
			$totalImg = 0;
			$quant_fotos = 0;
			$info_album = array();
            
			for ($a=2; $a<count($albuns); $a+=1){
				if ($albuns[$a] == "") return;
				$albuns[$a] = str_replace("\r", "", $albuns[$a]);
				
				if(strpos($albuns[$a], "[") === 0) {
					if ($antDiv > 0){
						$info_album[] = $totalImg . " Fotos";
						echo "</div>";
					}
					
					$albuns[$a] = str_replace("[", "", $albuns[$a]);
					$albuns[$a] = str_replace("]", "", $albuns[$a]);
					$antDiv += 1;
					?>
					<div class="album_curso" id="album_<?php echo $res["curso"] . "_$antDiv"; ?>" onclick="showAlbum(this);">
						<div><h3>Album <?php echo $albuns[$a]; ?></h3></div>
					<?php
					$totalImg = 0;
				}else{
					?>
					<img src="<?php echo $pasta . "/" . $albuns[$a]; ?>" type="image/jpeg" style="z-index:<?php echo $totalImg*-1 . ";"; if ($totalImg < 3) echo "margin-left:" . $totalImg*35 . "px;transform:rotateZ(" . -$totalImg*20 . "deg);"; else echo "display:none;" ?>" onclick="showImage(this);" />
					<?php
					$totalImg += 1;
					$quant_fotos += 1;
				}
			}
			if ($antDiv > 0) $info_album[] = $totalImg . " Fotos";
		if(count($albuns) > 1 || $albuns[0] != ""){
            echo "</div>";
        }?>
		
		<script class="tempScript">
			var els = document.getElementsByClassName("album_curso"),
				infos = "<?php echo implode(",", $info_album) ?>".split(",");
            
            if (infos.length == 1 && infos[0] == ""){
                if (els.length == 0) els = [];
                infos = [];
            }
            
			for(var a=0; a<infos.length; a+=1){
				var el = document.createElement("h4"),
					el2 = document.createElement("form");
					
				el.innerHTML = infos[a];
				els[a].getElementsByTagName("div")[0].appendChild(el);
				
				el2.enctype = "multipart/form-data";
				el2.method = "POST";
				
				el = document.createElement("input");
				el.type = "hidden";
				el.name = "enviarImagem";
				el.value = els[a].getElementsByTagName("div")[0].getElementsByTagName("h3")[0].innerHTML.replace("Album ", "");
				
				el2.appendChild(el);
				
				el = document.createElement("input");
				el.type = "file";
				el.style.display = "none";
				el.accept = "image/jpeg";
				el.multiple = "true";
				el.id = "imgs_post" + (parseInt(a)+1);
				el.name = "imgs_post[]";
				el.onchange = function(){
					enviarImagens(this, <?php echo $quant_fotos; ?>);
				};
				el2.appendChild(el);
				
				el = document.createElement("label");
				el.htmlFor = "imgs_post" + (parseInt(a)+1);
				el.innerHTML = "<img src='img/add_icon.png' />";
				el.style.display = "none";
				el2.appendChild(el);
				
				els[a].appendChild(el2);
				
				el = null;
				el2 = null;
				els[a] = null;
			}
			infos = null;
			
			var el = document.createElement("div");
			el.className = "album_curso";
			el.id = "newAlbum";
			el.innerHTML = "<div><h3>Novo Album</h3></div><form enctype=\"multipart/form-data\" method=\"post\"><input name=\"novoAlbum\" type=\"hidden\" value=\"\"><input name=\"imgs_post[]\" style=\"display: none;\" type=\"file\" accept=\"image/jpeg\" multiple><img src=\"img/add_icon.png\"></form>";
			el.onclick = function(){
				var inpt_album = this.getElementsByTagName("input")[0],
					inpt_imgs = this.getElementsByTagName("input")[1];
					
				var a = prompt("Informe o nome do album: ");
				
				if(a == null || a == ""){
					alert("O nome do album não pode estar em branco");
					return;
				}
				
				inpt_album.value = a;
				
				inpt_imgs.onchange = function (){
					enviarImagens(this, <?php echo $quant_fotos; ?>);
				};
				
				var e = new MouseEvent("click");
				inpt_imgs.dispatchEvent(e);
			};
			
			document.body.appendChild(el);
			el = null;
		</script>
		<script>
			function showAddImagem(el){
				var el2 = el.getElementsByTagName("label");
				
				if(el2[0] != null) el2[0].style.display = "block";
			}
			
			function hideAddImagem(el){
				var el2 = el.getElementsByTagName("label");
				
				if(el2[0] != null) el2[0].style.display = "none";
			}
		</script>
		<script src="js/envio_script.js"></script>
		<script src="js/album_script.js"></script>
		<script class="tempScript" src="../js/apagar_scripts.js"></script>
	</body>
</html>