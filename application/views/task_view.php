<!doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>List of Tasks</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("button").on("click",function(){
			return false;
		});
		$(".edit").on("click",function(){
			// event.preventdefault();
			// if ($(this).parent().siblings('.input1').is(':hidden')==false)
			// {
			// 	alert('yes');
			// }
			// var status=$(this).parent().siblings('.input1').is(':hidden')
			$(this).parent().siblings('.checkbox,span').toggle();
			$(this).parent().siblings('.input1').toggle(function(){
				if ($(this).parent().children(".input1").is(':hidden'))
				{
					// alert('yes');
					console.log($(this).parent().children("button").children().attr("href"));
					console.log($(this).parent().children(".checkbox").attr('rid'));
					console.log($(this).parent().children(".input1").val());
					$.post(
						$(this).parent().children("button").children().attr("href"),
						{id:$(this).parent().children(".checkbox").attr('rid'),name:$(this).parent().children(".input1").val()},
						function(){
							// alert('succeed!');
							$("#status1").attr("status","yes");
						},"json");

				$(this).parent().children()	
				};
			});
			if($(this).parent().siblings('.input1').val()!="") 
			{
				// alert('no');
				$(this).parent().siblings('span').html("<span>"+$(this).parent().siblings('.input1').val()+"</span>");
			};
			return false;
		});
		$("#add_task").on("submit",function(){
			$.post(
				$(this).attr("action"),
				$(this).serialize(),
				function(data){
					console.log(data);
					$('#newform').append("<div><button><a class='edit' href='/tasks/edit_task'>Edit</a></button><input type='checkbox' rid="+data.id+" class='checkbox' value="+data.name+"><span>"+data.name+"</span><input type='text' class='input1' style='display:none'>");
				},"json");

			return false;
		});
	});
	$(document).on("click",".checkbox",function(){
			// alert('clciked me!');
			if ($(this).prop('checked')) {
				$(this).prop('disabled',true);
				$(this).next('span').css({textDecoration:'line-through','color':'grey'});
				$.post(
					"/tasks/delete",
					{id:$(this).attr('rid')},
					function(){
						// alert('succeed!');
					});
				
			};
	})
	</script>
</head>
<body>
	<div>
		<h1>List of Tasks:</h1>
		<form action="tasks" method='post' id='newform'>
			<input id="status1" type="hidden" status="">
			<?php foreach ($result as $key => $value):?>
			<div><button><a class="edit" href="/tasks/edit_task">Edit</a></button><input type='checkbox' rid="<?= $value['id']?>" class='checkbox' value="<?= $value['name']?>"><span><?= $value['name']?></span><input type='text' class='input1' style="display:none"></div>
			<?php endforeach;?>
		</form>
	</div>
	<div>
		<form id="add_task" action="tasks/add_task" method='post'>
			<p>Create a New Task:</p>
			<input type='text' name='name'><br>
			<input type='submit' value='Add Task'>
		</form>
	</div>
</body>
</html>