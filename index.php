<!DOCTYPE html>
<html>
<head>
	<title>Сокраитель ссылок</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script>
	    function send(){
	        var msg = $('#form').serialize();
	        $.ajax({
	            type:'POST',
	            url:'ajax.php',
	            data:msg,
	            success:function (data) {
	                console.log(data);
	                $('#result').html(data);
	            }
	        });
	    }
	</script>
</head>
<body>
	<div class="container">
		<h1 class="title">Укоротить URL.</h1>
				<div id="result"></div>

		<form method="POST" id="form">
			<input type="url" name="url" placeholder="Введите URL" autocomplete="off" value="https://github.com/krivyshin/short">
		</form>
		<button name="button" onclick="send()">Получить ссылку</button>
	</div>
</body>
</html>