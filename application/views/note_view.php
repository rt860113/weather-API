<!doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Ajax Posts</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#note").on('submit',function(){
				event.preventDefault();
				var form = $(this);
				$.post(
					form.attr('action'),
					form.serialize(),
					function(data){
						// alert('here');
						console.log('show me this message please',data.error);
						console.log('show me this object',data.note);
						if(typeof(data.note) != "undefined" && data.note !== null)
						{
							$('#container').append("<div class='post'>"+data.note+"</div>");
						}
					},
					"json");
			});
		});
	</script>
</head>
<body>
	<h1>My Posts:</h1>
	<div id='container'>
		<?php foreach ($note as $key => $value):?>
		<div class='post'><?php echo $value['description']?></div>
		<?php endforeach;?>
		<?php echo $this->session->flashdata('error');?>
	</div>
	<p>Add a note:</p>
	<div>Add here</div>
	<form action='/notes/create' method="post" id="note">
		<textarea type='text' name='description'></textarea><br>
		<input type='submit' value='Post It!'>
	</form>
</body>
</html>
<style type="text/css">
	.post{
		display: inline-block;;
		vertical-align: top;
		border: 1px solid black;
		width: 100px;
		height:100px;
		overflow: auto;
		margin: 5px;
	}
</style>