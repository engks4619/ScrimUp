<?php
    include('dbcon.php'); 
    include('check.php');

    if(is_login()){

        if ($_SESSION['user_id'] == 'admin' && $_SESSION['is_admin']==1)
            header("Location: admin.php");
        else 
            header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>로그인</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap1.min.css">
	<style>
    	.body, html{
	        background: #222933;        
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
<?php include('left_nav.php');
?>
<div class="container">

	<h2 align="center">로그인</h2><hr>
	<form class="form-horizontal" method="POST">
		<div class="form-group" style="padding: 10px 10px 10px 10px;">
			<label for="user_name">아이디:</label>
			<input type="text" name="user_name"  class="form-control" id="inputID" placeholder="아이디를 입력하세요." 
				required autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" />
		</div>
		<div class="form-group" style="padding: 10px 10px 10px 10px;">
			<label for="user_password">패스워드:</label>
			<input type="password" name="user_password" class="form-control" id="inputPassword" placeholder="패스워드를 입력하세요." 
				required  autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" />
		</div>
		<div class="checkbox">
			<label><input type="checkbox"> 아이디 기억</label>
		</div>
		</br>
		<div class="from-group" style="padding: 10px 10px 10px 10px;" >
			<button type="submit" name="login" class="btn btn-success">로그인</button>
			<a class="btn btn-success" href="registration.php" style="margin-left: 50px">
			<span class="glyphicon glyphicon-user"></span>&nbsp;등록
			</a>
		</div>
		</br>
	</form>
</div>
</body>
</html>


<?php

    $login_ok = false;

    if ( ($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['login']) )
    {
		$username=$_POST['user_name'];  
		$userpassowrd=$_POST['user_password'];  

		if(empty($username)){
			$errMSG = "아이디를 입력하세요.";
		}else if(empty($userpassowrd)){
			$errMSG = "패스워드를 입력하세요.";
		}else{
			

			try { 

				$stmt = $con->prepare('select * from users where username=:username');

				$stmt->bindParam(':username', $username);
				$stmt->execute();
			   
			} catch(PDOException $e) {
				die("Database error. " . $e->getMessage()); 
			}

			$row = $stmt->fetch();  
			$salt = $row['salt'];
			$password = $row['password'];
			
			$decrypted_password = decrypt(base64_decode($password), $salt);

			if ( $userpassowrd == $decrypted_password) {
				$login_ok = true;
			}
		}

		
		if(isset($errMSG)) 
			echo "<script>alert('$errMSG')</script>";
		

        if ($login_ok){

            if ($row['activate']==0)
				echo "<script>alert('$username 계정 활성이 안되었습니다. 관리자에게 문의하세요.')</script>";
            else{
					session_regenerate_id();
					$_SESSION['user_id'] = $username;
					$_SESSION['is_admin'] = $row['is_admin'];

					if ($username=='admin' && $row['is_admin']==1 )
						header('location:admin.php');
					else
						header('location:index.php');
					session_write_close();
			}
		}
		else{
			echo "<script>alert('$username 인증 오류')</script>";
		}
	}
?>