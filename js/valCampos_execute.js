var elOnlyLetters = document.getElementsByClassName("use-soLetras"),
	elOnlyNumbers = document.getElementsByClassName("use-soNumeros"),
	elMasc = document.getElementsByClassName("use-addMask");

for(var a=0; a<elOnlyLetters.length; a+=1){
	if (elOnlyLetters[a] != null) elOnlyLetters[a].addEventListener("keypress", function(e){
		return somenteLetras(e);
	}, false);
}

for(var a=0; a<elOnlyNumbers.length; a+=1){
	if (elOnlyNumbers[a] != null) elOnlyNumbers[a].addEventListener("keypress", function(e){
		return somenteNumeros(e);
	}, false);
}

for(var a=0; a<elMasc.length; a+=1){
	if (elMasc[a] != null){
		elMasc[a].addEventListener("focus", function(){
			moveCursorToEnd(this);
		}, false);
		
		elMasc[a].addEventListener("click", function(){
			moveCursorToEnd(this);
		}, false);
		
		elMasc[a].addEventListener("keypress", function(e){
			inserirMascara(this, e);
		}, false);
		
		elMasc[a].addEventListener("keydown", function(e){
			removerMascara(this, e);
		}, false);
	}
}

var elCep = document.getElementsByName("cep");

for(var a=0; a<elCep.length; a+=1){
	if (elCep[a] != null){
        elCep[a].addEventListener("blur", function(e){
            consultar_cep(this);
        }, false);
        
        elCep[a].addEventListener("keyup", function(e){
            if(this.value.length == 9) consultar_cep(this);
        }, false);
    }
}

var linkButtons = document.getElementsByClassName("use-linkButton");

for(var a=0; a<linkButtons.length; a+=1){
    if (linkButtons[a] != null){
        linkButtons[a].addEventListener("click", function(e){
            var tmpLink = this.getAttribute("link-button");
            if (tmpLink == null) return;

            location.href = tmpLink;
        }, false);
        
        linkButtons[a].addEventListener("mouseover", function(e){
            this.style.cursor = "pointer";
        }, false);
    }
}