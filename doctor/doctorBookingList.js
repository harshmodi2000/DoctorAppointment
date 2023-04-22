$(function(){
		var today=new Date();
		var month=today.getMonth()+1;
		month = month.lenght>1?month:'0'+month;
		var tday=today.getDate();
		tday=tday>=10?tday:'0'+tday;
		var tdate = today.getFullYear()+'-'+month+'-'+tday;
		$('input[name="ap_date"]').val(tdate);
	$.fn.displayList=function(){
		var apDate=$('input[name="ap_date"]').val();
		var pName=$('input[name="patient_name"]').val();
		$('#apList').load('appointmentlist.php',{
			ap_date:apDate,
			patient_name:pName
			
		});
	}
	$.fn.displayList();
	$('input[name="ap_date"]').add('input[name="patient_name"]').on('change keyup',function(){
		$.fn.displayList();
	});
	$('div#apList').on('click','button.reschedule',function(){
		var parent=$(this).parents('tr');
		var bid=parent.find('input[type=hidden].bid').val();
		var form=$('<form method="POST"></form>');
		form.append('<input type="hidden" name="bid" value="'+bid+'">');
		form.append('<input type="hidden" name="action" value="reschedule">');
		form.appendTo('body');
		form.submit();
	});
	$('#reset_apdate').click(function(){
		$('input[name="ap_date"]').val('');
		$.fn.displayList();
	});
	$('#reset_pname').click(function(){
		$('input[name="patient_name"]').val('');
		$.fn.displayList();
	});
	$('div#apList').on('click','a.prescription',function(e){
		e.preventDefault();
		var parent=$(this).parents('tr');
		var bid=parent.find('input[type=hidden].bid').val();
		var form=$('<form action="../admin/downloadprescriptionFile.php" method="POST"></form>');
		form.append('<input type="hidden" name="booking_id" value="'+bid+'">');
		form.appendTo('body');
		form.submit();
		from.remove();
	});
	
});