<?php
error_reporting(0);
// **PREVENTING SESSION HIJACKING**
// Prevents javascript XSS attacks aimed to steal the session ID
ini_set('session.cookie_httponly', 1);

// **PREVENTING SESSION FIXATION**
// Session ID cannot be passed through URLs
ini_set('session.use_only_cookies', 1);

// Uses a secure connection (HTTPS) if possible
ini_set('session.cookie_secure', 1);
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
$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
if(!empty($_POST["userName"]) && !empty($_POST["userPass"]) && !empty($_POST["repeatPass"]) && !empty($_POST["userMail"]) && !empty($_POST["repeatMail"]) && $_POST["repeatPass"] = $_POST["userPass"] && $_POST["repeatMail"] = $_POST["userMail"]){
	$userName = htmlspecialchars($_POST["userName"],ENT_QUOTES);
	$password = htmlspecialchars($_POST["userPass"],ENT_QUOTES);
	$email = htmlspecialchars($_POST["userMail"],ENT_QUOTES);
	$hashpass = md5($password);
	$query = $db->prepare("SELECT count(*) FROM users WHERE ip = :ip");
	$query->execute([":ip" => $ip]);
	$ipcount = $query->fetchColumn();
	$query = $db->prepare("SELECT count(*) FROM users WHERE name = :userName");
	$query->execute([':userName' => $userName]);
	$ncount = $query->fetchColumn();
	$query = $db->prepare("SELECT count(*) FROM users WHERE email = :email");
	$query->execute([':email' => $email]);
	$ecount = $query->fetchColumn();  
	if($ncount > 0){
		echo'<p>Пользователь с данным ником уже существует. <a href="/auth/register.php">Попробовать еще раз</a></p>';
	}elseif ($ecount > 0){
		echo'<p>Пользователь с данной почтой уже существует. <a href="/auth/register.php">Попробовать еще раз</a></p>';
	}elseif($ipcount >= 1){
		echo'<p>Слишком много аккаунтов. <a href="/">Перейти на главную</a></p>';
	}else{
		$query = $db->prepare("INSERT INTO users (name, password, email, registerDate, ip)
		VALUES (:activatecode, :name, :password, :email, :time, :ip)");
		$query->execute([':name' => $userName, ':password' => $hashpass, ':email' => $email, ':time' => time(), ':ip' => $ip]);
		echo'<p>Регистрация прошла успешно, можно входить в аккаунт. <a href="/">Перейти на главную</a></p>';
	}
}else{
	echo'
			<header>
				<h2>Регистрация</h2>
			</header>
		<form method="post">
		<div>
		 <div class="row">
			<div class="col-12">
				<input type="text" class="form-control" name="userName" placeholder="Введите имя">
			</div>
			<div class="col-12">
				<input type="password" class="form-control" name="userPass" placeholder="Введите пароль">
			</div>
			<div class="col-12">
				<input type="password" class="form-control" name="repeatPass" placeholder="Повторите пароль">
			</div>
			<div class="col-12">
				<input type="email" class="form-control" name="userMail" placeholder="Введите почту">
			</div>
			<div class="col-12">
				<input type="email" class="form-control" name="repeatMail" placeholder="Повторите почту">
			</div>
			<div class="col-12">
				<input type="submit" value="Зарегистрироваться" />
			</div>
		  </div>	
		</div>
	</form>';
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
