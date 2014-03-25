<!doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Leads Search and Pagination</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<style type="text/css">
	#pages{
		list-style: none;
		margin-left: 80%;
	}
	#pages li{
		display: inline;
		border-left: 1px solid black;
	}
	#pages li a{
		text-decoration: none;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$(".page").click(function(){
			alert('nice');
			$.post(
				$(this).attr('href'),
				function(data){
					alert('Yes!');
					$('tbody').html(" ");
					$.each(data.result,function(i, val){
						$('tbody').append("<tr><td>"+val.id+"</td><td>"+val.first_name+"</td><td>"+val.last_name+"</td><td>"+val.registered_datetime+"</td><td>"+val.email+"</td></tr>");
					});
				},"json"
				);
			return false;
		});
		$("#filter").submit(function(){
			alert('nice2');
			$.post(
				$(this).attr('action'),
				$(this).serialize(),
				function(data){
					alert('here');
					$('tbody').html(" ");
					$.each(data.result,function(i, val){
						$('tbody').append("<tr><td>"+val.id+"</td><td>"+val.first_name+"</td><td>"+val.last_name+"</td><td>"+val.registered_datetime+"</td><td>"+val.email+"</td></tr>");
					});
					$("#pages").html(" ");
					for (var i = 1; i <= data.total_pages; i++) 
					{
						$("#pages").append("<li><a rid="+i+" class='page' href='/leads/display_page/"+i+"' page="+data.total_pages+">"+i+"</a></li>");
					};
				},"json");
			return false;
		})

	})
	$(document).on("click",".page",function(){
		alert('nice');
			$.post(
				$(this).attr('href'),
				function(data){
					alert('Yes!');
					$('tbody').html(" ");
					$.each(data.result,function(i, val){
						$('tbody').append("<tr><td>"+val.id+"</td><td>"+val.first_name+"</td><td>"+val.last_name+"</td><td>"+val.registered_datetime+"</td><td>"+val.email+"</td></tr>");
					});
				},"json"
				);
			return false;
		});
</script>
</head>
<body>
	<form action="/leads/filter" method="post" id="filter">
		<label>Name:</label><input type="text" name="name" placeholder="First_Name Last_Name">
		<label>From:</label><input type="date" name="start_date">
		<label>Date:</label><input type="date" name="end_date"> 
		<input type="submit" value="Filter">
	</form>
	<ul id='pages'>
		<?php for($i=1;$i<=$total_pages;$i++):?>
		<li><a rid="<?= $i?>" class="page" href="/leads/display_page/<?= $i?>" page="<?= $total_pages?>"><?= $i?></a></li>
		<?php endfor;?>
	</ul>
	<table>
		<thead>
			<th>Leads Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Registered Datetime</th>
			<th>Email</th>
		</thead>
		<tbody>
			<?php foreach ($result as $key => $value):?>
			<tr>
				<td><?= $value['id']?></td>
				<td><?= $value['first_name']?></td>
				<td><?= $value['last_name']?></td>
				<td><?= $value['registered_datetime']?></td>
				<td><?= $value['email']?></td>
			</tr>
		<?php endforeach?>
		</tbody>
	</table>
</body>
</html>
