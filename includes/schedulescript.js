$(function(){
	var count = 0;
	var rows=0;
	var checkedCounter=0;
	$('button#newRow').on('click',function(e){
		e.preventDefault();
		if(rows<7&&checkedCounter<7){
			var $frag=$('#row').clone();
			count++;
			$frag.attr('id',"row"+count);
			$frag.find('input.days').attr('name',"d"+count+"[]");
			$frag.find('input.time1').attr('name',"t1"+count+"[]");
			$frag.find('input.time2').attr('name',"t2"+count+"[]");
			$frag.find('input.time3').attr('name',"t3"+count+"[]");
			$frag.find('input.time4').attr('name',"t4"+count+"[]");
			$frag.append('<td><button class="deleteRow">Delete</button></td>');		
			$frag.appendTo('table');
			rows++;
		}
	});

	$('#serv').on('click','.deleteRow',function(e){
		e.preventDefault();
		var grandparent=$(this).parents('tr');
		var parent=grandparent.children('td.cbDays');
		var checked=parent.children('input[type="checkbox"]:checked');
		checked.each(function(){
			checkedCounter--;
			var val=$(this).val();
			var family=$('form').find('input[type="checkbox"][value="'+val+'"]').not($(this));
			family.each(function(){
				$(this).removeAttr("disabled");
			});
		});
		grandparent.remove();
		rows--;
	});

	$('form').on('change','input[type="checkbox"]',function(){
		var val=$(this).val();
		var family=$('form input[type="checkbox"][value="'+val+'"]').not($(this));
		if($(this).is(':checked'))
		{
			family.prop("disabled",true);
			checkedCounter++;
		}
		else{
			family.prop("disabled",false);
			checkedCounter--;
		}
	});

	$('#scheduleName').on('change',function(){
		var name=$(this).val();
		$('.message').load("createModel.php",{
			name: name
		});
	});

	$('form').submit(function(e){
		
		var namebox=$('#scheduleName');
		if(namebox.hasClass('input-error'))
		{
			e.preventDefault();
			alert('Please enter correct Schedule name');
			namebox.focus();
		}
	})
});