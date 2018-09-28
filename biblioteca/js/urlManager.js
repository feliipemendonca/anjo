function getTmpUrl(data64, t){
    var bytesCaracters = atob(data64);
    var tam = bytesCaracters.length;
    var bytesNumbers = new Array(tam);

    for (var a=0; a<tam; a+=1){
        bytesNumbers[a] = bytesCaracters.charCodeAt(a);
    }

    var bytesArray = new Uint8Array(bytesNumbers);

    var	blob = new Blob([bytesArray], {type: t}),
        url = URL.createObjectURL(blob);

    return url;
}