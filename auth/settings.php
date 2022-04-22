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
if(isset($_SESSION["id"]) AND $_SESSION["id"] != 0){
	$session = $_SESSION["id"];	
	$query = $db->prepare("SELECT * FROM users WHERE id = :id"); 
	$query->execute([':id' => $session]);
	$result = $query->fetchAll();
	foreach($result as &$user){
		$name = $user['name'];
	}
	$displaydiscord = !empty($user['discord']) ? $user['discord'] : 'Введите Discord';
	$displaytg = !empty($user['telegram']) ? $user['telegram'] : 'Введите Telegram';
	$displayvk = !empty($user['vk']) ? $user['vk'] : 'Введите VK';
	$displaygit = !empty($user['git']) ? $user['git'] : 'Введите GitHub';
	$displaystatus = !empty($user['status']) ? $user['status'] : 'Введите статус (описание)';
	echo'
			<header>
				<h2>Настройки</h2>
			</header>
		<form method="post">
		<div>
		 <div class="row">
		 
			<div class="col-12">
			Discord:
			<input type="text" class="form-control" name="discord" id="name" placeholder="'.$displaydiscord.'">
			</div>
			
			<div class="col-12">
				Telegram:
				<input type="text" class="form-control" name="telegram" id="name" placeholder="'.$displaytg.'">
			</div>
			
			<div class="col-12">
				VK:
				<input type="text" class="form-control" name="vk" id="name" placeholder="'.$displayvk.'">
			</div>
			
			<div class="col-12">
				GitHub:
				<input type="text" class="form-control" name="git" id="name" placeholder="'.$displaygit.'">
			</div>
			<div class="col-12">
				Статус:
				<input type="text" class="form-control" name="status" id="name" placeholder="'.$displaystatus.'">
			</div>
			<div class="col-12">
				<input type="submit" value="Сохранить" />
			</div>
		  </div>	
		</div>
	</form>';
	
	if(!empty($_POST["discord"])){
		$discord = htmlspecialchars($_POST["discord"],ENT_QUOTES);
		$query = $db->prepare("UPDATE users SET discord = :discord WHERE id = :id");
		$query->execute([':discord' => $discord, ':id' => $session]);
	}
	if(!empty($_POST["telegram"])){
		$tg = htmlspecialchars($_POST["telegram"],ENT_QUOTES);
		$query = $db->prepare("UPDATE users SET telegram = :tg WHERE id = :id");
		$query->execute([':tg' => $tg, ':id' => $session]);
	}
	if(!empty($_POST["vk"])){
		$vk = htmlspecialchars($_POST["vk"],ENT_QUOTES);
		$query = $db->prepare("UPDATE users SET vk = :vk WHERE id = :id");
		$query->execute([':vk' => $vk, ':id' => $session]);
	}
	if(!empty($_POST["git"])){
		$git = htmlspecialchars($_POST["git"],ENT_QUOTES);
		$query = $db->prepare("UPDATE users SET git = :git WHERE id = :id");
		$query->execute([':git' => $git, ':id' => $session]);
	}
	if(!empty($_POST["status"])){
		$status = htmlspecialchars($_POST["status"],ENT_QUOTES);
		$query = $db->prepare("UPDATE users SET status = :status WHERE id = :id");
		$query->execute([':status' => $status, ':id' => $session]);
	}
}else{
	echo'Войдите в аккаунт, пожалуйста =)';
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
