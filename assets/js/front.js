var pathname 	= 	window.location.pathname;
pathname		=	pathname.replace(/\/$/, '');

$(function () {
    $('.selectpicker').selectpicker();
    
    if($('.datatbl').length) {
		$('.datatbl').DataTable( {
		    responsive: true
		});
	}
	
	$(".modal").modal({
		show: false,
		keyboard: false,
		backdrop: 'static'
	});
	
});