<?php
   
    include('dbcon.php');
    include('check.php');
    ob_start();
    include('left_nav.php');
   
    if (is_login()){
    	;
    }else{
    	header("Location: index.php"); 
    }


	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']) && $_GET['edit_id']==$_SESSION['user_id'])
	{
		$edit_id = $_GET['edit_id'];
		$stmt_edit = $con->prepare('SELECT * FROM users WHERE username = :user_id');
		$stmt_edit->execute(array(':user_id'=>$edit_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}


	if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['btn_save_updates']))
	{
        foreach ($_POST as $key => $val)
        {
            if(preg_match('#^__autocomplete_fix_#', $key) === 1){
                $n = substr($key, 19);
                if(isset($_POST[$n])) {
                    $_POST[$val] = $_POST[$n];
            }
        }
        } 



		$user_id = $_POST['editusername'];
		$user_password = $_POST['editpassword'];		
		$userprofile = $_POST['edituserprofile'];		
		if ( isset($_POST['activate'])) $activate=1;
		else $activate=0;

		try { 
			$stmt = $con->prepare('select * from users where username=:username');
			$stmt->bindParam(':username', $user_id);
			$stmt->execute();

	   } catch(PDOException $e) {
			die("Database error: " . $e->getMessage()); 
	   }

	   $row = $stmt->fetch();
	   $password = $row['password'];
	   $salt = $row['salt']; 


		if(!isset($errMSG))
		{
			$stmt = $con->prepare('UPDATE users SET password=:user_password, userprofile=:userprofile, activate=:activate WHERE username=:user_id');
			$stmt->bindParam(':user_id',$user_id);
			$stmt->bindParam(':userprofile',$userprofile);
			$stmt->bindParam(':activate',$activate);
                        $encrypted_password = base64_encode(encrypt($user_password, $salt));
                        $stmt->bindParam(':user_password', $encrypted_password);
			$stmt->bindParam(':userprofile',$userprofile);		
			
			if($stmt->execute()){
				?>
                                <script>
				alert('업데이트 성공');
				window.location.href='mypage.php';
				</script> 
                <?php
			}
			else{
				$errMSG = "업데이트 실패";
			}
		}			
	}
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>회원정보 수정</title>	
	<style>
		.body, html{
			background: rgb(26, 29, 33) !important;       
			font-family: trade-gothic-next, "Noto Sans", "Malgun Gothic", "맑은 고딕", sans-serif;

		}
		.container{
			margin-top: 10%;
			width: 500px;
			height: 350px;	      	
			display: flex;
			justify-content: center;
			align-items: center;
			background-color: #1f2226;
		}

		.id-input{
			width: 300px;
			height: 30px;
			margin-left: 15px;
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
		.pw-input{
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
		.btn-login{
			border: 1px solid transparent;
			width: 70px;
			height: 25px;
			background-color: #c71f1f;
			color: hsla(0,0%,100%,.8);
			border-radius: 2px;
			text-align: center;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			margin-right: 10px;		    
		}
		.btn-registration{
			border: 1px solid transparent;
			width: 70px;
			height: 25px;
			background-color: #c71f1f;
			color: hsla(0,0%,100%,.8);
			border-radius: 2px;
			text-align: center;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			margin-left: 10px;
		}
		.form-group{
			padding: 10px 10px 10px 10px;
			text-align: left;
		}
	</style>
	
</head>


<body>
<body>
<center>
<div class="container">
	
<form id="myform" method="post" enctype="multipart/form-data" style="width: 400px; color: white;">
	<div>
    	<h1>회원정보 수정</h1><hr>
    </div>
    <?php
	if(isset($errMSG)){
		echo "<script>alert('$errMSG')</script>";
	}
	?>
	
        <? $r1 = rmd5(rand().mocrotime(TRUE)); ?>
        <div class="form-group">
    	<label >아이디</label>       
        <input id="id" class="id-input" type="text" name="<? echo $r1; ?>" value="<?php echo $username; ?>" placeholder="아이디를 입력하세요." autocomplete="off" readonly   />
        <input type="hidden" name="__autocomplete_fix_<? echo $r1; ?>" value="editusername" /> 
      	</div>
        <? $r2 = rmd5(rand().mocrotime(TRUE)); ?>
        <div class="form-group">
    	<label>패스워드</label>
        <?php
        $decrypted_password = decrypt(base64_decode($password), $salt);
        ?>
        <input id="pw" class="pw-input" type="password" name="<? echo $r2; ?>" value="<?php echo $decrypted_password; ?>" placeholder="패스워드를 입력하세요." 
               autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required />
        <input type="hidden" name="__autocomplete_fix_<? echo $r2; ?>" value="editpassword" /> 
       	</div class="form-group">
        <? $r3 = rmd5(rand().mocrotime(TRUE)); ?>
        <div>
    	<label >닉네임</label>
        <input class="id-input" type="text" name="<? echo $r3; ?>" value="<?php echo $userprofile; ?>" placeholder="닉네임을 입력하세요." 
               autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" required />
        <input type="hidden" name="__autocomplete_fix_<? echo $r3; ?>" value="edituserprofile" /> 
       </div>
	
       
		<button type="submit" name="btn_save_updates" class="btn-login">수정</button>
        <button type="button" class="btn-registration" style="margin-top: 10px;" onclick="location.href='mypage.php'">취소</button>
  
</form>
</div>
</center>
</body>
</html>