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
if(isset($_SESSION["id"]) AND $_SESSION["id"] != 0){
		$session = htmlspecialchars($_SESSION["id"]);	
		$query = $db->prepare("SELECT * FROM users WHERE id = :id"); 
	    $query->execute([':id' => $session]);
	    $result = $query->fetchAll();
		foreach($result as &$user){
			$name = $user['name'];
		}
		if(!empty($user['discord'])){
			$displaydiscord = $user['discord'];
		}else{
			$displaydiscord = 'Введите Discord';
		}
		if(!empty($user['telegram'])){
			$displaytg = $user['telegram'];
		}else{
			$displaytg = 'Введите Telegram';
		}
		if(!empty($user['vk'])){
			$displayvk = $user['vk'];
		}else{
			$displayvk = 'Введите VK';
		}
		if(!empty($user['git'])){
			$displaygit = $user['git'];
		}else{
			$displaygit = 'Введите GitHub';
		}
		if(!empty($user['status'])){
			$displaystatus = $user['status'];
		}else{
			$displaystatus = 'Введите статус (описание)';
		}
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
	$discord = htmlspecialchars($_POST["discord"]);
	$tg = htmlspecialchars($_POST["telegram"]);
	$vk = htmlspecialchars($_POST["vk"]);
	$git = htmlspecialchars($_POST["git"]);
	$status = htmlspecialchars($_POST["status"]);
	if(!empty($discord)){
		$query = $db->prepare("UPDATE users SET discord = :discord WHERE id = :id");
	$query->execute([':discord' => $discord, ':id' => $session]);
	}
	if(!empty($tg)){
		$query = $db->prepare("UPDATE users SET telegram = :tg WHERE id = :id");
	$query->execute([':tg' => $tg, ':id' => $session]);
	}
	if(!empty($vk)){
		$query = $db->prepare("UPDATE users SET vk = :vk WHERE id = :id");
	$query->execute([':vk' => $vk, ':id' => $session]);
	}
	if(!empty($git)){
		$query = $db->prepare("UPDATE users SET git = :git WHERE id = :id");
	$query->execute([':git' => $git, ':id' => $session]);
	}
	if(!empty($status)){
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
