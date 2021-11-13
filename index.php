<?php
error_reporting(0);
session_start();
include "incl/connection.php";
echo'<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="incl/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper-->
			<div id="wrapper">';
if(!empty($_GET['name'])){
	$get = htmlspecialchars($_GET['name']);
	$query = $db->prepare("SELECT count(*) FROM users WHERE name = :name"); 
	$query->execute([':name' => $get]);
	$count = $query->fetchColumn();
	if($count != 0){
		$query = $db->prepare("SELECT * FROM users WHERE name = :name"); 
	    $query->execute([':name' => $get]);
	    $result = $query->fetchAll();
		foreach($result as &$user){
			$name = $user['name'];
			$id = $user['id'];
			$discord = $user['discord'];
			$tg = "https://t.me/".$user['telegram']."";
			$vk = "https://vk.com/".$user['vk']."";
			$git = "https://github.com/".$user['git']."";
			$status = $user['status'];
			$badge = $user['badge'];
		}
	// cover
	$filename = 'images/covers/'.$id.".jpg";
	$filename2 = 'images/covers/'.$id.".gif";
	if(!file_exists($filename2)){
		if(!file_exists($filename)){
				$cover = "images/me.jpg";
			}else{
				$cover = 'images/covers/'.$id.".jpg?r=".substr(str_shuffle($permitted_chars), 16, 16)."";
			}
	}else{
		$cover = 'images/covers/'.$id.".gif?r=".substr(str_shuffle($permitted_chars), 16, 16)."";
	}
	
		// badge
		$icon = '';
		if(!empty($badge)){
			switch($badge){
				case 1:
					$icon = '<img class="verify" src="images/verified.jpg" title="Страница верифицирована администрацией Follow.gq">';
					break;
				case 2:
					$icon = '<img class="verify" src="images/star.jpg" title="Страница принадлежит администрации Follow.gq">';
					break;
			}
		}
?>
<style>
.verify{
	width: 30px;
	margin: 0px 10px;
}
</style>
<?
		echo'<title>'.$name.' | Follow.gq</title>';
		echo'
		<!-- Nav -->
					<nav id="nav">
						<a href="#" class="icon solid fa-home"><span>Home</span></a>';
						if(!empty($user['discord'])){
						echo'<a class="icon brands fa-discord"><span style="width: auto">&nbsp;'.$discord.'&nbsp;</span></a>';
						}
						if(!empty($user['telegram'])){
						echo'<a href="'.$tg.'" class="icon brands fa-telegram"><span>Telegram</span></a>';
						}
						if(!empty($user['git'])){
						echo'<a href="'.$git.'" class="icon brands fa-github"><span>GitHub</span></a>';
						}
						if(!empty($user['vk'])){
						echo'<a href="'.$vk.'" class="icon brands fa-vk"><span>VK</span></a>';
						}
						if($_SESSION["id"] == $user['id']){
							echo '<a href="auth/settings.php" class="icon solid fa-cog"><span>Settings</span></a>';
						}
						echo'<a href="/" class="icon solid fa-window-close"><span>Close</span></a>
					</nav>
			
				<!-- Main -->
					<div id="main">
							<article id="home" class="panel intro">
								<header>
									<h1>'.$name.''.$icon.'</h1>
									<p>'.$status.'</p>
								</header>
								<a class="jumplink pic">
									<img src="'.$cover.'" alt="" />
								</a>
							</article>';
		}else{
			echo'<title>Ошибка | Follow.gq</title>';
			echo'			
				<!-- Main -->
					<div id="main">
			                <article class="panel intro">
								<header>
								    <h1>Ошибка</h1>
									<p>Пользователя не существует. <a href="/">Перейти на главную</a></p>
								</header>
							</article>';
		}
}else{
	echo'<title>Главная | Follow.gq</title>';
	echo'			
				<!-- Main -->
					<div id="main">
						<article class="panel">
							<header>
								<h2>Добро пожаловать!</h2>
							</header>
								<p>Follow.gq - сервис, c помощью которого вы легко и удобно сможете организовать ваши контактные данные в виде социальных сетей в собственном профиле.</p>
									<div class="col-12">';	
						if(!empty($_SESSION["id"]) AND $_SESSION["id"] != 0){
						$id = htmlspecialchars($_SESSION["id"]);
						$query = $db->prepare("SELECT name FROM users WHERE id = :id"); 
						$query->execute([':id' => $id]);
						$name = $query->fetchColumn();
							echo '<a href="auth/logout.php"><input type="submit" value="Выйти" /></a>
								<a href="/'.$name.'"><input type="submit" value="Мой профиль" /></a>
							';
						}else{
								echo'	<a href="auth/login.php"><input type="submit" value="Войти" /></a>
										<a href="auth/register.php"><input type="submit" value="Зарегистрироваться" /></a>';
						}
						echo'		</div>
						</article>';
}
echo'</div>
				<!-- Footer -->
					<div id="footer">
						<ul class="copyright">
							<li>&copy; Chernov Studio, 2021</li>
						</ul>
					</div>
					
</div>
					
		<!-- Scripts -->
			<script src="incl/js/jquery.min.js"></script>
			<script src="incl/js/browser.min.js"></script>
			<script src="incl/js/breakpoints.min.js"></script>
			<script src="incl/js/util.js"></script>
			<script src="incl/js/main.js"></script>

	</body>
</html>';