<?php
if (isset($_POST['createTeam'])){
	
	$teamname = $_POST['teamname'];
	$newFileName = $teamname;
	if(empty($newFileName)){
		$newFileName="team";
	}else{
		$newFileName=strtolower(str_replace(" ","_", $newFileName));
	}
	$gamecategory = $_POST['gamecategory'];
	$teamleader = $_POST['uid'];
	$teamdesc = $_POST['teamdesc'];
	$platformdiscord = $_POST['platformdiscord'];
	$platformbattlenet = $_POST['platformbattlenet'];
	$file=$_FILES['file'];

	$fileName=$file["name"];
	$fileType=$file["type"];
	$fileTempName=$file["tmp_name"];
	$fileError=$file["error"];
	$fileSize=$file["size"];

	$fileExt=explode(".", $fileName);
	$fileActualExt= strtolower(end($fileExt));

	$allowed= array("jpg","jpeg","png");

	if(in_array($fileActualExt, $allowed)){
		if($fileError===0){
			if($fileSize < 1000000){
				$imageFullName = $newFileName.uniqid("",true).".".$fileActualExt;
				$fileDestination = "../upload/teamProfileImg/".$imageFullName;
				
				include_once "../dbcon.php";


				if(isset($_SESSION['user_id'])){
					$user_id = $_SESSION['user_id'];

					try { 
						$stmt = $con->prepare('select * from users where username=:username');
						$stmt->bindParam(':username', $user_id);
						$stmt->execute();

					} catch(PDOException $e) {
						die("Database error: " . $e->getMessage()); 
					}
					$row = $stmt->fetch();
					$userprofile = $row['userprofile'];

					try { 
						$stmt = $con->prepare('select * from teams where teamName=:teamname && gameCategory=:gamecategory');
						$stmt->bindParam(':gamecategory', $gamecategory);
						$stmt->bindParam(':teamname', $teamname);
						$stmt->execute();

					} catch(PDOException $e) {
						die("Database error: " . $e->getMessage()); 
					}
					$teaminfo = $stmt->fetch();
					$teamCount = $stmt->rowCount();

				}
				if(empty($_SESSION['user_id'])){
					$errMSG = "로그인이 필요한 서비스입니다!";
				}else{
					if(empty($teamname)){
						$errMSG = "팀 명을 입력해주세요!";
					}else if($teamCount>0){
						$errMSG = "이미 존재하는 팀명입니다!";
					}else{
						if($row['owTeam']!=NULL&&$gamecategory=="오버워치"){
							$errMSG = "오버워치팀에 이미 속해있습니다!";
						}
						else if($row['lolTeam']!=NULL&&$gamecategory=="리그오브레전드"){
							$errMSG = "리그오브레전드팀에 이미 속해있습니다!";
						}else{
							
							$sql= "SELECT * FROM teams;";
							include_once "../upload/dbh.inc.php";
							$stmt = mysqli_stmt_init($conn);
							if(!mysqli_stmt_prepare($stmt, $sql)){
								$errMSG = "팀 생성 실패!";
							}else{
								mysqli_stmt_execute($stmt);
								$result=mysqli_stmt_get_result($stmt);
								$rowCount = mysqli_num_rows($result);
								$setImageOrder = $rowCount + 1;

								$sql = "INSERT INTO teams(teamName, teamLeader, gameCategory, teamDesc, imgFullNameTeam, orderTeam, platform_discord, platform_battlenet) VALUES(?,?,?,?,?,?,?,?);";
								if(!mysqli_stmt_prepare($stmt,$sql)){
									$errMSG = "팀 생성 실패!!";

								}else{
									mysqli_stmt_bind_param($stmt, "ssssssii",$teamname,$teamleader,$gamecategory,$teamdesc,$imageFullName,$setImageOrder,$platformdiscord,$platformbattlenet);
									mysqli_stmt_execute($stmt);
									$tid=$conn->insert_id;



									move_uploaded_file($fileTempName, $fileDestination);

									header("Location:../party.php?upload=success");
								}
							}
							switch ($gamecategory) {
								case '오버워치':
								$stmt = $con->prepare("UPDATE users SET owTid = '$tid' WHERE username=:username");
								$stmt->bindParam(':username', $user_id);
								$stmt->execute();
								break;
								case '리그오브레전드':
								$stmt = $con->prepare("UPDATE users SET lolTid = '$tid' WHERE username=:username");
								$stmt->bindParam(':username', $user_id);
								$stmt->execute();
								break;
								default:
								$errMSG = "잘못된 게임카테고리입니다!";
								break;
							}
						}


					}
				}

			}else{
				$errMSG = "파일사이즈가 너무 큽니다!";
			}
		}else{
			$errMSG = "이미지 업로드 오류!";
			
		}
	}else{
		$errMSG = "지원하지 않는 파일 확장자입니다!";		
	}
	if(isset($errMSG)){
		echo "<script>alert('$errMSG'); 
		document.location='../party.php?upload=fail';
		</script>";

	}
	
}
?>
