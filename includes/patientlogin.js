$(function(){
	$('form').on('submit',function(e){
		e.preventDefault();
		var patientUsername=$('#username').val();
		var patientPassword=$('#password').val();
		var formSubmit=$('#submit').val();
		$('#message').load('patientLogin.php',{username:patientUsername,password:patientPassword,submit:formSubmit});
	});
});