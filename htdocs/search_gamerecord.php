<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width">
	    <title>ScrimMatchUp</title>   
	    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
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
 				width: 730px;
 				margin-top: 20px;
 				display: flex;	      		
  				justify-content: center;
 				align-items: center;
				background-color: #1f2226;	
	     		}
	     	.level-image { 
	     		position:relative;
	     		text-align:center;
	     		color:#FFFFFF; 
	     		}
			.level-image div {
				 position: absolute;
				 top:50%;left:50%;
				 transform: translate(-50%, -50%);
				 font-weight: bold;
				 text-shadow: -1px 0 1px black, 0 1px 1px black, 1px 0 1px black, 0 -1px 1px black; 
			}
			.rank-Icon { 
	     		position:relative;	 
	     		text-align:center;
	     		color:#FFFFFF; 
	     		}	     		
							
			.rank-Icon div {
				 position: absolute;
				 top:50%;left:50%;
				 transform: translate(120%,-20%);
				 font-weight: bold;
				 text-shadow: -1px 0 1px black, 0 1px 1px black, 1px 0 1px black, 0 -1px 1px black; 
			}  	
			.battletag-input{
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
			.btn-red{
				border: 1px solid transparent;
			    background-color: #c71f1f;
			    color: hsla(0,0%,100%,.8);
			    border-radius: 2px;
			    text-align: center;
			    -webkit-user-select: none;
			    -moz-user-select: none;
			    -ms-user-select: none;
			    user-select: none;
			}

	     </style>
	     <?php
	     	ini_set("allow_url_fopen", 1);
	    	include('dbcon.php'); 
    		include('check.php');
			include('left_nav.php');
			include("simple_html_dom.php");
			
			
		?>
	 </head>
	 <body>
	 	
	 	<center>	
	 	<form style="margin-top:30px; align-content: center;" method="GET">
	 		<label style="font-weight:bold; color:white; " for="user_name">배틀태그  </label>
			<input class="battletag-input" type="text" name="battletag" id="inputID" placeholder=" 닉네임#1234" 
				required autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" />
			<button class="btn-red" type="submit" name="submit">확인</button>			
		</form>
		<span style="color:hsla(0,0%,100%,.5);">대소문자를 구분해주세요.</span>
		</center>
		<div class="user-info">
		
	 		<?php 
	 			if (($_SERVER['REQUEST_METHOD'] == 'GET') && isset($_GET['submit'])){
					$battletag=$_GET['battletag'];
					if(empty($battletag)){
						$errMSG = "배틀태그를 입력하세요.";
					}else{							
			 			$battletag=str_replace('#', '-', $_GET['battletag']);
			 			$url='https://ovrstat.com/stats/pc/'.$battletag;			 			
			 			$content = @file_get_contents($url);
						if (strpos($http_response_header[0], "200")) { 						   
						   $config = json_decode($content);
				 			if(isset($config->message)){
				 				$errMSG = "플레이어를 찾을 수 없습니다.";
				 			}else{
				 				$Private=$config->private;
				 				if($Private==false){
				 					$PlayerIcon=$config->icon;
						 			$PlayerName=$config->name;
						 			$Playerlevel=$config->level;
						 			$PlayerlevelIcon=$config->levelIcon;
						 			$prestigeIcon=$config->prestigeIcon;
						 			$ratings=$config->ratings;
						 			$gamesWon=$config->gamesWon;
						 			$topHeroes=array();
						 			$heroName=array();
						 			foreach($config->competitiveStats->topHeroes as $key=>$propName){						 				
						 				switch($key){
		                                  case 'ana': array_push($heroName, '아나');break;
		                                  case 'ashe': array_push($heroName, '애쉬');break;
		                                  case 'baptiste': array_push($heroName, '바티스트');break;
		                                  case 'bastion': array_push($heroName, '바스티온');break;
		                                  case 'dVa': array_push($heroName, '디바');break;
		                                  case 'doomfist': array_push($heroName, '둠피스트');break;
		                                  case 'reaper': array_push($heroName, '리퍼');break;
		                                  case 'mccree': array_push($heroName, '맥크리');break;
		                                  case 'mei': array_push($heroName, '메이');break;
		                                  case 'soldier76': array_push($heroName, '솔저: 76');break;
		                                  case 'sombra': array_push($heroName, '솜브라');break;
		                                  case 'symmetra': array_push($heroName, '시메트라');break;
		                                  case 'echo': array_push($heroName, '에코');break;
		                                  case 'hanzo': array_push($heroName, '한조');break;
		                                  case 'widowmaker': array_push($heroName, '위도우메이커');break;
		                                  case 'junkrat': array_push($heroName, '정크랫');break;
		                                  case 'torbjorn': array_push($heroName, '토르비욘');break;
		                                  case 'tracer': array_push($heroName, '트레이서');break;
		                                  case 'pharah': array_push($heroName, '파라');break;
		                                  case 'reinhardt': array_push($heroName, '라인하르트');break;
		                                  case 'wreckingBall': array_push($heroName, '레킹볼');break;
		                                  case 'roadhog': array_push($heroName, '로드호그');break;
		                                  case 'sigma': array_push($heroName, '시그마');break;
		                                  case 'orisa': array_push($heroName, '오리사');break;
		                                  case 'winston': array_push($heroName, '윈스턴');break;
		                                  case 'zarya': array_push($heroName, '자리야');break;
		                                  case 'lucio': array_push($heroName, '루시우');break;
		                                  case 'mercy': array_push($heroName, '메르시');break;
		                                  case 'moira': array_push($heroName, '모이라');break;
		                                  case 'brigitte': array_push($heroName, '브리기테');break;
		                                  case 'zenyatta': array_push($heroName, '젠야타');break;
		                                  case 'genji': array_push($heroName, '겐지');break;
		                               }
						 				array_push($topHeroes,$key);

						 			}						 			
						 			$heroPlayedTimes=array();
						 			for($a=0;$a<sizeof($topHeroes);$a++){	
						 				array_push($heroPlayedTimes, $config->competitiveStats->topHeroes->{$topHeroes[$a]}->timePlayed);
						 			}
						 			$mostPlayedNum=0;
						 			$max_int_v = max(str_replace(":", "", $heroPlayedTimes));
						 			$max_int_v_key = array_search($max_int_v, str_replace(":", "", $heroPlayedTimes));						 			
						 			$topHero=$topHeroes[$max_int_v_key];						 			
						 			$HeroImageUrl='https://d1u1mce87gyfbn.cloudfront.net/hero/'.$topHero.'/career-portrait.png';
						 			$kd = array();
						 			for($a=0;$a<sizeof($topHeroes);$a++){	
						 				array_push($kd, $config->competitiveStats->topHeroes->{$topHeroes[$a]}->eliminationsPerLife);
						 			}
						 			$winrate = array();
						 			for($a=0;$a<sizeof($topHeroes);$a++){	
						 				array_push($winrate, $config->competitiveStats->topHeroes->{$topHeroes[$a]}->winPercentage);
						 			}

						 		?>
						 		<table style=" width:700px; margin-top:30px; padding-bottom:30px;color: white;">
									<thead>
									  <tr>
									    <th style="text-align:left;font-size: 30px; border-bottom:3px solid #8c8c8c;" colspan="4">플레이어 정보</th>
									  </tr>
									</thead>
									<tbody>
									  <tr>
									    <td style="padding-top: 30px; padding-left: 25px;"><img src="<?php echo $PlayerIcon ;?>" width="100px"></td>
									    <td rowspan="2">
									    	<div class="level-image">
									 			<img src="<?php echo $PlayerlevelIcon ;?>" width="120px">
									 			<div style="padding-bottom: 5px;"><?php echo $Playerlevel;?></div>
									 			<div style="padding-top: 60px;"><img src="<?php echo $prestigeIcon ;?>" width="120px" ></div> 
									 		</div>
									 	</td>
									    <td rowspan="2" style="z-index: 1">
									    	<?php
									    		if(isset($ratings)){
												for($a=0;$a<sizeof($ratings);$a++){
													$roleIcon=$ratings[$a]->roleIcon;
													$rankIcon=$ratings[$a]->rankIcon;
													?>													
													<div class="rank-Icon">
													<?php echo "<img src='$roleIcon'/>";?>
														<?php echo "<img src='$rankIcon'/ width=50>";?>
															<div class="ratings">
																<?php echo $ratings[$a]->level;?>
															</div>
													</div>
											<?php }}?>
										</td>
									    <td rowspan="2" style="z-index: 0"><img src="<?php echo $HeroImageUrl;?>"width="300px"></td>
									  </tr>
									  <tr>
									    <td style="text-align: center; font-size: 20px;"><?php echo $PlayerName?></td>
									  </tr>
									  <tr style=" text-align: center;">
									    <td style="text-align: left;">영웅</td>
									    <td>플레이시간</td>
									    <td>목숨당처치</td>
									    <td>승률</td>
									  </tr>
									  <tr>
									    <td><?php 
													for($a=0;$a<sizeof($topHeroes);$a++){
													echo $heroName[$a].'<br>';
												}
												?></td>
									    <td style="text-align: right; position: relative; right:20px;"><?php 
													for($a=0;$a<sizeof($topHeroes);$a++){
													echo $heroPlayedTimes[$a].'<br>';
												}
												?></td>
									    <td style="text-align: right; position: relative; right: 10px;"><?php 
													for($a=0;$a<sizeof($topHeroes);$a++){
													echo $kd[$a].'<br>';
												}
												?></td>
									    <td style="text-align: right; position: relative; right: 150px;"><?php 
													for($a=0;$a<sizeof($topHeroes);$a++){
													echo $winrate[$a].'%<br>';
												}
												?></td>
									  </tr>
									</tbody>
								</table>
						 			
									
						 		<?php
				 				}else{
				 					$errMSG = "플레이어의 프로필이 비공개상태입니다.";
				 				}				 			
				 				
					 			?>
					 			
					 			<?php
				 			}
						} else { 
						   $errMSG = "플레이어를 찾을 수 없습니다.";
						} 
			 			
			 			
			 			?>
			 			
			 			<?php			 			
			 			
			 			/*
			 			$url='https://playoverwatch.com/ko-kr/career/pc/'.$battletag;
			 			$html = file_get_html($url);
			 			unset($arr_result);
			 			$username=$html->find('h1.header-masthead')[0];
			 			echo $username;
			 			
			 			if(count($username)>0){
			 				echo $username[0];
			 			}
			 			*/
			 			
			 			
					if(isset($errMSG))echo "<script>alert('$errMSG')</script>";					
				}
			}
	 		?>
	 	</div>
	 </body>
</html>