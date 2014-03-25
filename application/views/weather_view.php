<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Weather Report</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form').submit(function(){
				$.get($(this).attr('action')+"?callback=?",
					$(this).serialize(),
					function(data){
						console.log(data.data);
						$("#weather_for").html("<h1>Weather for: "+data.data.request[0].query+"</h1><p>Current temp F: "+data.data.current_condition[0].temp_F+" degrees</p><p>Current temp C: "+data.data.current_condition[0].temp_C+" degrees</p><p>Current Windspeed: "+data.data.current_condition[0].windspeedMiles+" mph</p><p>Weather Description: "+data.data.current_condition[0].weatherDesc[0].value+"</p>")
					},
					"json"
					);
				return false;
			})
		})
	</script>
</head>
<body>
	<p>The Codingdojo weather report!</p>
	<form action="http://api.worldweatheronline.com/free/v1/weather.ashx" method="get">
		<select name="q">
			<option value="Seattle,wa">Seattle,WA</option>
			<option value="New+York,ny">New York,NY</option>
			<option value="San+Francisco,ca">San Francisco,CA</option>
		</select>
		<input type="hidden" name="key" value="j9wegm9ym5ddsfzcherfw72c">
		<input type="hidden" name="format" value="json">
		<input type="submit" value="Get weather!">
	</form>
	<div id="weather_for">
	</div>
</body>
</html>