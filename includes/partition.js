$(function(){
	var initial=$('select#default-selected').find('option:selected').val();
		var newDuration=$('<input type="number" id="new-duration" placeholder="enter duration">');
		var newMargin=$('<input type="number" id="new-margin" placeholder="enter margin">');
		var editButton=$('<button type="button" id="save-default">Save</button>');
		var deleteButton=$('<button type="button" class="cancel-edit">Cancel</button>');

		$('a.delete-row').click(function(e){
			e.preventDefault();
			var parent=$(this).parents('tr');
			var id=parent.children('input[type="hidden"]').val();
			$('div#message').load("timeslot.php",{
					roleId: id,
					action: "delete"
			});

		});
		$('#serv').on('click','.edit-row',function(e){
			e.preventDefault();
			var parent=$(this).parents('tr');
			var colduration=parent.children('td.duration');
			var colmargin=parent.children('td.margin');
			var colaction=parent.children('td.action');
			var durationVal=colduration.text();
			var marginVal=colmargin.text();
			colduration.empty();
			colmargin.empty();
			colaction.empty();
			colduration.append('<input type="number" class="val-duration" placeholder="enter duration" value="'+durationVal+'">');
			colmargin.append('<input type="number" class="val-margin" placeholder="enter margin" value="'+marginVal+'">');
			colaction.append('<button type="button" class="save-change">Save</button>');
			colaction.append(deleteButton);
		});

		$('table#serv').on('click','button.save-change',function(e){
			e.preventDefault();
			var parent=$(this).parents('tr');
			var durationVal=parent.find('input.val-duration').val();
			var marginVal=parent.find('input.val-margin').val();
			var id=parent.children('input[type="hidden"]').val();
			$('div#message').load("timeslot.php",{
					roleId:id,
					duration: durationVal,
					margin: marginVal
			});
		});
	$('select#default-selected').on('change',function(){
		var val=$(this).find('option:selected').val();
		if(val==initial)
		{
			location.reload();
		}else
			{
			if(val=="customize")
			{

				$('div#default').append(newDuration);
				$('div#default').append(newMargin);
				$('div#default').append(editButton);
				$('div#default').append(deleteButton);

			}else if (val=="max") {
				$('div#default').children(':not("select")').not('#primary-label').remove();
				$('div#default').append(editButton);
			}
		}
	});

	$('body').on('click','button.cancel-edit',function(e){
		e.preventDefault();
		location.reload();
	});
	$('div#default').on('click','button#save-default',function(e){
		e.preventDefault();
		var val=$('div#default').find('option:selected').val();
		if(val=="customize"){
			var duration = $('input#new-duration').val();
			var margin=$('input#new-margin').val();
			$('div#message').load("timeslot.php",{
					default_duration: duration,
					default_margin: margin
			});
		}else{
			if(val=="max")
			{
				$('div#message').load("timeslot.php",{
					action: "truncate"
					
			});
			}
		}
		
	});
	$('div#default').on('click','button#delete-default',function(e){
		e.preventDefault();
		$('div#message').load("timeslot.php",{
					action: "truncate"			
			});
	});
		$('div#default').on('click','button#edit-default',function(e){
		e.preventDefault();
		$('input#new-duration').attr('readonly',false);
		$('input#new-margin').attr('readonly',false);
		$('div#default').append(deleteButton);
		$('input#new-duration').focus();

	});
		


});