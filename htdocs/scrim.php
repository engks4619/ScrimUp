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
			width: 1000px;
			font-size: 15px;
		}

		.team-container a:hover{
			opacity: 0.8;
		} 
		.team-container a {		      	     	
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
			text-align: left;
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;  
			border-radius: 8px;
			background: #333;
			color: #fff;
			font-size: 14px;
		}
		span:hover + p.arrow_box {
			display: block; 
		}
		#memberlist span {
			display: block;
			width: 10px;
			padding: 2px 16px;
			cursor: pointer;
		}
		
		.arrow_box2 {
			z-index: 1001;
			display: none;
			position: absolute;  
			width: 150px;
			padding: 8px;
			left: 50px;
			text-align: left;
			-webkit-border-radius: 8px;
			-moz-border-radius: 8px;  
			border-radius: 8px;
			background: #333;
			color: #fff;
			font-size: 14px;
		}
		span:hover + p.arrow_box2 {
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
			}else{
				$userprofile = "";
			}
			include_once("upload/dbh.inc.php");
			echo '<div class="team-container">';			
			echo '<div style="font-weight:bold; font-size:20px; color:white; border-bottom: 2px solid #8c8c8c;"> 오버워치 </div>';
			$sql= "SELECT * FROM scrims WHERE gameCategory='오버워치' && scrimTime>=NOW() ORDER BY scrimTime ASC;";
			$stmt = mysqli_stmt_init($conn);				
			if(!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL 오류!";
			} else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$weekString = array("일", "월", "화", "수", "목", "금", "토");
				while($scriminfo = mysqli_fetch_assoc($result)){					
					$day =$weekString[date('w', strtotime($scriminfo['scrimTime']))];
					if($scriminfo['scrimType']==0){
						$scrimtype="개인";
						$scrimtypeicon="/img/individual.png";
					}else{
						$scrimtype="팀";
						$scrimtypeicon="/img/team.png";
					}
					echo'
					<a href="?sid='.$scriminfo['sid'].'">
					<table style="width:1000px;border-bottom: 1px solid #8c8c8c;">
					<thead>
					<tr>
					<th rowspan="2" width=40px;><img src="'.$scrimtypeicon.'" width="30px" height="30px;"/></th>
					<th colspan="5" style="text-align:left; font-size:16px;">'.$scriminfo["scrimName"].'</th>
					<td style="text-align:right;">진행방식 : '.$scriminfo['gameProceed'].'</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;">생성자 : '.$scriminfo["scrimGenerator"].'</td>
					<td colspan="2" style="text-align:right;">시간 : '.$scriminfo['scrimTime'].' '.$day.'</td>
					</tr>
					</thead>
					</table>
					</a>						
					';
				}

			}
			echo '<div style="margin-top:30px;font-weight:bold; font-size:20px; color:white; border-bottom: 2px solid #8c8c8c;"> 리그오브레전드 </div>';
			$sql= "SELECT * FROM scrims WHERE gameCategory='리그오브레전드' && scrimTime>=NOW() ORDER BY scrimTime ASC;";
			$stmt = mysqli_stmt_init($conn);				
			if(!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL 오류!";
			} else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$weekString = array("일", "월", "화", "수", "목", "금", "토");
				while($scriminfo = mysqli_fetch_assoc($result)){					
					$day =$weekString[date('w', strtotime($scriminfo['scrimTime']))];
					if($scriminfo['scrimType']==0){
						$scrimtype="개인";
						$scrimtypeicon="/img/individual.png";
					}else{
						$scrimtype="팀";
						$scrimtypeicon="/img/team.png";
					}
					echo'
					<a href="?sid='.$scriminfo['sid'].'">
					<table style="width:1000px;border-bottom: 1px solid #8c8c8c;">
					<thead>
					<tr>
					<th rowspan="2" width=40px;><img src="'.$scrimtypeicon.'" width="30px" height="30px;"/></th>
					<th colspan="5" style="text-align:left; font-size:16px;">'.$scriminfo["scrimName"].'</th>
					<td style="text-align:right;">진행방식 : '.$scriminfo['gameProceed'].'</td>
					</tr>
					<tr>
					<td colspan="4" style="text-align:left;">생성자 : '.$scriminfo["scrimGenerator"].'</td>
					<td colspan="2" style="text-align:right;">시간 : '.$scriminfo['scrimTime'].' '.$day.'</td>
					</tr>
					</thead>
					</table>
					</a>						
					';
				}

			}				
			?>					
		</div>
		<span class="btn-right-nav" onclick="openRightNav()"><a><</a></span>					
		<div id="right-nav" class="right-nav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeRightNav()">&times;</a> 
			<div>

				<div id="cretescrimbtn" style="margin-top: 20px;"><a href="?action=scrimgenerate" ><button class="btn-red">스크림 개설</button></a></div>

			</div>
			<?php 			
			if(isset($_GET['sid'])){
				$sid=$_GET['sid'];
				try {
					$stmt = $con->prepare('select * from scrims where sid=:sid');
					$stmt->bindParam(':sid',$sid);
					$stmt->execute();
					$scriminfo=$stmt->fetch();
					$gamecategory=$scriminfo['gameCategory'];
				} catch(PDOException $e) {
					die("Database error: " . $e->getMessage()); 
				}
				switch($gamecategory){
					case '오버워치':						
					echo '
					<div style="text-align:left; width:400px;">								
					<a style="position: absolute;top: 10px;left: 0px;font-size: 36px;margin-left: 50px;cursor:pointer;"href="scrim.php"">&lt;</a>
					<center><div><h2>스크림 정보</h2><hr></div></center>									
					<div>
					스크림 명<br> '.$scriminfo['scrimName'].'
					</div>
					<div style="margin-top:20px;">
					개설자<br> '.$scriminfo['scrimGenerator'].'
					</div>
					<div style="margin-top:20px;">
					스크림 소개<br> '.$scriminfo['scrimDesc'].'
					</div>
					<div style="margin-top:20px;">
					스크림 시간 : '.$scriminfo['scrimTime'].'
					</div>	';
					include_once('owscrimjoin.php');
					break;

					case '리그오브레전드':
					$stmt = $con->prepare('select * from scrims where sid=:lsid');
					$stmt->bindParam(':lsid',$sid);
					$stmt->execute();
					$memberinfo=$stmt->fetch();
					$memberCount = $stmt->rowCount();
					echo '
					<div style="text-align:left; width:400px;">								
					<a style="position: absolute;top: 10px;left: 0px;font-size: 36px;margin-left: 50px;cursor:pointer;"href="scrim.php"">&lt;</a>
					<center><div><h2>스크림 정보</h2><hr></div></center>								
					<div>
					스크림 명<br> '.$scriminfo['scrimName'].'
					</div>
					<div style="margin-top:20px;">
					개설자<br> '.$scriminfo['scrimGenerator'].'
					</div>
					<div style="margin-top:20px;">
					스크림 소개<br> '.$scriminfo['scrimDesc'].'
					</div>
					<div style="margin-top:20px;">
					스크림 시간 : '.$scriminfo['scrimTime'].'
					</div>	';
					include_once('lolscrimjoin.php');
					break;
				}
				
			}

			if(isset($_SESSION['user_id'])){
				if(isset($_GET['action'])=='scrimgenerate'){
					if(empty($_SESSION['user_id'])){
						$errMSG = "로그인이 필요합니다.";
						echo "<script>alert('$errMSG');	</script>";
					}else{						
					echo '<script>("#cretescrimbtn").css("display") = "block";</script>'; // display 속성을 none 으로 바꾼다. 
					echo'
					<div id="team-generate">
					<a style="position: absolute;top: 10px;left: 0px;font-size: 36px;margin-left: 50px;cursor:pointer;"onclick="history.back();">&lt;</a>				
					<form name="form" action="createscrim.php"style="width: 300px; "method="POST" enctype="multipart/form-data">
					<h2>스크림 개설</h2><hr>
					
					<div class="form-group">
					<div style="text-align: left;"><label for="scrimtype">스크림 종류</label></div>
					<div style="text-align:left; margin-top: 10px;">
					<input type="radio" id="individual" name="scrimtype" value="0" checked="checked"/><span>개인</span>
					<input type="radio" id="team" name="scrimtype" value="1" /><span>팀</span>
					</div>
					</div>	

					<div class="form-group" >
					<div style="text-align: left;"><label for="scrimname">스크림 명</label></div>
					<div><input type="text" name="scrimname"  class="input" id="scrimname" placeholder="  스크림 명을 입력하세요." 
					required autocomplete="off" maxlength="25"/></div>
					<div style="text-align:left; margin-top: 10px; font-size:15px; color:hsla(0,0%,100%,.5); ">글자수 25자 제한</div>
					</div>	

					<div class="form-group" >
					<div style="text-align: left;"><label for="scrimdesc">소개</label></div>
					<div><input type="text" name="scrimdesc"  class="input" id="scrimdesc" placeholder="  스크림 소개를 입력하세요." 
					required autocomplete="off" maxlength="120"/></div>
					<div style="text-align:left; margin-top: 10px; font-size:15px; color:hsla(0,0%,100%,.5); ">글자수 120자 제한</div>
					</div>

					<div class="form-group">
					<div style="text-align: left;"><label for="gamecategory">게임</label></div>
					<div>
					<select class="input-select" id="gamecategory" name="gamecategory" onchange="gamecatergoryselect(document.form.gamecategory.value)">
					<option value="">--선택해주세요--</option>
					<option value="오버워치">오버워치</option>
					<option value="리그오브레전드">리그오브레전드</option>
					</select>								
					</div>
					</div>

					<div class="form-group">
					<div>
					<div style="text-align: left;"><label for="gameproceed">게임 진행 방식</label></div>
					<select class="input-select" id="gameproceed" name="gameproceed">
					<option>--선택해주세요--</option>
					</select>								
					</div>
					</div>

					<div class="form-group-last">
					<div style="text-align: left;"><label for="scrimtime">시간</label></div>
					<div><input id="scrimtime" type="datetime-local" name="scrimtime" class="input"></div>
					</div>

					
					

					<input type="hidden" name="userprofile" value="'.$userprofile.'"/>
					</div>		

					</br>
					<div>						
					<button type="submit" name="createScrim" class="btn-red" >확인</button>

					</div>
					</br>
					</form>
					</div>
					';

				}
			}
		}
		if(isset($_GET['upload'])){
			if($_GET['upload']=="success"){echo "<script>alert('팀 생성 완료!')</script>";}
			else{
				echo "<script>alert('팀 생성 실패!')</script>";
			}			
		}
		if(isset($_GET['join'])){
			if($_GET['join']=="success"){echo "<script>alert('참가하셨습니다!')</script>";}
			if($_GET['join']=="fail"){
				if(empty($_SESSION['user_id'])){header('Location:login.php?action=needlogin');}
				else{echo "<script>alert('이미 참가하셨습니다!')</script>";}
			}
		}

		?>
	</div>
