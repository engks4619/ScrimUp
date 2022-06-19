<?php

include_once('dbcon.php'); 

include('check.php');

if (is_login()){
	;
}else{        
	echo "<script>alert('로그인이 필요합니다.')</script>";
	echo "<script>document.location.href='login.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>ScrimMatchUp</title>   
	<style>
		.body, html{
			background: rgb(26, 29, 33) !important;         
			font-family: trade-gothic-next, "Noto Sans", "Malgun Gothic", "맑은 고딕", sans-serif;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.body, html::-webkit-scrollbar {
			display: none; /* Chrome, Safari, Opera*/
		}
		.user-info{
			width: 500px;
			
			display: flex;
			justify-content: center;
			align-items: center;
			background-color: #1f2226;


		}
		.join-info{	      		

		}
		.platform-info{

		}

	</style>



</head>	
<body>
	<?php
	ob_start();
	include_once('left_nav.php');
	?>
	<div class="main" allgin="center">

		<?php
		#유저DB정보
		$user_id = $_SESSION['user_id'];
		try { 
			$stmt = $con->prepare('select * from users where username=:username');
			$stmt->bindParam(':username', $user_id);
			$stmt->execute();

		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}

		$row = $stmt->fetch();
		$username=$row['username'];
		$userprofile=$row['userprofile'];
		$regtime=$row['regtime'];
		
		?>
		<?php
		try { 
			$stmt2 = $con->prepare('select * from overwatchtier where battletag=:battletag');
			$stmt2->bindParam(':battletag', $row['battlenetname']);
			$stmt2->execute();

		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}
		$owdb = $stmt2->fetch();				   
		?>

		<?php
		#디스코드 연동
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		ini_set('max_execution_time', 300); 

		error_reporting(E_ALL);

		#디스코드 클라이언트 정보 정의
		define('OAUTH2_CLIENT_ID', '752934302345461895');
		define('OAUTH2_CLIENT_SECRET', 'hjHFLvKdzB01vncZBpdvD12W8zQ-r2-B');
		define('OAUTH2_REFRESH_TOKEN', $row['discord_refreshtoken']);

		$authorizeURL = 'https://discord.com/api/oauth2/authorize';
		$tokenURL = 'https://discord.com/api/oauth2/token';
		$apiURLBase = 'https://discord.com/api/users/@me';

		#배틀넷 클라이언트 정보 정의
		define('CLIENT_ID', '05b8fc3803d347058d96621464b0bd5b');
		define('CLIENT_SECRET', 'E5o2Yilh5WCW85J5qVtpklNADe7h7KF2');
		define('REDIRECT_URI', 'https://scrimmatchup.mooo.com:443/mypage.php');
		define('SCOPE','openid');

		#플랫폼 정보 갱신
		if(get('action')=='platform_refresh'){
			#디스코드 연동 정보 갱신 
			if(empty($row['discordname'])){
				$errMSG = "디스코드 연동이 필요합니다!";
			}else{
				$token = apiRequest($tokenURL, array(
					"grant_type" => "authorization_code",
					'client_id' => OAUTH2_CLIENT_ID,
					'client_secret' => OAUTH2_CLIENT_SECRET,
					'redirect_uri' => 'https://scrimmatchup.mooo.com/mypage.php',
					'code' => get('code')
				));
				if(isset($token->error)){
					$token = apiRequest($tokenURL, array(
						'grant_type' => 'refresh_token',
						'refresh_token' => $row['discord_refreshtoken'],
						'client_id' => OAUTH2_CLIENT_ID,
						'client_secret' => OAUTH2_CLIENT_SECRET,
						'redirect_uri' => 'https://scrimmatchup.mooo.com/mypage.php'
					));
					if(isset($token->access_token)){
						$access_token = $token->access_token;
						$_SESSION['refresh_token'] = $token->refresh_token;
						$_SESSION['access_token']=$access_token;
						echo"<script>alert('갱신되었습니다')</script>";
					}else{
						
					}
					
				}else{
					$_SESSION['refresh_token'] = $token->refresh_token;
					$_SESSION['access_token'] = $token->access_token;						
				}
			}			
		}


		if(get('action') == 'discordlinkage') {

			$params = array(
				'client_id' => OAUTH2_CLIENT_ID,
				'redirect_uri' => 'https://scrimmatchup.mooo.com/mypage.php',
				'response_type' => 'code',
				'scope' => 'identify'
			);
			header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
			die();
		}
		if(get('code')) {
			$token = apiRequest($tokenURL, array(
				"grant_type" => "authorization_code",
				'client_id' => OAUTH2_CLIENT_ID,
				'client_secret' => OAUTH2_CLIENT_SECRET,
				'redirect_uri' => 'https://scrimmatchup.mooo.com/mypage.php',
				'code' => get('code')
			));
			$logout_token = $token->access_token;
			$_SESSION['access_token'] = $token->access_token;
			$_SESSION['refresh_token'] = $token->refresh_token;		


			header('Location: ' . $_SERVER['PHP_SELF']);
		}
		if(get('action')=='logout'){
			session_destroy();
		}

		if(session('access_token')) {
			$user = apiRequest($apiURLBase);
			if(isset($user->username)&&isset($user->discriminator)){
				$discordname=$user->username.'#'.$user->discriminator;
				if($discordname!="#"){
					if(isset($_SESSION['refresh_token'])){
						$stmt = $con->prepare("UPDATE users SET discordname = '$discordname', discord_refreshtoken =:refresh_token WHERE username=:uname");
						$stmt->bindParam(':refresh_token',$_SESSION['refresh_token']);
						$stmt->bindParam(':uname', $user_id);
						$stmt->execute();
					}else{
						$stmt = $con->prepare("UPDATE users SET discordname = '$discordname' WHERE username=:uname");
						$stmt->bindParam(':uname', $user_id);
						$stmt->execute();
					}
				}
			}else{
			}	
		}else {
		}
		

		if(get('action') == 'logout') {		
			$params = array(
				'access_token' => $logout_token
			);
			header('Location: https://discordapp.com/api/oauth2/token/revoke' . '?' . http_build_query($params));
			die();
		}

		function apiRequest($url, $post=FALSE, $headers=array()) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

			$response = curl_exec($ch);


			if($post)
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

			$headers[] = 'Accept: application/json';

			if(session('access_token'))
				$headers[] = 'Authorization: Bearer ' . session('access_token');

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$response = curl_exec($ch);
			return json_decode($response);
		}

		function get($key, $default=NULL) {
			return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
		}

		function session($key, $default=NULL) {
			return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
		}

		?>

		<?php
		#배틀넷 연동
		

		$authorizeURL = 'https://apac.battle.net/oauth/authorize';
		$tokenURL = 'https://apac.battle.net/oauth/token';
		$apiURLBase2 = 'https://apac.battle.net/oauth/userinfo';

		if(get('action') == 'battlenetlinkage') {
			$params = array(
				'response_type' => 'code',
				'client_id' => CLIENT_ID,
				'scope' => SCOPE, 
				'redirect_uri' => REDIRECT_URI,
			);

			header('Location: https://apac.battle.net/oauth/authorize' . '?' . http_build_query($params));
			die();
		}

		if(get('code')) {

			$token = apiRequest($tokenURL, array(
				"grant_type" => "authorization_code",
				'response_type' => 'code',
				'client_id' => CLIENT_ID,
				'client_secret' => CLIENT_SECRET,
				'redirect_uri' => 'https://scrimmatchup.mooo.com:443/mypage.php',
				'code' => get('code')
			));
			$logout_token = $token->access_token;
			$_SESSION['access_token'] = $token->access_token;


			header('Location: ' . $_SERVER['PHP_SELF']);
		}
		if(get('action')=='logout'){
			session_destroy();
		}

		if(session('access_token')) {
			$openid = apiRequest($apiURLBase2);
			if(isset($openid->battletag)){
				$battlenetname="$openid->battletag";
				$stmt = $con->prepare("UPDATE users SET battlenetname = '$battlenetname' WHERE username=:uname");
				$stmt->bindParam(':uname', $user_id);
				$stmt->execute(); 
				$stmt = $con->prepare("SELECT * From overwatchtier WHERE battletag ='$battlenetname'");
				$stmt->execute();
				$rows = $stmt->fetchAll();
				if(count($rows)==0){
					$stmt = $con->prepare("INSERT INTO overwatchtier(battletag) VALUES('$battlenetname')");
					$stmt->execute(); 
				}
			}			  

		} else {
		}
		if(get('action') == 'logout') {
			session_destroy();
			$params = array(
				'access_token' => $logout_token
			);
			
			header('Location: https://battle.net/oauth/token/revoke' . '?' . http_build_query($params));
			die();
		}				    
		?>

		<?php
		#전적정보갱신
		if(get('action') == 'overwatchrefresh') {
			$battlenetname=$row['battlenetname'];
			if($battlenetname!=NULL){
				echo shell_exec("python C:/scrim/htdocs/overlog.py $battlenetname");
			}else{
				$errMSG ="배틀넷 연동이 필요합니다.";
			}
		}
		#팀 탈퇴
		if(get('action') == 'exitteam'){
			if($_SESSION['user_id']==$row['username']){
				$user_id=$_SESSION['user_id'];
				switch ($_GET['gamecategory']) {
					case '오버워치':

					$stmt = $con->prepare("UPDATE users SET owTid = NULL WHERE username=:uname");
					$stmt->bindParam(':uname', $user_id);
					$stmt->execute();
					header("Location:mypage.php?exit=success");
					break;
					case '리그오브레전드':
					$stmt = $con->prepare("UPDATE users SET lolTid = NULL WHERE username=:uname");
					$stmt->bindParam(':uname', $user_id);
					$stmt->execute();
					header("Location:mypage.php?exit=success");
					break;
					default:
					$errMSG = "잘못된 접근입니다!!";
					break;
				}				 
			}else{
				$errMSG = "잘못된 접근입니다!";
			}
		}
		if(isset($errMSG)){
			echo "<script>alert('$errMSG')</script>";
		}
		?>

		<div class="user-info" >



			<div class=join-info>					



				<table style="width: 400px; color: white; border-collapse: collapse;">
					<tr style="border-bottom: 3px solid #8c8c8c;">
						<th style="width: 130px; text-align: left;"><h2>가입 정보</h2></th>
						<th style="text-align: right;"><p><a href="edituserform.php?edit_id=<?php echo $username ?>">수정</a></p></th>
					</tr>
					<tr style="text-align: left;line-height: 200%;">
						<th style="padding-top:10px;">아이디</th>
						<td><?php echo $row['username'];?></td>
					</tr>
					<tr style="text-align: left;line-height: 200%;">
						<th>닉네임</th>
						<td style="text-align: left;"><?php echo $row['userprofile'];?></td>
					</tr>
					<tr style="text-align: left;line-height: 200%;">
						<th>생성일</th>
						<td><?php echo $row['regtime'];?></td>
					</tr>
				</table>									
				
				<table style="margin-top: 30px; width: 400px; color: white; border-collapse: collapse;">
					<tr>							
						<th style="width: 130px; text-align: left;" colspan="3"><h2>플랫폼 정보</h2></th>
						<th style="text-align:right;"><a href="?action=platform_refresh">갱신</a></th>
					</tr>
					<tr style=" border-top: 3px solid #8c8c8c; text-align: left;">
						<td style="width: 30px; padding-top: 5px;"><?php echo "<img src='img/discord.png' width='20' height='20'/>"?></td>
						<th style="width: 100px;">디스코드</th>
						<td><?php echo($row['discordname']);?> </td>
						<th style="text-align: right;"><p><a href="?action=discordlinkage">연동</a></p></th>
					</tr>
					<tr style="text-align: left;">
						<td style="width: 30px;padding-top: 5px;"><?php echo "<img src='img/battlenet.png' width='20' height='20'/>"?></td>
						<th style="width: 100px;">배틀넷</th>
						<td><?php echo($row['battlenetname']);?> </td>
						<th style="text-align: right;"><p><a href="?action=battlenetlinkage">연동</a></p></th>
					</tr>
				</table>

				<table style=" margin-top: 30px; width: 400px; color: white; border-collapse: collapse;">
					<tr style="border-bottom: 3px solid #8c8c8c; width: 400px;">							
						<th style=" text-align: left;" colspan="4"><h2>팀 정보</h2></th>
					</tr>
					<?php
					if(empty($row['owTid'])&&empty($row['lolTid'])){
						echo'					
						<th style="text-align:left;colspan="3"">가입하신 팀이 없습니다!</th>
						<th style="text-align: right;"><p><a href="party.php">가입</a></p></th>
						</tr>';
					} 
					if(isset($row['owTid'])&&$row['owTid']!=NULL){
						try { 
							$stmt = $con->prepare('SELECT * FROM teams WHERE tid=:owTid');
							$stmt->bindParam(':owTid', $row['owTid']);
							$stmt->execute();
							$teaminfo = $stmt->fetch();
							$teamName = $teaminfo['teamName'];
						} catch(PDOException $e) {
							die("Database error: " . $e->getMessage()); 
						}
						echo'
						<tr style=" text-align: left;">
						<td style="width: 30px; padding-top: 5px;"><img src="img/overwatch.png" width="20" height="20"/></td>
						<th style="width: 100px;">오버워치</th>
						<td><a href="party.php?tid='.$teaminfo['tid'].'">'.$teaminfo['teamName'].'</a></td>	
						<th style="text-align: right;">'?><p><a style="cursor: pointer;" onclick="next('오버워치','<?php echo $teamName;?>')">탈퇴</a></p></th>					
						<?php echo'
						</tr>';
					}
					if(isset($row['lolTid'])&&$row['lolTid']!=NULL){
						try { 
							$stmt = $con->prepare('SELECT * FROM teams WHERE tid=:lolTid');
							$stmt->bindParam(':lolTid', $row['lolTid']);
							$stmt->execute();
							$teaminfo = $stmt->fetch();
							$teamName = $teaminfo['teamName'];
						} catch(PDOException $e) {
							die("Database error: " . $e->getMessage()); 
						}
						echo'
						<tr style=" text-align: left;">
						<td style="width: 30px; padding-top: 5px;"><img src="img/lol.png" width="20" height="20"/></td>
						<th style="width: 130px;">리그오브레전드</th>
						<td><a href="party.php?tid='.$teaminfo['tid'].'">'.$teaminfo['teamName'].'</a></td>
						<th style="text-align: right;">'?><p><a style="cursor: pointer;" onclick="next('리그오브레전드','<?php echo $teamName;?>')">탈퇴</a></p></th>					
						<?php echo'
						</tr>';
					}
					
					?>
				</table>
				


				<table style="margin-top: 30px; margin-bottom: 20px; width: 400px; color: white; border-collapse: collapse; text-align: left;">
					<thead>
						<tr>
							<th colspan="6"><h2>티어 정보</h2></th>
						</tr>
					</thead>
					<tbody>
						<tr style="border-top: 3px solid #8c8c8c;">						  	
							<th style="width:30px;padding-top: 5px;"><?php echo "<img src='img/overwatch.png' width='20' height='20'/>";?></th>
							<th colspan="4" style="text-align: left;">오버워치</th>
							<th  style="text-align: right;"><p><a href="?action=overwatchrefresh">갱신</a></p></th>
						</tr>

						<?php if(!empty($owdb)){
							if($owdb['isSecret']==NULL){?>
								<tr style="text-align: left;">
										<td colspan="4"><?php echo "갱신이 필요합니다.";?></td>
									</tr>
									<?php
							}else{
								if($owdb['isSecret']==1){?>
									<tr style="text-align: left;">
										<td colspan="4"><?php echo "프로필이 비공개 상태입니다.";?></td>
									</tr>
									<?php
								}else{
									?>								
									<tr style='text-align: center;'>
										<td rowspan='2'><img src='img/ow_tank.png' width='30' height='30'/></td>
										<td>
											<?php switch($owdb['TankerTierName']){
												case 'Unranked': echo "<img src='img/rank-1.png' width='100' height='100'/>"; break;
												case 'Bronze': echo "<img src='img/Competitive_Bronze_Icon.png' width='100' height='100'/>"; break;
												case 'Silver': echo "<img src='img/Competitive_Silver_Icon.png' width='100' height='100'/>";break;
												case 'Gold': echo "<img src='img/Competitive_Gold_Icon.png' width='100' height='100'/>";break;
												case 'Platinum': echo "<img src='img/Competitive_Platinum_Icon.png' width='100' height='100'/>";break;
												case 'Diamond': echo "<img src='img/Competitive_Diamond_Icon.png' width='100' height='100'/>";break;
												case 'Master': echo "<img src='img/Competitive_Master_Icon.png' width='100' height='100'/>";break;
												case 'Grandmaster': echo "<img src='img/Competitive_Grandmaster_Icon.png' width='100' height='100'/>";break;
												default:break;}?></td>
												<td rowspan='2'><img src='img/ow_attack.png' width='30' height='30'/></td>
												<td><?php switch($owdb['DealerTierName']){
													case 'Unranked': echo "<img src='img/rank-1.png' width='100' height='100'/>"; break;
													case 'Bronze': echo "<img src='img/Competitive_Bronze_Icon.png' width='100' height='100'/>"; break;
													case 'Silver': echo "<img src='img/Competitive_Silver_Icon.png' width='100' height='100'/>";break;
													case 'Gold': echo "<img src='img/Competitive_Gold_Icon.png' width='100' height='100'/>";break;
													case 'Platinum': echo "<img src='img/Competitive_Platinum_Icon.png' width='100' height='100'/>";break;
													case 'Diamond': echo "<img src='img/Competitive_Diamond_Icon.png' width='100' height='100'/>";break;
													case 'Master': echo "<img src='img/Competitive_Master_Icon.png' width='100' height='100'/>";break;
													case 'Grandmaster': echo "<img src='img/Competitive_Grandmaster_Icon.png' width='100' height='100'/>";break;
													default:break;}?>	</td>
													<td rowspan='2'> <img src='img/ow_support.png' width='30' height='30'/></td>
													<td> <?php switch($owdb['HealerTierName']){
														case 'Unranked': echo "<img src='img/rank-1.png' width='100' height='100'/>"; break;
														case 'Bronze': echo "<img src='img/Competitive_Bronze_Icon.png' width='100' height='100'/>"; break;
														case 'Silver': echo "<img src='img/Competitive_Silver_Icon.png' width='100' height='100'/>";break;
														case 'Gold': echo "<img src='img/Competitive_Gold_Icon.png' width='100' height='100'/>";break;
														case 'Platinum': echo "<img src='img/Competitive_Platinum_Icon.png' width='100' height='100'/>";break;
														case 'Diamond': echo "<img src='img/Competitive_Diamond_Icon.png' width='100' height='100'/>";break;
														case 'Master': echo "<img src='img/Competitive_Master_Icon.png' width='100' height='100'/>";break;
														case 'Grandmaster': echo "<img src='img/Competitive_Grandmaster_Icon.png' width='100' height='100'/>";break;
														default:break;}?>	</td>
													</tr>
													<tr style='text-align: center;'>
														<td><?php echo $owdb['TankerScore'];?></td>
														<td><?php echo $owdb['DealerScore'];?></td>
														<td><?php echo $owdb['HealerScore'];?></td>
													</tr>

												<?php }	
											}


										}
										?>
									</tbody>
								</table>

							</div>								
						</div>

					</div>
					<script>
						function next(gamecategory,teamName){
							gamecategory=encodeURIComponent(gamecategory);
							teamName=encodeURIComponent(teamName);
							if(confirm("정말 탈퇴하시겠습니까?"))
							{
								location.href='?action=exitteam&gamecategory='+gamecategory+'&teamName='+teamName;
							}
							else
							{
								alert('취소되었습니다.');
							}
						}
					</script>

				</body>
				</html>
