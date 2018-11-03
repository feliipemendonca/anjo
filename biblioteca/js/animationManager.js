function createEventListener(el, type, f){
    if (el == null) return;
    
    var prefixos = ["-webkit-", "-moz-", "-o-"];
    
    for(var a=0; a<prefixos.length; a+=1){
        var tmpType = prefixos[a] + type;
        if (el.style[tmpType] !== undefined){
            el.addEventListener(tmpType, f);
            return;
        }
    }
    
    el.addEventListener(type, f);
}

function createAnimationChangeIcon(curImg){
    var animChangeIcon_style = document.getElementById("animChangeIcon_style");
    
    var tmpAnim_style = "@-webkit-keyframes anim_iconChange{";
    tmpAnim_style +=        "0%{opacity: 0.2; background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";

    tmpAnim_style +=        "99%{background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";
    tmpAnim_style +=        "100%{opacity: 1;}";
    tmpAnim_style +=    "}";

    tmpAnim_style +=    "@-moz-keyframes anim_iconChange{";
    tmpAnim_style +=        "0%{opacity: 0.2; background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";

    tmpAnim_style +=        "99%{background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";
    tmpAnim_style +=        "100%{opacity: 1;}";
    tmpAnim_style +=    "}";

    tmpAnim_style +=    "@-o-keyframes anim_iconChange{";
    tmpAnim_style +=        "0%{opacity: 0.2; background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";

    tmpAnim_style +=        "99%{background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";
    tmpAnim_style +=        "100%{opacity: 1;}";
    tmpAnim_style +=    "}";

    tmpAnim_style +=    "@keyframes anim_iconChange{";
    tmpAnim_style +=        "0%{opacity: 0.2; background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";

    tmpAnim_style +=        "99%{background: url('" + curImg + "') no-repeat; -moz-box-sizing: border-box; box-sizing: border-box;}";
    tmpAnim_style +=        "100%{opacity: 1;}";
    tmpAnim_style +=    "}";
    
    
    animChangeIcon_style.innerHTML = tmpAnim_style;
}