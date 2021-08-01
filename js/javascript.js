$(document).ready(function(){

	$('#infouserdetail').hide();
	$('#info').click(function(){
		$('#infouserdetail').slideToggle(function(){
			$('#info').css('border-radius','0px');
			$('#info').css('width','100%');
		});
		$('#info').css('border-radius','15px');
		$('#info').css('width','50%');
	});

	// ('#datacari').hide();
	$('#keyword').on('keyup', function(){
			$('#datacari').css('border','1px solid #ccc');
		$('#datacari').load('ajax/search.php?keyword=' + $('#keyword').val());
		if($('#keyword').val().length==0){
			$('#datacari').hide();
		}else{
			$('#datacari').show();
		}
	});
	$('#keyword').focusout(function(){
		setTimeout(function() {
			$('#datacari').hide();
		}, 200);
	});

	// $('#datadata').hide();
	$('#keywords').on('keyup', function(){
		$('#datadata').load('ajax/searching.php?keywords=' + $('#keywords').val());
		if($('#keywords').val().length==0){
			$('#datadata').hide();
		}else{
			$('#datadata').show();
		}
	});
	$('#keywords').focusout(function(){
		setTimeout(function() {
			$('#datadata').hide();
		}, 200);
	});

	// notifikasi
	$('#barnotif').hide();
	$('#notifikasi').click(function(e){
		e.preventDefault();
		$('#barsetting').hide();
		// $('#barnotif').show();
		$('#barnotif').slideToggle();
	});
	$('#notifikasi').focusout(function(){
		setTimeout(function() {
			$('#barnotif').hide();
		}, 200);
	});

	$('#barsetting').hide();
	$('#setting').click(function(e){
		e.preventDefault();
		$('#barnotif').hide();
		// $('#barnotif').show();
		$('#barsetting').slideToggle();
	});
	$('#setting').focusout(function(){
		setTimeout(function() {
			$('#barsetting').hide();
		}, 200);
	});

});