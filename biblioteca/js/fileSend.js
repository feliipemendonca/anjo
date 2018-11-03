var sel_grupos = document.getElementById("sel_grupos");
			
function show_hiddenSelectIcone(a=""){
    var el_div = document.getElementById("div_iconsArquivo");

    if(a != ""){
        if (a == "block" )el_div.style.display = a;
        else{
            if(el_div.style.display != "none"){
                el_div.style.display = "none";
                el_div.className = "hidde_animation";
                
                setTimeout(function(){
                    el_div.style.display = "block";
                }, 10);
            }
        }

        return;
    }

    if (el_div.style.display == "none") el_div.style.display = "block";
    else{
        el_div.style.display = "none";
        el_div.className = "hidde_animation";
        
        setTimeout(function(){
            el_div.style.display = "block";
        }, 10);
    }
}

function selecionarIcone(a){
    var el_img = document.getElementById("select_img_icon"),
        el_inpt = document.getElementsByName("icone")[0];

    if(a > icones.length || el_img.src == "icones/" + icones[a] + "_icon.png") return;

    createAnimationChangeIcon(el_img.src);
    el_img.style.display = "none";
    setTimeout(function(){
        el_img.style.display = "block";
    }, 10);
    el_img.src = "icones/" + icones[a] + "_icon.png";
    show_hiddenSelectIcone("none");
    el_inpt.value = icones[a];
}

function selecionarIconeByName(a){
    var b=icones.indexOf(a);
    if(b == -1) return;

    selecionarIcone(b);
}

function checkFiles(el){
    var arqs = el.files;

    if(arqs.length ==0){
        selecionarIcone(0);
        alert("Nenhum arquivo selecionado!");
        return;
    }
    
    switch(arqs[0].type){
        case "image/jpeg":
        case "image/jpg":
        case "image/png":
        case "image/gif":
            selecionarIconeByName("img");
            break;
        case "application/pdf":
            selecionarIconeByName("pdf");
            break;
        case "txt":
            selecionarIconeByName("txt");
            break;
        default:
            var tmpName = arqs[0].name,
                tmpFind = tmpName.lastIndexOf(".");

            if(tmpFind > -1){
                var passouNoIf = false;
                switch(tmpName.substring(tmpFind+1)){
                    case "ppt":
                    case "pptx":
                        selecionarIconeByName("ppt");
                        passouNoIf = true;
                        break;
                    case "xls":
                    case "xlsx":
                        selecionarIconeByName("xls");
                        passouNoIf = true;
                        break;
                    case "doc":
                    case "docx":
                        selecionarIconeByName("doc");
                        passouNoIf = true;
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
                        selecionarIconeByName("code");
                        passouNoIf = true;
                        break;
                }

                if(passouNoIf) break;
            }

            selecionarIconeByName("noneType");
            break;
    }
    
    //novoArquivo();
}

function novoArquivo(){
    var el = document.getElementById("div_sendFiles"),
        els = el.children;
    
    var a = els[els.length-1].id;
    a = a.substring(a.indexOf("-") + 1);
    a = parseInt(a) + 1;
    
    var el2 = document.createElement("div");
    el2.id = "div_sendFile-" + a;
    
    el2.innerHTML = "<input type=\"button\" onClick=\"adicionarArquivo(" + a + ");\" value=\"Anexar arquivo\" />";
    el2.innerHTML += "<input id=\"inpt_nFile-" + a + "\" type=\"text\" name=\"arquivosNomes[]\" placeholder=\"Nome do arquivo\" />";
    el2.innerHTML += "<input type=\"button\" class=\"bt_removerArquivo\" onClick=\"removerArquivo(" + a + ");\" value=\"x\" />";
    el2.innerHTML += "<input id=\"inpt_file-" + a + "\" type=\"file\" name=\"arquivos[]\" onchange=\"checkFiles(this);\" />";
    
    el.appendChild(el2);
}

function adicionarArquivo(i){
    var el = document.getElementById("inpt_file-" + i);
    
    el.click();
}

function removerArquivo(i){
    var el = document.getElementById("div_sendFiles"),
        el2 = document.getElementById("div_sendFile-" + i);
    
    if(el.children.length > 1) el.removeChild(el2);
    else alert("Não foi possivel excluir!\nÉ necessário escolher pelo menos um arquivo!");
}

function selecionarGrupo(){
    var inpt_titulo = document.getElementsByName("titulo")[0],
        inpt_descricao = document.getElementsByName("descricao")[0],
        inpt_pasta = document.getElementsByName("pasta")[0];

    var gp_selecionado = sel_grupos.selectedIndex;
    if (gp_selecionado == gp_titulos.length || sel_grupos[gp_selecionado].value == -1){
        inpt_titulo.value = "";
        inpt_descricao.value = "";
        inpt_pasta.value = "";

        inpt_titulo.readOnly = false;
        inpt_descricao.readOnly = false;
        //inpt_pasta.readOnly = false;
    }else{
        inpt_titulo.value = gp_titulos[gp_selecionado];
        inpt_descricao.value = gp_descricoes[gp_selecionado];
        inpt_pasta.value = gp_pastas[gp_selecionado];;

        inpt_titulo.readOnly = true;
        inpt_descricao.readOnly = true;
        inpt_pasta.readOnly = true;
    }
}