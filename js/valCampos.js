function getElementsByNameFromForm(f, el){
    if(f == null || f.nodeName != "FORM") return null;
    var fDoc = f.ownerDocument;
    
    var element = fDoc.getElementsByName(el);
    var els = [];
    
    for(var a=0; a<element.length; a+=1){
        if (element[a].form == f) els.push(element[a]);
    }
    
    return els;
}

function validarCampos(f){
    try{
        if(f == null || f.nodeName != "FORM") return false;

        //var fDoc = f.ownerDocument;

        var inpt_nome = getElementsByNameFromForm(f, "nome")[0], //fDoc.getElementsByName("nome")[0],
            inpt_cpf = getElementsByNameFromForm(f, "cpf")[0], //fDoc.getElementsByName("cpf")[0],
            inpt_rg = getElementsByNameFromForm(f, "rg")[0], //fDoc.getElementsByName("rg")[0],
            inpt_tel1 = getElementsByNameFromForm(f, "tel1")[0],//fDoc.getElementsByName("tel1")[0],
            inpt_tel2 = getElementsByNameFromForm(f, "tel2")[0],//fDoc.getElementsByName("tel2")[0],
            inpt_email = getElementsByNameFromForm(f, "email")[0],//fDoc.getElementsByName("email")[0],
            inpt_cemail = getElementsByNameFromForm(f, "c_email")[0],//fDoc.getElementsByName("c_email")[0],
            inpt_senha = getElementsByNameFromForm(f, "senha")[0] || getElementsByNameFromForm(f, "senha_prof")[0],//fDoc.getElementsByName("senha")[0] || fDoc.getElementsByName("senha_prof")[0],
            inpt_csenha = getElementsByNameFromForm(f, "csenha")[0] || getElementsByNameFromForm(f, "csenha_prof")[0];//fDoc.getElementsByName("csenha")[0] || fDoc.getElementsByName("csenha_prof")[0];

        if(inpt_nome != null){
            var str = inpt_nome.value;

            if(str.indexOf(" ") <= 1 || str == "" || str.length < 3){
                inpt_nome.focus();
                alert("Informe um nome completo válido!");
                inpt_nome.focus();
                return false;
            }
        }

        if(inpt_cpf != null){
            var str = inpt_cpf.value;

            if(str == "" || str.length != 14){
                inpt_cpf.focus();
                alert("Informe um CPF válido!");
                inpt_cpf.focus();
                return false;
            }
        }

        if(inpt_rg != null){
            var str = inpt_rg.value;

            if(str == ""){
                inpt_rg.focus();
                alert("Informe um RG válido!");
                inpt_rg.focus();
                return false;
            }
        }

        if(inpt_tel1 != null){
            var str = inpt_tel1.value;

            if(str == "" || str.length != 16){
                inpt_tel1.focus();
                alert("Informe um número de celular válido!");
                inpt_tel1.focus();
                return false;
            }
        }

        if(inpt_tel2 != null){
            var str = inpt_tel2.value;

            if(str == "" || str.length != 14){
                inpt_tel2.focus();
                alert("Informe um número de telefone válido!");
                inpt_tel2.focus();
                return false;
            }
        }

        if(inpt_email != null){
            var str = inpt_email.value;

            if(str == "" || str.indexOf("@") <= 0 || str.length < 3){
                inpt_email.focus();
                alert("Informe um e-mail válido!");
                inpt_email.focus();
                return false;
            }
        }

        if(inpt_cemail != null){
            if(inpt_email == null) return false;

            if(inpt_email.value != inpt_cemail.value){
                inpt_cemail.focus();
                alert("Confirme seu e-mail corretamente!");
                inpt_cemail.focus();
                return false;
            }
        }

        if(inpt_senha != null){
            var str = inpt_senha.value;

            if(str == "" || str.length < 6  || str.length > 12){
                inpt_senha.focus();
                alert("Informe uma senha válida!\nA senha deve conter no minimo 6 e no máximo 12!");
                inpt_senha.focus();
                return false;
            }
        }

        if(inpt_csenha != null){
            if(inpt_senha == null) return false;

            if(inpt_senha.value != inpt_csenha.value){
                inpt_csenha.focus();
                alert("Confirme sua senha corretamente!");
                inpt_csenha.focus();
                return false;
            }
        }

        return true;
    }catch(error){
        return false;
    }
}

