<!DOCYTPE html>
<html>
	<head>
		<title>Galeria cursos</title>
		<link media="screen" rel="stylesheet" type="text/css" href="index.css" />
        <meta charset="utf-8" />
	</head>
	<body>
		<div id="div_background" style="display: none;" onclick="hideAlbum();">
			<button onclick="hideAlbum();">Fechar</button>
		</div>
		<?php
			include "../config/config.php";
			include "config_imgs.php";
			
			if (!file_exists($pasta)) die("O curso não possui nenhum album de imagens!");
			
			$album_content = file_get_contents($album);
			$albuns = explode("\n", $album_content);
			$antDiv = 0;
			$totalImg = 0;
			$info_album = array();
			for ($a=1; $a<count($albuns); $a+=1){
				if ($albuns[$a] == ""){
					die("O curso não possui imagens!");
					return;
				}
				
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
				}
			}
			if ($antDiv > 0) $info_album[] = $totalImg . " Fotos";
		?></div>
		
		<script class="tempScript">
			var els = document.getElementsByClassName("album_curso"),
				infos = "<?php echo implode(",", $info_album) ?>".split(",");
				
			for(var a=0; a<infos.length; a+=1){
				var el = document.createElement("h4");
				el.innerHTML = infos[a];
				els[a].getElementsByTagName("div")[0].appendChild(el);
			}
		</script>
		<script src="js/album_script.js"></script>
		<script class="tempScript" src="../js/apagar_scripts.js"></script>
	</body>
</html>