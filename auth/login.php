<?php
error_reporting(0);
session_start();
include "../incl/connection.php";
echo'<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../incl/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper-->
			<div id="wrapper">
								<div id="main">
									<article class="panel">';
$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
if(isset($_SESSION["id"]) AND $_SESSION["id"] != 0){
		echo'<p>Ты уже вошёл. Зачем еще раз это делать? <a href="/">Перейти на главную</a></p>';
	}else{
if($_POST["name"] != "" AND $_POST["password"] != ""){
	$name = htmlspecialchars($_POST["name"]);
	$pass = md5(htmlspecialchars($_POST["password"]));
	// getting user
	$query = $db->prepare("SELECT * FROM users WHERE name = :name"); 
	$query->execute([':name' => $name]);
	$user = $query->fetchAll();
	// to variables
	$id = $user['id']; // id 
	$dbpass = $user['password']; // db pass
	// checking passwords
	if($pass = $dbpass){
		$_SESSION["id"] = $id;
		echo '<p>Вход произведен успешно. <a href="/">Перейти на главную</a></p>';
	}else{
		echo'<p>Неправильный пароль. <a href="/">Попробовать еще раз</a></p>';
	}
}else{
	echo'
			<header>
				<h2>Авторизация</h2>
			</header>
		<form method="post">
		<div>
		 <div class="row">
			<div class="col-12">
			<input type="text" class="form-control" name="name" id="name" placeholder="Введите имя">
			</div>
			<div class="col-12">
			<input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Введите пароль">
			</div>
			<div class="col-12">
				<input type="submit" value="Войти" />
			</div>
		  </div>	
		</div>
	</form>';
}
	}
echo'</article>
</div>
				<!-- Footer -->
					<div id="footer">
						<ul class="copyright">
							<li>&copy; Chernov Studio, 2021</li>
						</ul>
					</div>
					
</div>
					
		<!-- Scripts -->
			<script src="../incl/js/jquery.min.js"></script>
			<script src="../incl/js/browser.min.js"></script>
			<script src="../incl/js/breakpoints.min.js"></script>
			<script src="../incl/js/util.js"></script>
			<script src="../incl/js/main.js"></script>

	</body>
</html>';
?>
