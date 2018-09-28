var UA = navigator.userAgent,
	UANAV = "",
	UAPLAT = "",
	UAIOS = "",
	UAMOB = false,
	UAWIDTH = null,
	UAHEIGHT = null;

function getBrowser(){
	if(UA.match(/IEMobile/) != null){
		UANAV = "Internet Explorer";
		
		for(var a=7; a<=11; a+=1){
			if(UA.match(new RegExp("IEMobile/" + a, "")) != null){
				UANAV += " " + a;
				break;
			}
		}
		
		UANAV += " Mobile";
		
		for(var a=7; a<=10; a+=1){
			if(UA.match(new RegExp("Windows Phone " + a + ".0", "")) != null){
				UAPLAT = "Windows Phone " + a;
				break;
			}else if(UA.match(new RegExp("Windows Phone " + a + ".1", "")) != null){
				UAPLAT = "Windows Phone " + a + ".1";
				break;
			}
		}
		
		UAMOB = true;
	}else if(UA.match(/MSIE/) != null){
		UANAV = "Internet Explorer";
		
		for(var a=7; a<=11; a+=1){
			if(UA.match(new RegExp("MSIE " + a, "")) != null){
				UANAV += " " + a;
				break;
			}
		}
		
		if(UA.match(/Xbox/) != null) UAPLAT = "Xbox";
	}else if(UA.match(/Edge/) != null){
		UANAV = "Edge";
		
		if(UA.match(new RegExp("Windows Phone 10.0", "")) != null){
			UAPLAT = "Windows 10 Mobile";
			UAMOB = true;
		}
		else if(UA.match(/Xbox/) != null) UAPLAT = "Xbox One";
	}else if(UA.match(/OPR/) != null) UANAV = "Opera";
	else if(UA.match(/Chrome/) != null) UANAV = "Chrome";
	else if(UA.match(/Mozilla/) != null && UA.match(/rv:11.0/)) UANAV = "Internet Explorer 11";
	else if(UA.match(/Firefox/) != null) UANAV = "Mozilla Firefox";
	else if(UA.match(/Safari/) != null && UA.match(/Android/) == null){
		var a = UA.substring(UA.match(/Version/).index);
		UANAV = "Safari " + a.substring(a.indexOf("/")+1, a.indexOf(" ")) || a.substring(a.indexOf("/")+1);
	}
	else UANAV = "Navegador desconhecido";

	if(!UAMOB && (UAPLAT == "" || UAPLAT == null)){
		if(UA.match(/Windows NT 3.1/) != null) UAPLAT = "Windows NT 3.1";
		else if(UA.match(/Windows NT 3.5/) != null) UAPLAT = "Windows NT 3.5";
		else if(UA.match(/Windows NT 3.51/) != null) UAPLAT = "Windows NT 3.51";
		else if(UA.match(/Windows NT 4.0/) != null) UAPLAT = "Windows NT 4.0";
		else if(UA.match(/Windows NT 5.0/) != null) UAPLAT = "Windows 2000";
		else if(UA.match(/Windows NT 5.1/) != null) UAPLAT = "Windows XP";
		else if(UA.match(/Windows NT 5.2/) != null) UAPLAT = "Windows Server 2003";
		else if(UA.match(/Windows NT 6.0/) != null) UAPLAT = "Windows Vista";
		else if(UA.match(/Windows NT 6.1/) != null) UAPLAT = "Windows 7";
		else if(UA.match(/Windows NT 6.2/) != null) UAPLAT = "Windows 8";
		else if(UA.match(/Windows NT 6.3/) != null) UAPLAT = "Windows 8.1";
		else if(UA.match(/Windows NT 10.0/) != null) UAPLAT = "Windows 10";
		
		else if(UA.match(/Android/) != null){
			var a = UA.substring(UA.match(/Android/).index + "Android".length);
			a = a.substring(0, a.indexOf(")"));
			var b = a.substring(a.indexOf(" "), a.indexOf(";")) || a.substring(a.indexOf(" "), a.indexOf(")"));
			
			UAPLAT = "Android " + b;
			
			UAMOB = true;
		}
		
		else if(UA.match(/Linux/) != null) UAPLAT = "Linux";
		
		else if(UA.match(/Mac OS X/) != null){
			var a = UA.substring(UA.match(/OS/).index);
			a = a.substring(0, a.indexOf(")"));
			UAIOS = a.substring(a.indexOf(" ")+1, a.indexOf(" like")).replace(/_/g, ".");
			
			if(UA.match(/iPad/)){
				UAPLAT = "iPad";
				UAMOB = true;
			}else if(UA.match(/iPod/)){
				UAPLAT = "iPod";
				UAMOB = true;
			}else if(UA.match(/iPhone/)){
				UAPLAT = "iPhone";
				UAMOB = true;
			}else{
				if(a.indexOf(";") > -1) UAIOS = a.substring(a.indexOf(" ")+1, a.indexOf(";")).replace(/_/g, ".");
				else UAIOS = a.substring(a.indexOf(" ")+1).replace(/_/g, ".");
				UAPLAT = "Mac OS " + UAIOS;
			}
		}
		
		else UAPLAT = "Desktop";
	}
	
	var a = window.screen;
	UAWIDTH = a.availWidth;
	UAHEIGHT = a.availHeight;

	var UAJSON = JSON.parse('{"userAgent":"' + UA +
							'", "browser":"' + UANAV +
							'", "platform":"' + UAPLAT +
							'", "iOS": "' + UAIOS +
							'", "width":' + UAWIDTH +
							', "height":' + UAHEIGHT +
							', "mobile":' + UAMOB +
							', "by":"@MkgCriações"}');
}

var UAAdjusting = false,
    UADelay = 100;
function setResponsible(el, type, acresc){
	if(acresc == null) acresc = 0;
	
	if(type == "left"){
		window.addEventListener('resize', function(e){
			if (!UAAdjusting) {
				el.style.left = Math.abs(window.innerWidth - UAWIDTH + acresc)/2 || acresc;
				UAAdjusting = true;
				
				setTimeout(function() {
				  UAAdjusting = false;
				}, UADelay);
			}
		});
	}else if(type == "right"){
		window.addEventListener('resize', function(e){
			if (!UAAdjusting) {
				el.style.right = Math.abs(window.innerWidth - UAWIDTH + acresc)/2 || acresc;
				UAAdjusting = true;
				
				setTimeout(function() {
				  UAAdjusting = false;
				}, UADelay);
			}
		});
	}
	else if (type == "top"){
		window.addEventListener('resize', function(e){
			if (!UAAdjusting) {
				el.style.top = Math.abs(window.innerHeight - UAWIDTH + acresc)/2 || acresc;
				UAAdjusting = true;
				
				setTimeout(function() {
				  UAAdjusting = false;
				}, UADelay);
			}
		});
	}
	else if (type == "bottom"){
		window.addEventListener('resize', function(e){
			if (!UAAdjusting) {
				el.style.bottom = Math.abs(window.innerHeight - UAWIDTH + acresc)/2 || acresc;
				UAAdjusting = true;
				
				setTimeout(function() {
				  UAAdjusting = false;
				}, UADelay);
			}
		});
	}
}