<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>ScrimMatchUp</title> 
		<?php
	ob_start();
	include('dbcon.php'); 
	include('check.php');
	include('left_nav.php');


	?>  
	<style>
		.body, html{
			background: rgb(26, 29, 33) !important;        
			font-family: trade-gothic-next, "Noto Sans", "Malgun Gothic", "맑은 고딕", sans-serif;		       
			overflow: scroll;
		}
		.body, html::-webkit-scrollbar {
			display: none; /* Chrome, Safari, Opera*/
		}
		.btn-red{
			border: 1px solid transparent;
			width: 130px;
			height: 35px;
			font-size: 20px;
			font-weight: bold;
			background-color: #c71f1f;
			color: hsla(0,0%,100%,.8);
			border-radius: 2px;
			text-align: center;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;	
			cursor:pointer;		    
		}
		.btn-imgUpload{
			margin-top: 10px;
			border: 1px solid transparent;
			width: 120px;
			height: 25px;
			font-size: 15px;
			font-weight: bold;
			background-color: #3b3e43;
			color: hsla(0,0%,100%,.8);
			border-radius: 2px;
			text-align: center;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;	
			cursor:pointer;
		}
		.right-nav{
			color: white;
			position: fixed; 
			overflow: scroll;	     		
			z-index: 1000;
			width: 375px;
			top: 0;
			right: 0;
			bottom: 0;
			background-color: #0f1415;
			overflow-x: hidden;
			transition: 0.3s;
			-ms-overflow-style: none; /* IE and Edge */
			scrollbar-width: none; /* Firefox */ 
		}
		.right-nav::-webkit-scrollbar {
			display: none; /* Chrome, Safari, Opera*/
		}
		.right-nav .closebtn {
			position: absolute;
			top: 10px;
			right: 40px;
			font-size: 36px;
			margin-left: 50px;
		}
		.input{
			margin-top: 10px;
			width: 300px;
			height: 30px;			    
			background-color: rgba(255, 255, 255, 0.04);
			color: rgb(255, 255, 255);
			font-family: trade-gothic-next, "Noto Sans", "Malgun Gothic", "맑은 고딕", sans-serif;
			font-size: 14px;
			border-top: 0px;
			border-left: 0px;
			border-right: 0px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
			border-radius: 6px;
		}
		.input-select{	
			margin-top: 10px;			
			width: 300px;
			height: 35px;			    
			background-color: rgba(255, 255, 255, 0.04);
			color: rgb(255, 255, 255);
			font-family: trade-gothic-next, "Noto Sans", "Malgun Gothic", "맑은 고딕", sans-serif;
			font-size: 14px;
			border-top: 0px;
			border-left: 0px;
			border-right: 0px;
			border-bottom: 1px solid rgba(255, 255, 255, 0.1);
			border-radius: 6px;
		}
		select.input-select option
		{
			background-color: #1a1d21;
		}			
		.form-group{		
			width: 300px;				
			border-bottom: 1px solid #8c8c8c;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.form-group-last{		
			width: 300px;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.btn-right-nav{
			z-index: 1;
			position: fixed;
			color: white;
			top:20px;
			right:20px;
			font-size:30px;
			cursor:pointer;

		}


		.team-container{
			position: absolute;
			top: 50px;
			left:200px;
			text-align: left;
			width: 400px;
		}

		.team-container a:hover{
			opacity: 0.8;
		} 
		.team-container a div{		      	     	
			width: 90px;
			height: 90px;
			background-color: white;
			background-position: no-repeat;
			background-size: cover;	
			border-radius: 10px;     
		}
		#memberlist {
		width: 460px;
		margin: 40px auto;
		background: #f3f3f3;
		border: 1px solid #d8d8d8;
		text-align: center;
		}
		#memberlist div {
		    position: relative;
		    display: inline-block;
		}
		.arrow_box {
		  z-index: 1001;
		  display: none;
		  position: absolute;  
		  width: 160px;
		  padding: 8px;
		  left: 0;
		  -webkit-border-radius: 8px;
		  -moz-border-radius: 8px;  
		  border-radius: 8px;
		  background: #333;
		  color: #fff;
		  font-size: 14px;
		}
		#memberlist span {
		    display: block;
		    width: 10px;
		    padding: 2px 16px;
		    cursor: pointer;
		}
		span:hover + p.arrow_box {
		  display: block; 
		}
	</style>

