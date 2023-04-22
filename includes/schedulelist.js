$(function(){
			$('a.listItem').click(function(e){
				e.preventDefault();
				var val=$(this).text();
				$('.column2').load("modelDetail.php",{
				name: val,
				action: "details"
				});
			});
			$('button.btnDelete').click(function(e){
				e.preventDefault();
				var val=$(this).val();
				if(confirm('Please Confirm Deletion')){
				var parent=$('<form method="POST"></form>');
				var el=$('<input type="hidden" name="name" value="'+val+'">');
				parent.append(el).appendTo('body');
				parent.submit().remove();
				}
			});
		});