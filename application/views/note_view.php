<!doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Ajax notes</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			// $("#edit_note").on('submit',function(){
			// 	event.preventDefault();
			// 	var form = $(this);
			// 	$.post(
			// 		form.attr('action'),
			// 		form.serialize(),
			// 		function(data){
			// 			console.log('show me this message please',data.error);
			// 			console.log('show me this object',data.note);
						
			// 		},
			// 		"json");
			// });
			$("#add_note").on('submit',function(){
				event.preventDefault();
				var form = $(this);
				$.post(
					form.attr('action'),
					form.serialize(),
					function(data){
						console.log('show me this message please',data.error);
						console.log('show me this object',data.title);
						console.log('show me this id',data.id);
						$("#container").append("<form action='/notes/edit_note' method='post' class='edit_note'><input type='hidden' name='id' value="+data.id+">"+"<p>"+data.title+"<span>  </span><a href='/notes/delete_note/"+data.id+"'>Delete</a></p>"+"<textarea class='textarea_editable' name='description'></textarea><input type='submit' value='edit'></form>");
						// $.each(data.note,function(key,value){
							
						// 		console.log(value);
													
						// })
						// if(typeof(data.note) != "undefined" && data.note !== null)
						// {
						// 	$('#container').append("<div class='post'>"+data.note+"</div>");
						// }
					},
					"json");
			});
		});
			$(document).on('click','.textarea_editable',function(){
					$(this).change(function(){
					$.post($(this).parent().attr('action'),{id:$(this).siblings(".hidden").attr('value'),description:$(this).val()},function(){
						// alert('success!');
					})
					});
			});
			$(document).on('click','.delete',function(){
				$.post($(this).attr('href'),function(){
					alert('delete');
					$(this).parent().parent().html("<div></div>");
				})
			})
	</script>
</head>
<body>
	<h2>Notes:</h2>
	<div id="container">
		<?php foreach ($result as $key => $value):?>
		<form action='/notes/edit_note' method="post" class="edit_note">
			<input type="hidden" name='id' value="<?= $value['id']?>" class='hidden'>
			<p><?= $value['title']?><span>  </span><a class='delete' href="/notes/delete_note/<?= $value['id']?>">Delete</a></p>
			<textarea class='textarea_editable' name='description'><?= $value['description']?></textarea>
			<input type="submit" value="edit">
		</form>
		<?php endforeach;?>
	</div>
	<form action='/notes/add_title' method="post" id="add_note">
		<input type='text' name='title' placeholder="Insert note title here..."></input><br>
		<input type='submit' value='Add Note'>
	</form>
</body>
</html>
<style type="text/css">
.textarea_editable{
	width: 100px;
	height:100px;
}
</style>