</head>
<body>
	<center>
		<div class="container">	

			<?php
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
				$uid = $row['uid'];
			}else{
				$userprofile = "";
			}
			include_once("upload/dbh.inc.php");
			echo '<div class="team-container">';
			echo '<div style="margin-bottom:10px; font-weight:bold; font-size:20px; color:white;"> 오버워치 </div>';
			$sql= "SELECT * FROM teams WHERE gameCategory='오버워치' ORDER BY orderTeam DESC;";
			$stmt = mysqli_stmt_init($conn);				
			if(!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL 오류!";
			} else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				while($row2 = mysqli_fetch_assoc($result)){
					$stmt = $con->prepare('select * from users where owTid=:owTid');
					$stmt->bindParam(':owTid',$row2['tid']);
					$stmt->execute();
					$memberCount = $stmt->rowCount();
					$TeamLeaderId=$row2["teamLeader"];
					$stmt = $con->prepare('select * from users where uid=:TeamLeaderId');
					$stmt->bindParam(':TeamLeaderId',$TeamLeaderId);
					$stmt->execute();
					$userinfo = $stmt->fetch();
					echo'
					<a href="?tid='.$row2['tid'].'">

					<table style="text-align: left;">
					<thead>
					<tr>
					<th rowspan="3"><div style= "background-image: url(upload/teamProfileImg/'.$row2["imgFullNameTeam"].');"></div></th>
					<th style="font-size:20px;">'.$row2["teamName"].'</th>
					</tr>
					<tr>
					<td>팀 리더: '.$userinfo['userprofile'].'</td>
					</tr>
					<tr>
					<td>멤버 수: '.$memberCount.'</td>
					</tr>
					</thead>
					</table>						
					</a>';
				}

			}
			echo '<div style="margin-top:20px; margin-bottom:10px; font-weight:bold; font-size:20px; color:white;"> 리그오브레전드 </div>';
			$sql= "SELECT * FROM teams WHERE gameCategory='리그오브레전드' ORDER BY orderTeam DESC;";
			$stmt = mysqli_stmt_init($conn);				
			if(!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL 오류!";
			} else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				while($row2 = mysqli_fetch_assoc($result)){
					$stmt = $con->prepare('select * from users where lolTid=:lolTid');
					$stmt->bindParam(':lolTid',$row2['tid']);
					$stmt->execute();
					$memberCount = $stmt->rowCount();
					$TeamLeaderId=$row2["teamLeader"];
					$stmt = $con->prepare('select * from users where uid=:TeamLeaderId');
					$stmt->bindParam(':TeamLeaderId',$TeamLeaderId);
					$stmt->execute();
					$userinfo = $stmt->fetch();
					echo'
					<a href="?tid='.$row2['tid'].'">

					<table style="text-align: left;">
					<thead>
					<tr>
					<th rowspan="3"><div style= "background-image: url(upload/teamProfileImg/'.$row2["imgFullNameTeam"].');"></div></th>
					<th style="font-size:20px;">'.$row2["teamName"].'</th>
					</tr>
					<tr>
					<td>팀 리더: '.$userinfo['userprofile'].'</td>
					</tr>
					<tr>
					<td>멤버 수: '.$memberCount.'</td>
					</tr>
					</thead>
					</table>						
					</a>';
				}

			}				
			?>					
		</div>
		<span class="btn-right-nav" onclick="openRightNav()"><a><</a></span>					
		<div id="right-nav" class="right-nav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeRightNav()">&times;</a> 
			<div>

				<div id="createteambtn" style="margin-top: 20px;"><a href="?action=teamgenerate" ><button class="btn-red">팀만들기</button></a></div>

			</div>
			<?php 			
			if(isset($_GET['tid'])){
				$tid=$_GET['tid'];
				try {
					$stmt = $con->prepare('select * from teams where tid=:tid');
					$stmt->bindParam(':tid',$tid);
					$stmt->execute();
					$teaminfo=$stmt->fetch();
					$gamecategory=$teaminfo['gameCategory'];
					switch($gamecategory){
						case '오버워치':
						$stmt = $con->prepare('select * from users where owTid=:tid');
						$stmt->bindParam(':tid',$teaminfo['tid']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
						$memberCount = $stmt->rowCount();
						echo '
						<div style="text-align:left; width:300px;">								
						<a style="position: absolute;top: 10px;left: 0px;font-size: 36px;margin-left: 50px;cursor:pointer;"href="party.php"">&lt;</a>
						<center><div><h2>팀 정보</h2><hr></div></center>
						<div style="text-align:center; margin-top:50px;"> <img src="upload/teamProfileImg/'.$teaminfo["imgFullNameTeam"].'" width="180px" height="180px"></div>
						<div>								
							<div>
							팀명<br> '.$teaminfo['teamName'].'
							</div>
							<div style="margin-top:20px;">
							게임<br> '.$teaminfo['gameCategory'].'
							</div>
							<div style="margin-top:20px;">
							팀소개<br> '.$teaminfo['teamDesc'].'
							</div>
							<div style="margin-top:20px;">
							팀 생성일 : '.$teaminfo['regtime'].'
							</div>	
							<div style="margin-top:20px;">멤버목록 / 멤버수 : '.$memberCount.'</div>
								<div class="memberlist">
								';
								$stmt = $con->prepare('select * from users where owTid=:tid');
								$stmt->bindParam(':tid',$teaminfo['tid']);
								$stmt->execute();
								while ($memberinfo = $stmt->fetch(PDO::FETCH_ASSOC)){
									echo '<div style="position: relative;">
		   								 <span style="display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001">
		   								 '.$memberinfo['userprofile'].'</span>
		   								 <p class="arrow_box"><img src="img/discord.png" width=20px"/> 디스코드<br>'.$memberinfo['discordname'].'<br>
		   								 <img src="img/battlenet.png" width=20px;/> 배틀넷<br>'.$memberinfo['battlenetname'].'</p>
		   								 </div>';
								}
								echo'
								</div>
							</div>
						
						</div>
						<center>
						<form action="joinparty.php"; method="POST";>
						<div style="align-items:center;position:absolute;left:132.5px;bottom:30px;">
						<input type="hidden" name="userprofile" value="'.$userprofile.'"/>
						<input type="hidden" name="gamecategory" value="오버워치"/>
						<input type="hidden" name="tid" value="'.$teaminfo['tid'].'"/>
						<button type="submit" name="jointeam" class="btn-red">가입하기</button></div></center>
						</form>
						</div>
						<div>
						'; 
						break;
						case '리그오브레전드':
						$stmt = $con->prepare('select * from users where lolTid=:tid');
						$stmt->bindParam(':tid',$teaminfo['tid']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
						$memberCount = $stmt->rowCount();
							echo '
						<div style="text-align:left; width:300px;">								
						<a style="position: absolute;top: 10px;left: 0px;font-size: 36px;margin-left: 50px;cursor:pointer;"href="party.php"">&lt;</a>
						<center><div><h2>팀 정보</h2><hr></div></center>
						<div style="text-align:center; margin-top:50px;"> <img src="upload/teamProfileImg/'.$teaminfo["imgFullNameTeam"].'" width="180px" height="180px"></div>
						<div>								
							<div>
							팀명<br> '.$teaminfo['teamName'].'
							</div>
							<div style="margin-top:20px;">
							게임<br> '.$teaminfo['gameCategory'].'
							</div>
							<div style="margin-top:20px;">
							팀소개<br> '.$teaminfo['teamDesc'].'
							</div>
							<div style="margin-top:20px;">
							팀 생성일 : '.$teaminfo['regtime'].'
							</div>	
							<div style="margin-top:20px;">멤버목록 / 멤버수 : '.$memberCount.'</div>
								<div class="memberlist">
								';
								$stmt = $con->prepare('select * from users where lolTid=:tid');
								$stmt->bindParam(':tid',$teaminfo['tid']);
								$stmt->execute();
								while ($memberinfo = $stmt->fetch(PDO::FETCH_ASSOC)){
									echo '<div style="position: relative;">
		   								 <span style="display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001">
		   								 '.$memberinfo['userprofile'].'</span>
		   								 <p class="arrow_box"><img src="img/discord.png" width=20px"/> 디스코드<br>'.$memberinfo['discordname'].'<br>
		   								 <img src="img/battlenet.png" width=20px;/> 배틀넷<br>'.$memberinfo['battlenetname'].'</p>
		   								 </div>';
								}
								echo'
								</div>
							</div>
						
						</div>
						<center>
						<form action="joinparty.php"; method="POST";>
						<div style="align-items:center;position:absolute;left:132.5px;bottom:30px;">
						<input type="hidden" name="userprofile" value="'.$userprofile.'"/>
						<input type="hidden" name="gamecategory" value="리그오브레전드"/>
						<input type="hidden" name="tid" value="'.$teaminfo['tid'].'"/>
						<button type="submit" name="jointeam" class="btn-red">가입하기</button></div></center>
						</form>
						</div>
						<div>
						'; 

						break;
					}



				} catch(PDOException $e) {
					die("Database error: " . $e->getMessage()); 
				}
				$row3 = $stmt->fetch();				   

				$memberCount = $stmt->rowCount();
				echo'<div id="team-info">

				</div>';
			}

				if(isset($_GET['action'])=='teamgenerate'){
					if(empty($_SESSION['user_id'])){header('Location:login.php?action=needlogin');}
				else{						
					echo '<script>"#createteambtn").css("display") = "block";</script>'; // display 속성을 none 으로 바꾼다. 			
					echo'
					<div id="team-generate">
					<a style="position: absolute;top: 10px;left: 0px;font-size: 36px;margin-left: 50px;cursor:pointer;"onclick="history.back();">&lt;</a>				
					<form action="upload/createparty.php"style="width: 300px; "method="POST" enctype="multipart/form-data">
					<h2>팀 생성</h2><hr>
					<div class="form-group">
					<div style="text-align: left;"><label for="teamname">팀명</label></div>
					<div><input type="text" name="teamname"  class="input" id="team" placeholder="  팀명을 입력하세요." 
					required autocomplete="off" maxlength="15"/></div>
					<div style=" text-align:left; margin-top: 10px; font-size:15px; color:hsla(0,0%,100%,.5); ">글자수 15자 제한</div>
					</div>
					<div class="form-group" >
					<div style="text-align: left;"><label for="gamecategory">게임</label></div>
					<div>
					<select class="input-select" id="gamecategory" name="gamecategory">
					<option value="오버워치" selected>오버워치</option>
					<option value="리그오브레전드">리그오브레전드</option>
					</select>								
					</div>
					</div>
					<div class="form-group" >
					<div style="text-align: left;"><label for="file">팀 프로필 이미지</label></div>
					<div style="margin-top: 10px;"><input type="file" name="file" id="file" ></div>
					<div style="text-align:left; margin-top: 10px; font-size:15px; color:hsla(0,0%,100%,.5); ">JPG, JPEG, PNG 확장자, 1MB 미만</div>
					</div>
					<div class="form-group" >
					<div style="text-align: left;"><label for="teamdesc">팀 소개</label></div>
					<div><input type="text" name="teamdesc"  class="input" id="teamdesc" placeholder="  팀 소개를 입력하세요." 
					required autocomplete="off" maxlength="120" /></div>
					<div style="text-align:left; margin-top: 10px; font-size:15px; color:hsla(0,0%,100%,.5); ">글자수 120자 제한</div>
					</div>
					<div class="form-group-last">
					<div style="text-align: left;"><label for="platform">플랫폼 제한</label></div>
					<div style="text-align:left; margin-top: 10px;">
					<input type="checkbox" name="platformdiscord" value="1"/>디스코드
					<input type="checkbox" name="platformbattlenet" value="1"/>배틀넷
					</div>
					<input type="hidden" name="uid" value="'.$uid.'"/>
					</div>		

					</br>
					<div>						
					<button type="submit" name="createTeam" class="btn-red" >확인</button>

					</div>
					</br>
					</form>
					</div>
					';

				}
			}
		
		if(isset($_GET['upload'])){
			if($_GET['upload']=="success"){echo "<script>alert('팀 생성 완료!')</script>";}			
		}
		if(isset($_GET['join'])){
			if($_GET['join']=="success"){echo "<script>alert('팀 가입 완료!')</script>";}
		}		
		
		if(isset($errMSG)){
			echo "<script>alert('$errMSG');	</script>";
		}
				
				?>
			</div>
		</center>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script>
			var para = document.location.href.split("?")[1];

			if(para=="action=teamgenerate"||para.includes('tid')){
				$("#createteambtn").hide();
			}else{
				$("#createteambtn").show();
			}		
			function openRightNav() {
				document.getElementById("right-nav").style.width = "375px";
			}

			function closeRightNav() {
				document.getElementById("right-nav").style.width = "0";
			}
			$(document).ready(function(){ $('#teamname').keyup(function(){ if ($(this).val().length > $(this).attr('maxlength')) { alert('제한길이 초과'); $(this).val($(this).val().substr(0, $(this).attr('maxlength'))); } }); });
			$(document).ready(function(){ $('#teamdesc').keyup(function(){ if ($(this).val().length > $(this).attr('maxlength')) { alert('제한길이 초과'); $(this).val($(this).val().substr(0, $(this).attr('maxlength'))); } }); });
		</script>	 	
	</body>
	</html>
