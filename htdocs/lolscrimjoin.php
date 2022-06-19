<?php
echo '<div id="member-list">';
echo '<form name="form" method="POST">';
if($scriminfo['scrimType']==0){
	echo '<div style="margin-top:20px;">참가자 목록</div>';	
	try {
		$stmt = $con->prepare('select * from lolindividualscrim where lsid=:sid');
		$stmt->bindParam(':sid',$scriminfo['sid']);
		$stmt->execute();
		$lolscriminfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	?>
	<div id="red-team">
		<div style="margin-top: 20px;">레드팀</div>
		<table style="text-align:center; font-size:16px;">
			<tr>
				<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/lol_top.png" width="40px"/></th>
				<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/lol_mid.png" width="40px"/></th>
				<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/lol_bottom.png" width="40px"/></th>
			</tr>
			<tr>
				<?php
				if($lolscriminfo['redTop']==NULL){
					echo "<td><input type='radio' id='redTop' name='selectRole' value='redTop'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['redTop']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				if($lolscriminfo['redMid']==NULL){
					echo "<td><input type='radio' id='redMid' name='selectRole' value='redMid'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['redMid']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				if($lolscriminfo['redBot']==NULL){
					echo "<td><input type='radio' id='redBot' name='selectRole' value='redBot'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['redBot']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				?>
			</tr>
			<tr>
				<td colspan="3"><br></td>
			</tr>
			<tr>
				<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/lol_jungle.png" width="40px"/></th>					
				<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/lol_support.png" width="40px"/></th>

			</tr>
			<tr>
				<?php
				if($lolscriminfo['redJungle']==NULL){
					echo "<td><input type='radio' id='redJungle' name='selectRole' value='redJungle'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['redJungle']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				if($lolscriminfo['redSupport']==NULL){
					echo "<td><input type='radio' id='redSupport' name='selectRole' value='redSupport'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['redSupport']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				?>
			</tr>

		</table>
	</div>
	<div id="blue-team">
		<div style="margin-top: 20px;">블루팀</div>
		<table style="text-align:center; font-size:16px;">
			<tr>
				<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/lol_top.png" width="40px"/></th>
				<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/lol_mid.png" width="40px"/></th>
				<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/lol_bottom.png" width="40px"/></th>
			</tr>
			<tr>
				<?php
				if($lolscriminfo['blueTop']==NULL){
					echo "<td><input type='radio' id='blueTop' name='selectRole' value='blueTop'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['blueTop']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				if($lolscriminfo['blueMid']==NULL){
					echo "<td><input type='radio' id='blueMid' name='selectRole' value='blueMid'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['blueMid']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				if($lolscriminfo['blueBot']==NULL){
					echo "<td><input type='radio' id='blueBot' name='selectRole' value='blueBot'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['blueBot']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				?>
			</tr>
			<tr>
				<td colspan="3"><br></td>
			</tr>
			<tr>
				<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/lol_jungle.png" width="40px"/></th>					
				<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/lol_support.png" width="40px"/></th>

			</tr>
			<tr>
				<?php
				if($lolscriminfo['blueJungle']==NULL){
					echo "<td><input type='radio' id='blueJungle' name='selectRole' value='blueJungle'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['blueJungle']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				if($lolscriminfo['blueSupport']==NULL){
					echo "<td><input type='radio' id='blueSupport' name='selectRole' value='blueSupport'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
						$stmt->bindParam(':userprofile',$lolscriminfo['blueSupport']);
						$stmt->execute();
						$memberinfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$memberinfo['userprofile']."</span>
					<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
					</p>
					</div></td>";
				}
				?>
			</tr>

		</table>
	</div>
	<?php
	echo '<div style="position:absolute;left:200px;bottom:30px;"><center><button type="submit" name="joinScrim" class="btn-red" >참가하기</button></center></div>';
	echo '</form>';

}else if($scriminfo['scrimType']==1){
	echo '<div style="margin-top:20px;">참가팀 목록</div>';
	try {
		$stmt = $con->prepare('select * from lolteamscrim where lsid=:sid');
		$stmt->bindParam(':sid',$scriminfo['sid']);
		$stmt->execute();
		$lolscriminfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	?>
	<div id="red-team">
		<div style="margin-top: 20px;">레드팀</div>						
		<table>
			<tr>
				<?php
				if($lolscriminfo['redTeam']==NULL){
					echo "<td><input type='radio' id='redTeam' name='selectTeam' value='redTeam'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM teams WHERE tid=:lolTid');
						$stmt->bindParam(':lolTid',$lolscriminfo['redTeam']);
						$stmt->execute();
						$teaminfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><a href='party.php?tid=".$teaminfo['tid']."><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$teaminfo['teamName']."</span>
					<p class='arrow_box2'><img src='upload/teamProfileImg/".$teaminfo["imgFullNameTeam"]."'width=150px/> <br>
					</p>
					</div></a></td>";
				}
				?>				
			</tr>	
		</table>
	</div>
	<div id="blue-team">
		<div style="margin-top: 20px;">블루팀</div>
		<table>
			<tr>
				<?php
				if($lolscriminfo['blueTeam']==NULL){
					echo "<td><input type='radio' id='blueTeam' name='selectTeam' value='blueTeam'/></td>";
				}else{
					try {
						$stmt = $con->prepare('SELECT * FROM teams WHERE tid=:lolTid');
						$stmt->bindParam(':lolTid',$lolscriminfo['blueTeam']);
						$stmt->execute();
						$teaminfo=$stmt->fetch();
					}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
					echo "<td><a href='party.php?tid=".$teaminfo['tid']."><div style='position: relative;'>
					<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
					".$teaminfo['teamName']."</span>
					<p class='arrow_box2'><img src='upload/teamProfileImg/".$teaminfo["imgFullNameTeam"]."'width=150px/> <br>
					</p>
					</div></a></td>";
				}
				?>				
			</tr>
		</table>
	</div>
	<?php
	echo '<div style="position:absolute;left:200px;bottom:30px;"><center><button type="submit" name="joinTeamScrim" class="btn-red" >참가하기</button></center></div>';
	echo '</form>';
}
if (isset($_POST['joinScrim'])){
	$selectRole=$_POST['selectRole'];
	$sid = $scriminfo['sid'];
	try {			
		$stmt = $con->prepare('select * from users where username=:userid');
		$stmt->bindParam('userid',$_SESSION['user_id']);
		$stmt->execute();
		$userinfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	$username = (string)$userinfo['userprofile'];
	$uid = $userinfo['uid'];
	try {			
			$stmt = $con->prepare('SELECT * FROM lolindividualscrim WHERE lsid=:sid');
			$stmt->bindParam('sid', $scriminfo['sid']);			
			$stmt->execute();
			$lolindividualscriminfo=$stmt->fetch();
		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}
		if($uid==$lolindividualscriminfo['redTop']||$uid==$lolindividualscriminfo['redMid']||$uid==$lolindividualscriminfo['redBot']||$uid==$lolindividualscriminfo['redJungle']||$uid==$lolindividualscriminfo['redSupport']||$uid==$lolindividualscriminfo['blueTop']||$uid==$lolindividualscriminfo['blueMid']||$uid==$lolindividualscriminfo['blueBot']||$uid==$lolindividualscriminfo['blueJungle']||$uid==$lolindividualscriminfo['blueSupport']){
			header("Location:scrim.php?sid=$sid&join=fail");
		}else{
			try {			
				$stmt = $con->prepare('UPDATE lolindividualscrim SET '.$selectRole.'=:uid WHERE lsid=:sid');
				$stmt->bindParam('uid',$uid);
				$stmt->bindParam('sid', $scriminfo['sid']);			
				$stmt->execute();
			} catch(PDOException $e) {
				die("Database error: " . $e->getMessage()); 
			}
			echo '<script>alert("참가완료!");</script>';		
			header("Location:scrim.php?sid=$sid&join=success");
		}	
}

if(isset($_POST['joinTeamScrim'])){
	$selectTeam=$_POST['selectTeam'];
	$sid = $scriminfo['sid'];
	try {			
		$stmt = $con->prepare('select * from lolteamscrim where lsid=:sid');
		$stmt->bindParam('sid',$sid);
		$stmt->execute();
		$lolteamscrim=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	try {			
		$stmt = $con->prepare('select lolTid from users where username=:userid');
		$stmt->bindParam('userid',$_SESSION['user_id']);
		$stmt->execute();
		$lolTidinfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	$lolTid=$lolTidinfo['lolTid'];
	try {			
		$stmt = $con->prepare('select * from teams where tid=:lolTid');
		$stmt->bindParam('lolTid',$lolTid);
		$stmt->execute();
		$Teaminfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	if($lolTid==$lolteamscrim['redTeam']||$lolTid==$lolteamscrim['blueTeam']){
			header("Location:scrim.php?sid=$sid&join=fail");
		}else{
			try {			
				$stmt = $con->prepare('UPDATE lolteamscrim SET '.$selectTeam.'=:lolTid WHERE lsid=:sid');
				$stmt->bindParam('lolTid',$lolTid);
				$stmt->bindParam('sid', $sid);			
				$stmt->execute();
			} catch(PDOException $e) {
				die("Database error: " . $e->getMessage()); 
			}
			echo '<script>alert("참가완료!");</script>';		
			header("Location:scrim.php?sid=$sid&join=success");
		}
}
?>