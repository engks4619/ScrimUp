<?php
if (isset($_POST['submit'])){
	
	$teamname = $_POST['teamname'];
	$newFileName = $teamname;
	if(empty($newFileName)){
		$newFileName="team";
	}else{
		$newFileName=strtolower(str_replace(" ","_", $newFileName));
	}
	$gamecategory = $_POST['gamecategory'];
	$teamleader = $_POST['userprofile'];
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

	$allowed=$array("jpg","jpeg","png");

	if(in_array($fileActualExt, $allowed)){
		if($fileError===0){
			if($fileSize < 99999999999999){
				$imageFullName = $newFileName.".".uniqid("",true).$fileActualExt;
				$fileDestination = "../upload/teamProfileImg/".$imageFullName;
				
				include "../dbcon.php";

				if(empty($teamname)){
					echo "팀 명을 입력해주세요!";
					header("Location: ../party.php?upload=empty");
					exit();
				}else{
					try { 
						$stmt = $con->prepare('select * from teams');	
						$stmt->execute();

				   } catch(PDOException $e) {
						die("Database error: " . $e->getMessage()); 
				   }
				  		$row = $stmt->fetch();
						$rowCount = $stmt->rowCount();
						$setImageOrder = $rowCount + 1;
						$stmt = $con->prepare("INSERT INTO teams (teamName, teamLeader, gameCategory, teamDesc, imgFullNaemTeam, orderTeam, platform_discord, platform_battlenet) VALUES('$teamname','$teamleader','$gamecategory','$teamdesc','$imageFullName','$setImageOrder','$platformdiscord','$platformbattlenet');");
					  	$stmt->execute(); 	
						move_uploaded_file($fileTempName, $fileDestination);

							header("Location:../party.php?upload=success");
						}
					
				}


			}else{
				echo "파일사이즈가 너무 큽니다!"
			}
		}else{
			echo "이미지 업로드 오류!"
			exit();
		}
	}else{
		echo "지원하지 않는 파일 확장자입니다!";
		exit();
	}
	
}else{
	echo "안되지롱";
}
?>
