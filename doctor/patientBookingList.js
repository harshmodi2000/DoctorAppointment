$(function(){
	$.fn.displayList=function(){
		var cat=$('select[name="filter_category"]').children('option:selected').val();
		var apDate=$('input[name="filter_appointmentDate"]').val();
		var dName=$('input[name="filter_doctorName"]').val();
		var bDate=$('input[name="filter_bookingDate"]').val();
		var bStatus=$('select[name="filter_bookingStatus"]').children('option:selected').val();
		$('#display-bookings').load('AppointmentList.php',{

			category:cat,
			appointment_date:apDate,
			doctor_name:dName,
			booking_date:bDate,
			booking_status:bStatus
		});
	}
	$.fn.displayList();

	$('select[name="filter_category"]').add('input[name="filter_appointmentDate"]').add('input[name="filter_doctorName"]').add('input[name="filter_bookingDate"]').add('select[name="filter_bookingStatus"]').on('change keyup',function(){
		$.fn.displayList();
	});
	$('div#display-bookings').on('click','button',function(){
		var action=$(this).text();
		var parent=$(this).parents('tr');
		var bid=parent.find('input[type=hidden].booking-id').val();
		$.post('updatebookingstatus.php',{
			bookingId:bid,
			action: action
		},function(){
			if(action=="Cancel")
			{
				alert("Appointment Cancelled");
			}else{
				alert("Appointment Confirmed");
			}
			$.fn.displayList();
		});
	});

	$('#reset_bookingDate').click(function(){
		$('input[name="filter_bookingDate"]').val('');
		$.fn.displayList();
	});
	$('#reset_appointmentDate').click(function(){
		$('input[name="filter_appointmentDate"]').val('');
		$.fn.displayList();
	});
	$('#reset_doctorName').click(function(){
		$('input[name="filter_doctorName"]').val('');
		$.fn.displayList();
	});
	$('#display-bookings').on('click','a.prescription',function(e){
		e.preventDefault();
		var parent=$(this).parents('tr');
		var bid=parent.find('input[type=hidden].booking-id').val();
		var form=$('<form action="../admin/downloadprescriptionFile.php" method="POST"></form>');
		form.append('<input type="hidden" name="booking_id" value="'+bid+'">');
		form.appendTo('body');
		form.submit();
		from.remove();
	});


});