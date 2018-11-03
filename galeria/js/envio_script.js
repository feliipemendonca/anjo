function enviarImagens(el, quant_fotos){
	var arqs = el.files,
		arq_validos = [];

	if(arqs.length == 0){
		alert("Selecione um arquivo!");
		return;
	}else if(arqs.length > (20 - quant_fotos)){
		alert("Desculpe, mas só pode enviar 20 fotos por curso.\nO curso já tem: " + quant_fotos + "\nVocê enviou: " + arqs.length + "!");
		return;
	}

	var imgs_icompativeis = 0,
		imgs_pesadas = 0;

	for(var a=0; a<arqs.length; a+=1){
		if (arqs[a].type == "image/jpeg" || arqs[a].type == "image/png"){
			if (arqs[a].size > 5000000) imgs_pesadas += 1;
			else arq_validos[a] = arqs[a];
		}else imgs_icompativeis += 1;
	}

	if(imgs_icompativeis > 0) alert("Algumas imagens não foram enviadas, pois são icompativeis.\nCertifique de ser jpeg, jpg ou png");
	else if(imgs_pesadas > 0) alert("Algumas imagens não foram enviadas, pois são grandes demais.\nCertifique de ser menor que 5 MB");

	if(arq_validos.length == 0) return;
	el.parentElement.submit();
}