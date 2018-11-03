var album_ativo = null,
	img_ativa = null,
	div_back = document.getElementsByClassName("div_background");

function showAlbum(el){
	hideAlbum();
    
    for(var a=0; a<div_back.length; a+=1) div_back[a].style.display = "block";
	
	el.onclick = null;
	el.className = "album_curso album_active";
	album_ativo = el;
	
	var img = el.getElementsByTagName("img")[0];
	if(img != null) showImage(img);
	
	if(typeof showAddImagem != "undefined") showAddImagem(el);
}

function hideAlbum(){
	if (album_ativo != null){
		album_ativo.className = "album_curso";
		album_ativo.onclick = function (){
			showAlbum(this);
		}
		
		if(typeof hideAddImagem != "undefined") hideAddImagem(album_ativo);
	}
	album_ativo = null;
	
	for(var a=0; a<div_back.length; a+=1) div_back[a].style.display = "none";
}

function showImage(el){
	if(album_ativo == null || el.parentElement != album_ativo) return;
	
	if (img_ativa == el){
		hideImage();
		return;
	}
	
	hideImage();
	
	el.className = "album_img_active";
	img_ativa = el;
}

function hideImage(){
	if (img_ativa != null) img_ativa.className = "";
	img_ativa = null;
}