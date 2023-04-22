$(function(){
$('#filter').on('click','#addfilter',function(){
	$('#filter').empty();
	var deletefilter=$('<button class="btn btn-danger" id="deletefilter">Delete Filter</button>');
	$('#filter').append(deletefilter);
	var filterlabel = $('<select id="filtername"><option value="name" selected>Name</option><option value="gender">Gender</option><option value="available">Available Today</option></select>');
	$('#filter').append(filterlabel);
	var filteroption=$('<input type="text" id="filtervalue">');
	$('#filter').append(filteroption);
	});

$('div.maincategory').on('change',"#category",function(){
	var category=$('#category').val();
	var filtername=$('#filtername').length?$('#filtername').val():"undefined";
	var filtervalue=$('#filtervalue').length?$('#filtervalue').val():"undefined";
	$('#display').empty();
	$('#display').load('doctorList.php',{
		filter_category:category,
		filter_name:filtername,
		filter_value:filtervalue
	});
});
$('div#filter').on('change','#filtername',function(){
	var filtername=$(this).val();
	$(this).parent().find('#filtervalue').remove();
	if(filtername=="name")
	{
	$("#category").trigger('change');
	var filteroption=$('<input type="text" id="filtervalue">');
	$('#filter').append(filteroption);
	}else if(filtername=="gender")
	{
		var genderoption=$('<select id="filtervalue"><option value="M" selected>M</option><option value="F">F</option></select>');
		$('#filter').append(genderoption);
		$("#category").trigger('change');
	}else{
		$("#category").trigger('change');
	}
});
	
	$('#filter').on('click','#deletefilter',function(){
		var addfilter=$('<button class="btn btn-success" id="addfilter">Add filter</button>');
		$('#filter').empty();
		$('#filter').append(addfilter);
		$("#category").trigger('change');
	});


	$('#filter').on('change keyup','#filtervalue',function()
		{
			$("#category").trigger('change');
		});

	$("#category").trigger('change');

	$("body").on('click','.docinfo',function(){
		var today=new Date();
		var month=today.getMonth()+1;
		month = month.lenght>1?month:'0'+month;
		var tday=today.getDate();
		tday=tday>=10?tday:'0'+tday;
		var tdate = today.getFullYear()+'-'+month+'-'+tday;
		var parent=$(this).parents('div.dcontainer');
		var dId=parent.find('input[type="hidden"].doctorId').val();
		var slotDisplay=parent.children('div.slotDisplay');
		var slotDate=parent.children('div.datediv');
		if(slotDisplay.length)
		{
			slotDisplay.remove();
			slotDate.remove();
		}else{
		var dateDiv=$('<div class="datediv"></div>');
		var dateform=$('<input type="date" class="floating-input" style="width:10rem; text:white;" value="'+tdate+'" class="dateform" name="checkDate" min="'+tdate+'">');
		dateDiv.append(dateform);
		parent.append(dateDiv);
		var newDiv=$('<div class="slotDisplay"></div>');
		parent.append(newDiv);
		var display=parent.children('div.slotDisplay');
		display.load('retrieveSlot.php',{
			doctorId:dId,
		    ap_date:tdate
		});
		}
	});
	$('div#display').on('click','button.book',function(e){
		e.preventDefault();
		var parent=$(this).parents('div.dcontainer');
		var selected=parent.find('input[type="radio"]:checked');
		//var slotDisplay=parent.children('div.slotDisplay');
		if(selected.length)
		{
			var id=parent.find('input[name="dId"]').val();
			var bookedtime=parent.find('input:radio[name=ap_time]:checked');
			var bap_time=bookedtime.val();
			var bap_date=bookedtime.parent().siblings('input:hidden[name="ap_date"]').val();
			if(confirm("Book appointment on "+bap_date+" at "+bap_time)==true)
			{
				$('#message').load('bookAppointment.php',{doctorId:id,
					ap_date:bap_date,
					ap_time:bap_time},function(){
							var tdate=parent.find('input[name=checkDate]').val();
							var dId=parent.find('input[type="hidden"].doctorId').val();
							var display=parent.children('div.slotDisplay');
							display.load('retrieveSlot.php',{
							doctorId:dId,
							ap_date:tdate
							});
					});
			}
			/*var form=$('<form action="bookAppointment.php" method="POST"></form>');
			var inputId=$('<input type="hidden" name="doctorId" value="'+id+'">');
			var inputAp_date=$('<input type="hidden" name="ap_date" value="'+ap_date+'">');
			var inputAp_time=$('<input type="hidden" name="ap_time" value="'+ap_time+'">');
			form.append(inputId);
			form.append(inputAp_date);
			form.append(inputAp_time);
			$('body').append(form);
			form.submit();*/
		}else{
			alert("please select one !");
		}
	});
	$('div#display').on('change','input[name="checkDate"]',function(){
		var tdate=$(this).val();
		var parent=$(this).parents('div.dcontainer');
		var dId=parent.find('input[type="hidden"].doctorId').val();
		var display=parent.children('div.slotDisplay');
		display.load('retrieveSlot.php',{
			doctorId:dId,
		    ap_date:tdate
		});
	});

	setInterval(function(){

		$('div.slotDisplay').each(function(){
		var parent=$(this).parents('div.dcontainer');
		var selected=parent.find('input[type="radio"]:checked');
		if(!selected.length)
		{	
			var tdate=parent.find('input[name=checkDate]').val();
			var dId=parent.find('input[type="hidden"].doctorId').val();
			var display=parent.children('div.slotDisplay');
			display.load('retrieveSlot.php',{
			doctorId:dId,
			ap_date:tdate
			});
		}
	});
	},2000);
});