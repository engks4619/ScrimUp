<?php

## 스크림 인풋태그 or 참여자 출력
echo '<div id="member-list">';
echo '<form name="form" method="POST">';
if($scriminfo['scrimType']==0){
	echo '<div style="margin-top:20px;">참가자 목록</div>';	
	switch($scriminfo['gameProceed']){
		case '3탱 3힐':
		try {
			$stmt = $con->prepare('select * from ow33individualscrim where osid=:sid');
			$stmt->bindParam(':sid',$scriminfo['sid']);
			$stmt->execute();
			$owscriminfo=$stmt->fetch();
		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}
		
		?>		
		<div id="red-team">
			<div style="margin-top: 20px;">레드팀</div>
			<table style="text-align:center; font-size:16px;">
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					
				</tr>
				<tr>
					<?php
					if($owscriminfo['redTank1']==NULL){
						echo "<td><input type='radio' id='redTank1' name='selectRole' value='redTank1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redTank1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redTank2']==NULL){
						echo "<td><input type='radio' id='redTank2' name='selectRole' value='redTank2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redTank2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redTank3']==NULL){
						echo "<td><input type='radio' id='redTank3' name='selectRole' value='redTank3'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redTank3']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					?>					
				</tr>
				<tr><td colspan="3"><br></td>
				</tr>				
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
				</tr>
				<tr>
					<?php
					if($owscriminfo['redHeal1']==NULL){
						echo "<td><input type='radio' id='redHeal1' name='selectRole' value='redHeal1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redHeal1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redHeal2']==NULL){
						echo "<td><input type='radio' id='redHeal2' name='selectRole' value='redHeal2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redHeal2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redHeal3']==NULL){
						echo "<td><input type='radio' id='redHeal3' name='selectRole' value='redHeal3'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redHeal3']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
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
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					
				</tr>
				<tr>
					<?php
					if($owscriminfo['blueTank1']==NULL){
						echo "<td><input type='radio' id='blueTank1' name='selectRole' value='blueTank1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueTank1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueTank2']==NULL){
						echo "<td><input type='radio' id='blueTank2' name='selectRole' value='blueTank2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueTank2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueTank3']==NULL){
						echo "<td><input type='radio' id='blueTank3' name='selectRole' value='blueTank3'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueTank3']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					?>					
				</tr>
				<tr><td colspan="3"><br></td>
				</tr>				
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
				</tr>
				<tr>
					<?php
					if($owscriminfo['blueHeal1']==NULL){
						echo "<td><input type='radio' id='blueHeal1' name='selectRole' value='blueHeal1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueHeal1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueHeal2']==NULL){
						echo "<td><input type='radio' id='blueHeal2' name='selectRole' value='blueHeal2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueHeal2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueHeal3']==NULL){
						echo "<td><input type='radio' id='blueHeal3' name='selectRole' value='blueHeal3'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueHeal3']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					?>
				</tr>	
			</table>
		</div>
		<?php
		echo '<div style="position:absolute;left:200px;bottom:30px;"><center><button type="submit" name="joinScrim" class="btn-red" >참가하기</button></center></div>';
		echo '</form>'; 
		break;
		case '2탱 2딜 2힐':
		try {
			$stmt = $con->prepare('select * from ow222individualscrim where osid=:sid');
			$stmt->bindParam(':sid',$scriminfo['sid']);
			$stmt->execute();
			$owscriminfo=$stmt->fetch();
		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}
		?>
		<div id="red-team">
			<div style="margin-top: 20px;">레드팀</div>
			<table style="text-align:center;">
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_attack.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['redTank1']==NULL){
						echo "<td><input type='radio' id='redTank1' name='selectRole' value='redTank1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redTank1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redDeal1']==NULL){
						echo "<td><input type='radio' id='redDeal1' name='selectRole' value='redDeal1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redDeal1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redHeal1']==NULL){
						echo "<td><input type='radio' id='redHeal1' name='selectRole' value='redHeal1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redHeal1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>
				<tr>
					<td colspan="3"><br></td>
				</tr>
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_attack.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['redTank2']==NULL){
						echo "<td><input type='radio' id='redTank2' name='selectRole' value='redTank2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redTank2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redDeal2']==NULL){
						echo "<td><input type='radio' id='redDeal2' name='selectRole' value='redDeal2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redDeal2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['redHeal2']==NULL){
						echo "<td><input type='radio' id='redHeal2' name='selectRole' value='redHeal2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['redHeal2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>

			</table>
		</div>
		<div id="blue-team">
			<div style="margin-top: 20px;">블루팀</div>
			<table style="text-align:center;">
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_attack.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['blueTank1']==NULL){
						echo "<td><input type='radio' id='blueTank1' name='selectRole' value='blueTank1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueTank1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueDeal1']==NULL){
						echo "<td><input type='radio' id='blueDeal1' name='selectRole' value='blueDeal1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueDeal1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueHeal1']==NULL){
						echo "<td><input type='radio' id='blueHeal1' name='selectRole' value='blueHeal1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueHeal1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>
				<tr>
					<td colspan="3"><br></td>
				</tr>
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_tank.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_attack.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_support.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['blueTank2']==NULL){
						echo "<td><input type='radio' id='blueTank2' name='selectRole' value='blueTank2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueTank2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueDeal2']==NULL){
						echo "<td><input type='radio' id='blueDeal2' name='selectRole' value='blueDeal2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueDeal2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blueHeal2']==NULL){
						echo "<td><input type='radio' id='blueHeal2' name='selectRole' value='blueHeal2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blueHeal2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>

			</table>
		</div>
		<?php
		echo '<div style="position:absolute;left:200px;bottom:30px;"><center><button type="submit" name="joinScrim" class="btn-red" >참가하기</button></center></div>';
		echo '</form>';
		break;		
		case '제한 없음':
		try {
			$stmt = $con->prepare('select * from ownolimitindividualscrim where osid=:sid');
			$stmt->bindParam(':sid',$scriminfo['sid']);
			$stmt->execute();
			$owscriminfo=$stmt->fetch();
		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}		
		?>		
		<div id="red-team">
			<div style="margin-top: 20px;">레드팀</div>
			<table style="text-align:center;">
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['red1']==NULL){
						echo "<td><input type='radio' id='red1' name='selectRole' value='red1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['red1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['red2']==NULL){
						echo "<td><input type='radio' id='red2' name='selectRole' value='red2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['red2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['red3']==NULL){
						echo "<td><input type='radio' id='red3' name='selectRole' value='red3'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['red3']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>
				<tr>
					<td colspan="3"><br></td>
				</tr>
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['red4']==NULL){
						echo "<td><input type='radio' id='red4' name='selectRole' value='red4'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['red4']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['red5']==NULL){
						echo "<td><input type='radio' id='red5' name='selectRole' value='red5'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['red5']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['red6']==NULL){
						echo "<td><input type='radio' id='red6' name='selectRole' value='red6'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['red6']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>

			</table>
		</div>
		<div id="blue-team">
			<div style="margin-top: 20px;">블루팀</div>
			<table style="text-align:center;">
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['blue1']==NULL){
						echo "<td><input type='radio' id='blue1' name='selectRole' value='blue1'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blue1']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blue2']==NULL){
						echo "<td><input type='radio' id='blue2' name='selectRole' value='blue2'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blue2']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blue3']==NULL){
						echo "<td><input type='radio' id='blue3' name='selectRole' value='blue3'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blue3']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>
				<tr>
					<td colspan="3"><br></td>
				</tr>
				<tr>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="border-right: 1px solid #8c8c8c; padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
					<th style="padding-left: 50px; padding-right: 50px;"><img src="/img/ow_any.png" width="40px"/></th>
				</tr>				
				<tr>
					<?php
					if($owscriminfo['blue4']==NULL){
						echo "<td><input type='radio' id='blue4' name='selectRole' value='blue4'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blue4']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blue5']==NULL){
						echo "<td><input type='radio' id='blue5' name='selectRole' value='blue5'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blue5']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}
					if($owscriminfo['blue6']==NULL){
						echo "<td><input type='radio' id='blue6' name='selectRole' value='blue6'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM users WHERE uid=:userprofile');
							$stmt->bindParam(':userprofile',$owscriminfo['blue6']);
							$stmt->execute();
							$memberinfo=$stmt->fetch();
						}catch(PDOException $e) {die("Database error: " . $e->getMessage());}
						echo "<td><div style='position: relative;'>
						<span style='display: block;width: 100%;padding: 2px;cursor: pointer;z-index:1001'>
						".$memberinfo['userprofile']."</span>
						<p class='arrow_box'><img src='img/discord.png' width=20px'/> 디스코드<br>".$memberinfo['discordname']."<br>
						<img src='img/battlenet.png' width=20px;/> 배틀넷<br>".$memberinfo['battlenetname']."</p>
						</div></td>";
					}

					?>
				</tr>

			</table>
		</div>
		<?php
		echo '<div style="position:absolute;left:200px;bottom:30px;"><center><button type="submit" name="joinScrim" class="btn-red" >참가하기</button></center></div>';
		echo '</form>';
		break;
	}


}else if($scriminfo['scrimType']==1){
	echo '<div style="margin-top:20px;">참가팀 목록</div>';
	
	try {
		$stmt = $con->prepare('select * from owteamscrim where osid=:sid');
		$stmt->bindParam(':sid',$scriminfo['sid']);
		$stmt->execute();
		$owscriminfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}?>		

	<div id="red-team">
		<div style="margin-top: 20px;">레드팀</div>						
		<table>
			<tr>
				<?php
					if($owscriminfo['redTeam']==NULL){
						echo "<td><input type='radio' id='redTeam' name='selectTeam' value='redTeam'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM teams WHERE tid=:owTid');
							$stmt->bindParam(':owTid',$owscriminfo['redTeam']);
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
					if($owscriminfo['blueTeam']==NULL){
						echo "<td><input type='radio' id='blueTeam' name='selectTeam' value='blueTeam'/></td>";
					}else{
						try {
							$stmt = $con->prepare('SELECT * FROM teams WHERE tid=:owTid');
							$stmt->bindParam(':owTid',$owscriminfo['blueTeam']);
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


## 개인스크림 참여
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
	$gameproceed = $scriminfo['gameProceed'];
	switch ($gameproceed) {
		case '3탱 3힐':	
		try {			
			$stmt = $con->prepare('SELECT * FROM ow33individualscrim WHERE osid=:sid');
			$stmt->bindParam('sid', $scriminfo['sid']);			
			$stmt->execute();
			$ow33scriminfo=$stmt->fetch();
		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}
		if($uid==$ow33scriminfo['redTank1']||$uid==$ow33scriminfo['redTank2']||$uid==$ow33scriminfo['redTank3']||$uid==$ow33scriminfo['redHeal1']||$uid==$ow33scriminfo['redHeal2']||$uid==$ow33scriminfo['redHeal3']||$uid==$ow33scriminfo['blueTank1']||$uid==$ow33scriminfo['blueTank2']||$uid==$ow33scriminfo['blueTank3']||$uid==$ow33scriminfo['blueHeal1']||$uid==$ow33scriminfo['blueHeal2']||$uid==$ow33scriminfo['blueHeal3']){
			header("Location:scrim.php?sid=$sid&join=fail");
		}else{
			try {			
				$stmt = $con->prepare('UPDATE ow33individualscrim SET '.$selectRole.'=:uid WHERE osid=:sid');
				$stmt->bindParam('uid',$uid);
				$stmt->bindParam('sid', $scriminfo['sid']);			
				$stmt->execute();
			} catch(PDOException $e) {
				die("Database error: " . $e->getMessage()); 
			}
			echo '<script>alert("참가완료!");</script>';		
			header("Location:scrim.php?sid=$sid&join=success");
		}	
		break;
		case '2탱 2딜 2힐':
		try {			
			$stmt = $con->prepare('SELECT * FROM ow222individualscrim WHERE osid=:sid');
			$stmt->bindParam('sid', $scriminfo['sid']);			
			$stmt->execute();
			$ow222scriminfo=$stmt->fetch();
		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}
		if($uid==$ow222scriminfo['redTank1']||$uid==$ow222scriminfo['redTank2']||$uid==$ow222scriminfo['redDeal1']||$uid==$ow222scriminfo['redDeal2']||$uid==$ow222scriminfo['redHeal1']||$uid==$ow222scriminfo['redHeal2']||$uid==$ow222scriminfo['blueTank1']||$uid==$ow222scriminfo['blueTank2']||$uid==$ow222scriminfo['blueDeal1']||$uid==$ow222scriminfo['blueDeal2']||$uid==$ow222scriminfo['blueHeal1']||$uid==$ow222scriminfo['blueHeal2']){
			header("Location:scrim.php?sid=$sid&join=fail");
		}else{
			try {			
				$stmt = $con->prepare('UPDATE ow222individualscrim SET '.$selectRole.'=:uid WHERE osid=:sid');
				$stmt->bindParam('uid',$uid);
				$stmt->bindParam('sid', $scriminfo['sid']);			
				$stmt->execute();
			} catch(PDOException $e) {
				die("Database error: " . $e->getMessage()); 
			}
			echo '<script>alert("참가완료!");</script>';		
			header("Location:scrim.php?sid=$sid&join=success");
		}	
		break;
		case '제한 없음':
		try {			
			$stmt = $con->prepare('SELECT * FROM ownolimitindividualscrim WHERE osid=:sid');
			$stmt->bindParam('sid', $scriminfo['sid']);			
			$stmt->execute();
			$ownolimitscriminfo=$stmt->fetch();
		} catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
		}
		if($uid==$ownolimitscriminfo['red1']||$uid==$ownolimitscriminfo['red2']||$uid==$ownolimitscriminfo['red3']||$uid==$ownolimitscriminfo['red4']||$uid==$ownolimitscriminfo['red5']||$uid==$ownolimitscriminfo['red6']||$uid==$ownolimitscriminfo['blue1']||$uid==$ownolimitscriminfo['blue2']||$uid==$ownolimitscriminfo['blue3']||$uid==$ownolimitscriminfo['blue4']||$uid==$ownolimitscriminfo['blue5']||$uid==$ownolimitscriminfo['blue6']){
			header("Location:scrim.php?sid=$sid&join=fail");
		}else{
			try {			
				$stmt = $con->prepare('UPDATE ownolimitindividualscrim SET '.$selectRole.'=:uid WHERE osid=:sid');
				$stmt->bindParam('uid',$uid);
				$stmt->bindParam('sid', $scriminfo['sid']);			
				$stmt->execute();
			} catch(PDOException $e) {
				die("Database error: " . $e->getMessage()); 
			}
			echo '<script>alert("참가완료!");</script>';		
			header("Location:scrim.php?sid=$sid&join=success");
		}
		break;
		default:
		break;
	}	

}
if(isset($_POST['joinTeamScrim'])){
	$selectTeam=$_POST['selectTeam'];
	$sid = $scriminfo['sid'];
	try {			
		$stmt = $con->prepare('select * from owteamscrim where osid=:sid');
		$stmt->bindParam('sid',$sid);
		$stmt->execute();
		$owteamscrim=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	try {			
		$stmt = $con->prepare('select owTid from users where username=:userid');
		$stmt->bindParam('userid',$_SESSION['user_id']);
		$stmt->execute();
		$owTidinfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	$owTid=$owTidinfo['owTid'];
	try {			
		$stmt = $con->prepare('select * from teams where tid=:owTid');
		$stmt->bindParam('owTid',$owTid);
		$stmt->execute();
		$Teaminfo=$stmt->fetch();
	} catch(PDOException $e) {
		die("Database error: " . $e->getMessage()); 
	}
	if($owTid==$owteamscrim['redTeam']||$owTid==$owteamscrim['blueTeam']){
			header("Location:scrim.php?sid=$sid&join=fail");
		}else{
			try {			
				$stmt = $con->prepare('UPDATE owteamscrim SET '.$selectTeam.'=:owTid WHERE osid=:sid');
				$stmt->bindParam('owTid',$owTid);
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