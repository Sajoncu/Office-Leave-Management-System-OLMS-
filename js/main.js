$(function() {

	//Index page
    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	
	//Login page
	$('#application-form-link').click(function(e) {
		$("#application-form").delay(100).fadeIn(100);
 		$("#application-list").fadeOut(100);
		//$(".table-div").fadeIn(100);
		$('#application-list-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	
	$('#application-list-link').click(function(e) {
		$("#application-list").delay(100).fadeIn(100);
 		$("#application-form").fadeOut(100);
 		//$(".table-div").fadeOut(100);
		$('#application-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	
	$('#add-student-link').click(function(e) {
		$(".add-student-container").delay(200).toggle('100');
 		e.preventDefault();
	});

});
