<?php

include('dbcon.php');
include('check.php');
ob_start();
include('left_nav.php');

if (is_login()){

    if ($_SESSION['user_id'] == 'admin' && $_SESSION['is_admin']==1)
        header("Location: admin.php");
    else
        header("Location: index.php");
}


function validatePassword($password){
	
	if(strlen($password) < 8 || empty($password)) {
		return 0; //글자수 제한
	}
	if((strlen($password) > 30)) {
		return 0; //글자수 제한
	}	
	if(preg_match('/[A-Z]/',$password) == (0 || false)||
        !preg_match('/[\d]/',$password) != (0 || false)||
        preg_match('/[\W]/',$password) == (0 || false))
    {
		return 0;//대문자,숫자,특수문자 포함여부 체크
	}
	return true;
}


if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']))
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

    $username=$_POST['newusername'];
    $password=$_POST['newpassword'];
    $confirmpassword=$_POST['newconfirmpassword'];
    $userprofile=$_POST['newuserprofile'];

    if(!validatePassword($password)){
        $errMSG="패스워드는 8자이상 48자미만 대문자, 숫자, 특수기호를 포함해야합니다.";
    }



    if ($_POST['newpassword'] != $_POST['newconfirmpassword']) {
        $errMSG = "패스워드가 일치하지 않습니다.";
    }

    if(empty($username)){
       $errMSG = "아이디를 입력하세요.";
   }
   else if(empty($password)){
       $errMSG = "패스워드를 입력하세요.";
   }
   else if(empty($userprofile)){
       $errMSG = "닉네임을 입력하세요.";
   } 

   try { 
    $stmt = $con->prepare('select * from users where username=:username');
    $stmt->bindParam(':username', $username);
    $stmt->execute();

} catch(PDOException $e) {
    die("Database error: " . $e->getMessage()); 
}

$row = $stmt->fetch();
if ($row){
    $errMSG = "이미 존재하는 아이디입니다.";
}
try { 
    $stmt = $con->prepare('select * from users where userprofile=:userprofile');
    $stmt->bindParam(':userprofile', $userprofile);
    $stmt->execute();

} catch(PDOException $e) {
    die("Database error: " . $e->getMessage()); 
}

$row = $stmt->fetch();
if ($row){
    $errMSG = "이미 존재하는 닉네임입니다.";
}



if(!isset($errMSG))
{
   try{
       $stmt = $con->prepare('INSERT INTO users(username, password, userprofile, salt) VALUES(:username, :password, :userprofile, :salt)');
       $stmt->bindParam(':username',$username);
       $salt = bin2hex(openssl_random_pseudo_bytes(32));
       $encrypted_password = base64_encode(encrypt($password, $salt));
       $stmt->bindParam(':password', $encrypted_password);
       $stmt->bindParam(':userprofile',$userprofile);		
       $stmt->bindParam(':salt',$salt);		

       if($stmt->execute())
       {
        $successMSG = "회원가입 완료!";
        header("refresh:1;index.php");
    }
    else
    {
        $errMSG = "회원가입 실패!";
    }
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage()); 
}



}


}


?>
<!DOCTYPE html>
<html>
<head>
    <title>회원가입</title>  
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
            width: 250px;
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
            width: 250px;
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
            text-align: center;
            width: 50px;
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




	
 <?php
 if(isset($errMSG)){
   ?>
   <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
</div>
<?php
}
else if(isset($successMSG)){
  ?>
  <div class="alert alert-success">
      <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
  </div>
  <?php
}
?>  
<center>
<div class="container">  
        <form id="form" method="post" enctype="multipart/form-data" style="color:white; width:400px;">
            <div>
             <h1 align="center">회원가입</h1><hr>
         </div>

         <? $r1 = rmd5(rand().mocrotime(TRUE)); ?>
         <div class="form-group">
            <label for="<? echo $r1; ?>" style="display:inline-block; width: 88px;">아이디</label>
            <input class="id-input" type="text" name="<? echo $r1; ?>" placeholder="아이디를 입력하세요." autocomplete="off" readonly 
            onfocus="this.removeAttribute('readonly');" />
            <input type="hidden" name="__autocomplete_fix_<? echo $r1; ?>" value="newusername" /> 
        </div>


        <? $r2 = rmd5(rand().mocrotime(TRUE)); ?>
        <div  class="form-group">
            <label for="<? echo $r2; ?>" style="display:inline-block; width: 103px;">패스워드</label>
            <input class="pw-input" type="password" name="<? echo $r2; ?>"  placeholder="패스워드를 입력하세요" autocomplete="off" readonly 
            onfocus="this.removeAttribute('readonly');" />
            <input type="hidden" name="__autocomplete_fix_<? echo $r2; ?>" value="newpassword" /> 
        </div>

        <? $r3 = rmd5(rand().mocrotime(TRUE)); ?>
        <div  class="form-group">
         <label for="<? echo $r3; ?>" >패스워드 확인</label>

         <input class="pw-input" type="password" name="<? echo $r3; ?>"  placeholder="패스워드를 다시 한번 입력하세요" autocomplete="off" readonly 
         onfocus="this.removeAttribute('readonly');" />
         <input type="hidden" name="__autocomplete_fix_<? echo $r3; ?>" value="newconfirmpassword" /> 
     </div>

     <? $r4 = rmd5(rand().mocrotime(TRUE)); ?>
     <div  class="form-group">
        <label for="<? echo $r4; ?>" style="display:inline-block; width: 88px;">닉네임</label>
        <input class="id-input" type="text" name="<? echo $r4; ?>" placeholder="닉네임을 입력하세요" autocomplete="off" readonly 
        onfocus="this.removeAttribute('readonly');" />
        <input type="hidden" name="__autocomplete_fix_<? echo $r4; ?>" value="newuserprofile" /> 
    </div>

    <div style="text-align: center;margin-top: 10px;">
        <button type="submit" name="submit"  class="btn-red"><span class="glyphicon glyphicon-floppy-save"></span>완료</button>
    </div>

</form>
</div>
</ceter>

</body>
</html>