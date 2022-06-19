<?php
if(isset($_POST['jointeam'])){
	include_once ('dbcon.php');
	if($_POST['userprofile']==""||empty($_SESSION['user_id'])){
		$errMSG = "로그인이 필요합니다";
	}else{
		$usernickname=$_POST['userprofile'];
		$gamecategory=$_POST['gamecategory'];
		$tid=$_POST['tid'];
		if(isset($_SESSION['user_id'])){
			$user_id = $_SESSION['user_id'];					
			try { 
				$stmt = $con->prepare('select * from users where username=:username');
				$stmt->bindParam(':username', $user_id);
				$stmt->execute();

			} catch(PDOException $e) {
				die("Database error: " . $e->getMessage()); 
			}
			$userinfo = $stmt->fetch();
			$userprofile = $userinfo['userprofile'];
			switch ($gamecategory) {
				case '오버워치':
				if($userinfo['owTid']!=NULL){
					$errMSG = "오버워치팀에 이미 속해있습니다!";
				}else{
					try { 
						$stmt = $con->prepare('UPDATE users SET owTid=:tid WHERE username=:username');
						$stmt->bindParam(':tid', $tid);
						$stmt->bindParam(':username', $user_id);
						$stmt->execute();

					} catch(PDOException $e) {
						die("Database error: " . $e->getMessage()); 
					}
					header("Location:../party.php?join=success");
				}
				break;

				case '리그오브레전드':
				if($userinfo['lolTid']!=NULL){
					$errMSG = "리그오브레전드팀에 이미 속해있습니다!";
				}else{
					try { 
						$stmt = $con->prepare('UPDATE users SET lolTid=:tid WHERE username=:username');
						$stmt->bindParam(':tid', $tid);
						$stmt->bindParam(':username', $user_id);
						$stmt->execute();

					} catch(PDOException $e) {
						die("Database error: " . $e->getMessage()); 
					}
					header("Location:../party.php?join=success");
				}
				break;
			}

		}	



	}
	if(isset($errMSG)){
		echo "<script>alert('$errMSG'); 
		document.location='../party.php?join=fail';
		</script>";
	}

}

?>
