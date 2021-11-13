<?php
error_reporting(0);
class generatePass
{
	public function isValidUsrname($userName, $pass) {
		include dirname(__FILE__)."/connection.php";
		$ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$newtime = time() - (60*60);
			$query = $db->prepare("SELECT id, salt, password FROM users WHERE name LIKE :userName");
			$query->execute([':userName' => $userName]);
			if($query->rowCount() == 0){
				return 0;
			}
			$result = $query->fetch();
			if(password_verify($pass, $result["password"])){
				$query = $db->prepare("UPDATE users SET ip=:ip WHERE name=:userName");
				$query->execute([':userName' => $userName, ':ip'=> $ip]);
				return 1;
			}else{
				$md5pass = md5($pass . "epithewoihewh577667675765768rhtre67hre687cvolton5gw6547h6we7h6wh");
				CRYPT_BLOWFISH or die ('-2');
				$Blowfish_Pre = '$2a$05$';
				$Blowfish_End = '$';
				$hashed_pass = crypt($md5pass, $Blowfish_Pre . $result['salt'] . $Blowfish_End);
				if ($hashed_pass == $result['password']) {
					$pass = password_hash($pass, PASSWORD_DEFAULT);
					//updating hash
					$query = $db->prepare("UPDATE users SET password=:password,ip=:ip WHERE name=:userName");
					$query->execute([':userName' => $userName, ':ip'=> $ip, ':password' => $pass]);
					return 1;
				} else {
					if($md5pass == $result['password']){
						$pass = password_hash($pass, PASSWORD_DEFAULT);
						//updating hash
						$query = $db->prepare("UPDATE users SET password=:password,ip=:ip WHERE name=:userName");
						$query->execute([':userName' => $userName, ':ip'=> $ip, ':password' => $pass]);
						return 1;
					} else {
						return 0;
					}
				}
			}
	}
	public function isValid($accid, $pass){
		include dirname(__FILE__)."/connection.php";
		$query = $db->prepare("SELECT name FROM users WHERE id = :accid");
		$query->execute([':accid' => $accid]);
		if($query->rowCount() == 0){
			return 0;
		}
		$result = $query->fetch();
		$userName = $result["name"];
		$generatePass = new generatePass();
		return $generatePass->isValidUsrname($userName, $pass);
	}
}
?>