function moveCursorToEnd(el){
    el.selectionStart = el.selectionEnd = el.value.length;
}

function mascara(el){
	var mascaraStr;
	
	switch(el.name){
		case "cpf":
			mascaraStr = "###.###.###-##";
			break;
		case "tel1":
            mascaraStr = "(##) 9 ####-####";
            break;
		case "tel2":
            mascaraStr = "(##) ####-####";
			break;
		case "cep":
			mascaraStr = "#####-###";
			break;
	}
	return mascaraStr;
}

function inserirMascara(el, e){
    moveCursorToEnd(el);
    
	var tam = el.value.length,
		mascaraStr = mascara(el);
	
	if(tam < mascaraStr.length){
		for(var i=tam; mascaraStr[i] != "#"; i+=1){
			el.value += mascaraStr[i];
		}
	}else{
        e.preventDefault();
        return false;
    }
}

function removerMascara(el, e){
    moveCursorToEnd(el);
    
	var tecla=(window.event)?event.keyCode:e.which,
		mascaraStr = mascara(el),
		tam = el.value.length;
	
	if(tecla==8){
		if(tam > 0){
			for(var i=tam-1; mascaraStr[i-1] != "#" && i>0; i-=1){
				el.value = el.value.substr(0, i);
			}
		}
	}
}

function somenteLetras(e){
	var tecla=(window.event)?event.keyCode:e.which;
	if((tecla>47 && tecla<58)){
		e.preventDefault();
        return false;
	}else{
		return true;
	}
}

function somenteNumeros(e){
	var tecla=(window.event)?event.keyCode:e.which;
	if((tecla>47 && tecla<58)){
		return true;
	}else{
        e.preventDefault();
		return false;
	}
}

function somenteFloat(e, el){
    var tecla = (window.event)?event.keyCode:e.which;
    if((tecla > 47 && tecla < 58)){
        var a = parseFloat(el.value + String.fromCharCode(tecla));

        if (a > 10){
            if (el.value.indexOf(".") == -1 && el.value.indexOf(",") == -1){
                el.value += ".";
                return true;
            }

            return false;
        }

        if(a == 10){
            el.value = "10.0"
            return false;
        }

        return true;
    }else if(tecla==46 && (el.value.indexOf(".") == -1 && el.value.indexOf(",") == -1)){
        return true;
    }else{
        return false;
    }
}

function consultar_cep(el, url1="/consultar_cep.php"){
    if(el == null) return;
    
	var cep = el.value;
    cep = cep.replace("-", "");
	if(cep.length == 8){
		//erro.style.display = 'none';
		//progresso_cep.style.display = 'block';
        
        //A URL APONTA PARA O ARQUIVO CONSULTAR_CEP.PHP NA RAIZ DO SITE
		$.ajax({
			url : url1,
			type : 'POST',
			data: 'cep=' + cep,
			dataType: 'json',
			async:false,
			cache:false,
			success: function(data){
                var tmpForm = el.form;
                if(tmpForm != null){
                    console.log(data);
                    if(data.resultado == 1){
                        var tmpEl = getElementsByNameFromForm(tmpForm, "endereco")[0];
                        if (tmpEl != null) tmpEl.value = data.tipo_logradouro + " " + data.logradouro;
                        
                        tmpEl = getElementsByNameFromForm(tmpForm, "cidade")[0];
                        if (tmpEl != null) tmpEl.value = data.cidade;
                        
                        tmpEl = getElementsByNameFromForm(tmpForm, "bairro")[0];
                        if (tmpEl != null) tmpEl.value = data.bairro;
                        
                        tmpEl = getElementsByNameFromForm(tmpForm, "estado")[0];
                        if (tmpEl != null) tmpEl.value = data.estado;
                        
                        tmpEl = getElementsByNameFromForm(tmpForm, "numero")[0];
                        if (tmpEl != null) tmpEl.focus();
                    }
                }
            }
		});
	}
}