$(function(){
	$('a.delete').click(function(e){
		e.preventDefault();
		var parent=$(this).parent('td');
		var hidden=parent.siblings('input[type="hidden"]');
		var value=hidden.val();
	});

	$('td.s-name').on('click','a.edit',function(e){
		e.preventDefault();
		var parent=$(this).closest('td');
		var grand=parent.parent('tr');
		var value=parent.children('p.schedulename').text();
		parent.remove();
		var newList=$('td#list').clone().attr('id','').addClass('list');
		newList.find('option[value="'+value+'"]').attr('selected','');
		grand.append(newList);
		var btn = $('<td><button class="save">Save</button></td>');
		grand.append(btn);
	});
	$('td.s-name').on('click','a.delete',function(e){
		e.preventDefault();
		var parent=$(this).closest('tr');
		var hidden=parent.find('input[type="hidden"]');
		var id=hidden.val();
		$('#message').css('display','block');
		$('#message').load('saveSchedule.php',{userId:id,action:"s_delete"});
	});

	$('table').on('click','button.save',function(e){
		e.preventDefault();
		var parent=$(this).parent('td');
		var hidden=parent.siblings('input[type="hidden"]');
		var list=$(this).parent('td').siblings('.list');
		var schedule=list.find('select[name="schedule"]').val();
		var id=hidden.val();
		$('#message').css('display','block');
		$('#message').load('saveSchedule.php',{userId:id,schedulename:schedule});
	});
})