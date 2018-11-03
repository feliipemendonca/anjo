var scroll = new SmoothScroll('a[href*="#"]:not([data-easing])');

var linear = new SmoothScroll('[data-easing="linear"]', {easing: 'linear'})



// document.addEventListener('scrollStart', logScrollEvent, false);
// document.addEventListener('scrollStop', logScrollEvent, false);
// document.addEventListener('scrollCancel', logScrollEvent, false);


/**** Menu  Scrooll***/
jQuery(document).ready(function ($) {
	var controleNav = false;
	$(document).scroll(function (e) {
		var scrollTop = $(document).scrollTop();
		if (scrollTop > $('.navbar').height()) {

			if (controleNav == false) {
				$('.navbar').removeClass('bg-light').addClass('fixed-top');
				$('.navbar').hide();
				$('.navbar').fadeIn('slow');
				controleNav = true;
			}
		}else{
			if (controleNav == true) {
				$('.navbar').removeClass('fixed-top').addClass('bg-light');
				$('.navbar').hide();
				$('.navbar').fadeIn('slow');
				controleNav = false;
			} 
		}
	});
});


function cor(){
	$('.about').removeClass('text-danger');

}