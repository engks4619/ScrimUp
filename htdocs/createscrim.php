<?php
if (isset($_POST['createScrim'])){
	include_once "dbcon.php";

	$scrimname = $_POST['scrimname'];
	$scrimdesc = $_POST['scrimdesc'];
	$gamecategory = $_POST['gamecategory'];
	$gameproceed = $_POST['gameproceed'];
	$scrimtime = $_POST['scrimtime'];
	$scrimtype = $_POST['scrimtype'];
	$scrimgenerator = $_POST['userprofile'];

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

		if(empty($scrimname)){
			$errMSG = "팀 명을 입력해주세요!";
		}else{
			##오버워치인 경우
			if($gamecategory=='오버워치'){				
				if($scrimgenerator==$userprofile){
					if($scrimtype==0){
						switch ($gameproceed) {
							case '3탱 3힐':
							try {
								$stmt = $con->prepare("INSERT INTO scrims(scrimName, scrimGenerator, scrimDesc, gameCategory, gameProceed, scrimTime, scrimType) VALUES('$scrimname','$scrimgenerator','$scrimdesc','$gamecategory','$gameproceed','$scrimtime','$scrimtype')");
								$stmt->execute();
								$osid = $con->lastInsertId();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							try { 
								$stmt = $con->prepare("INSERT INTO ow33individualscrim(osid) VALUES('$osid')");
								$stmt->execute();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							header("Location:scrim.php?create=success");
							break;
							case '2탱 2딜 2힐':
							try { 
								$stmt = $con->prepare("INSERT INTO scrims(scrimName, scrimGenerator, scrimDesc, gameCategory, gameProceed, scrimTime, scrimType) VALUES('$scrimname','$scrimgenerator','$scrimdesc','$gamecategory','$gameproceed','$scrimtime','$scrimtype')");
								$stmt->execute();
								$osid = $con->lastInsertId();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}

							try { 
								$stmt = $con->prepare("INSERT INTO ow222individualscrim(osid) VALUES('$osid')");
								$stmt->execute();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							header("Location:scrim.php?create=success");
							break;
							case '제한 없음':
							try { 
								$stmt = $con->prepare("INSERT INTO scrims(scrimName, scrimGenerator, scrimDesc, gameCategory, gameProceed, scrimTime, scrimType) VALUES('$scrimname','$scrimgenerator','$scrimdesc','$gamecategory','$gameproceed','$scrimtime','$scrimtype')");
								$stmt->execute();
								$osid = $con->lastInsertId();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							try { 
								$stmt = $con->prepare("INSERT INTO ownolimitindividualscrim(osid) VALUES('$osid')");
								$stmt->execute();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							header("Location:scrim.php?create=success");
							break;

							default:
							$errMSG="올바른 게임 진행 방식이 아닙니다.";
							break;
						}
					}else if($scrimtype==1){
						try { 
							$stmt = $con->prepare("INSERT INTO scrims(scrimName, scrimGenerator, scrimDesc, gameCategory, gameProceed, scrimTime, scrimType) VALUES('$scrimname','$scrimgenerator','$scrimdesc','$gamecategory','$gameproceed','$scrimtime','$scrimtype')");
							$stmt->execute();
							$osid = $con->lastInsertId();
						} catch(PDOException $e) {
							die("Database error: " . $e->getMessage()); 
						}
						try { 
							$stmt = $con->prepare("INSERT INTO owteamscrim(osid) VALUES('$osid')");
							$stmt->execute();
						} catch(PDOException $e) {
							die("Database error: " . $e->getMessage()); 
						}
						header("Location:scrim.php?create=success");
					}					

				}else{$errMSG = "부적절한 접근입니다!";}

			}else if($gamecategory=='리그오브레전드'){
				##리그오브레전드인 경우
				if($scrimgenerator==$userprofile){
					if($scrimtype==0){
						try {
								$stmt = $con->prepare("INSERT INTO scrims(scrimName, scrimGenerator, scrimDesc, gameCategory, gameProceed, scrimTime, scrimType) VALUES('$scrimname','$scrimgenerator','$scrimdesc','$gamecategory','$gameproceed','$scrimtime','$scrimtype')");
								$stmt->execute();
								$lsid = $con->lastInsertId();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							try { 
								$stmt = $con->prepare("INSERT INTO lolindividualscrim(lsid) VALUES('$lsid')");
								$stmt->execute();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							header("Location:scrim.php?create=success");
					}else if($scrimtype==1){
						try {
								$stmt = $con->prepare("INSERT INTO scrims(scrimName, scrimGenerator, scrimDesc, gameCategory, gameProceed, scrimTime, scrimType) VALUES('$scrimname','$scrimgenerator','$scrimdesc','$gamecategory','$gameproceed','$scrimtime','$scrimtype')");
								$stmt->execute();
								$lsid = $con->lastInsertId();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							try { 
								$stmt = $con->prepare("INSERT INTO lolteamscrim(lsid) VALUES('$lsid')");
								$stmt->execute();
							} catch(PDOException $e) {
								die("Database error: " . $e->getMessage()); 
							}
							header("Location:scrim.php?create=success");
					}

				}else{$errMSG = "부적절한 접근입니다.";}
				
			}else{$errMSG = "올바른 게임 카테고리가 아닙니다.";}
		}

	}else{
		$errMSG = "로그인이 필요한 서비스입니다!";
	}	
	if(isset($errMSG)){
		echo "<script>alert('$errMSG'); 
		document.location='scrim.php?create=fail';
		</script>";
	}

}
?>