</center>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>


	var para = document.location.href.split("?")[1];
	var gamecategory;
	var rightnavwidth;
	if(para.includes('generate')||para.includes('sid')){
		$("#cretescrimbtn").hide();		
	}else{
		$("#cretescrimbtn").show();
	}
	if(para.includes('sid')){	
		rightnavwidth=500;	
		document.getElementById("right-nav").style.width = rightnavwidth+'px';	

	}else{
		rightnavwidth=375;
		document.getElementById("right-nav").style.width = rightnavwidth+'px';	
	}

	function gamecatergoryselect(fr) {
		gamecategory = fr;
		if(fr=="오버워치") {
			    //뿌려줄값을 배열로정렬
			    num = new Array("2탱 2딜 2힐","3탱 3힐","제한 없음");
			    vnum = new Array("2탱 2딜 2힐","3탱 3힐","제한 없음");
			} else if(fr=="리그오브레전드") {
				num = new Array("기본");
				vnum = new Array("기본");
			}
			    // 셀렉트안의 리스트를 기본값으로 한다..
			    for(i=0; i<form.gameproceed.length; i++) {
			    	form.gameproceed.options[0] = null;
			    }
			    //포문을 이용하여 두번째(test2)셀렉트 박스에 값을 뿌려줍니당)
			    for(i=0;i < num.length;i++) {
			    	document.form.gameproceed.options[i] = new Option(num[i],vnum[i]);
			    }
			}
			


			function openRightNav() {
				if(para.includes('sid')){
					rightnavwidth=500;
					document.getElementById("right-nav").style.width = rightnavwidth+'px';
				}else{
					rightnavwidth=375;
					document.getElementById("right-nav").style.width = rightnavwidth+'px';
				}				
				
			}

			function closeRightNav() {
				document.getElementById("right-nav").style.width = "0";
			}
			$(document).ready(function(){ $('#teamname').keyup(function(){ if ($(this).val().length > $(this).attr('maxlength')) { alert('제한길이 초과'); $(this).val($(this).val().substr(0, $(this).attr('maxlength'))); } }); });
			$(document).ready(function(){ $('#teamdesc').keyup(function(){ if ($(this).val().length > $(this).attr('maxlength')) { alert('제한길이 초과'); $(this).val($(this).val().substr(0, $(this).attr('maxlength'))); } }); });
		</script>

	</body>
	</html>
