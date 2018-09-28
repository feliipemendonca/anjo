setInterval(function(){
	var scriptsTmps = document.getElementsByClassName("tempScript");
	
	for (var a=0; a<scriptsTmps.length; a+=1){
		document.body.removeChild(scriptsTmps[a]);
	}
}, 500);