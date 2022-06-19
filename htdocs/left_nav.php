<html>
<head>
  <style>

    .left-nav{  
      position: fixed;
      left: 0;
      top: 0;
      bottom: 0;
      width: 170px;
      background-color: #0f1415;
      height: 100%;   
      display: block;
      overflow-x: hidden;
      transition: 0.3s;
      z-index: 99; 
      overflow: scroll;
      -ms-overflow-style: none; /* IE and Edge */
      scrollbar-width: none; /* Firefox */     
    }
    .left-nav::-webkit-scrollbar {
     display: none; /* Chrome, Safari, Opera*/
   }
   .left-nav .closebtn {
    position: absolute;
    top: 90px;
    right: 10px;
    font-size: 36px;
    margin-left: 50px;
  }

  @media screen and (max-height: 450px) {
    .left-nav {padding-top: 15px;}
    .left-nav div {font-size: 18px;}
  } 
  .logo{
    text-align-last: center;
    align-items: center;
    font-weight:  bold;
    font-size: 30px;           
    margin-top : 30px;    
    margin-bottom : 35px;
    padding-bottom: 20px;
    border-bottom: 3px solid #222933;
  }

  .MainLogo{
    position: fixed;
    top:20px;
    left:60px;
    text-align-last: center;
    align-items: center;
    font-weight:  bold;
    font-size: 30px;          

  }
  .nav-item{        
    align-items: center;
    margin-left: 30px;
    margin-top: 25px;
    color: white;
    font-weight: bold;
    font-size: 22px;
    transition: 0.3s;
  }
  .nav-item-bottom{
    position: relative;
    margin-left: 30px;
    margin-top: 25px;
    color: white;
    font-weight: bold;
    font-size: 22px; 
    transition: 0.3s; 
  }
  .btn-left-nav{
    position: fixed;
    color: white;
    top:20px;
    left:20px;
    font-size:30px;
    cursor:pointer;
  } 

  a:link { color: white; text-decoration: none;}
  a:visited { color: white; text-decoration: none;}
  a:hover { color: gray;}
</style>
</head>
<body>
  <span class="btn-left-nav" onclick="openNav()"><a>&#9776;</a></span> 
  <div id="left-nav" class="left-nav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="logo"><a href="index.php" style="color:#b30000;">ScriMup</a></div>
    
    <div class="nav-item"><a href="scrim.php">스크림</a></div>
    <div class="nav-item"><a href="party.php">팀모집</a></div>
    <div class="nav-item"><a href="community.php">자유게시판</a></div>
    <div class="nav-item"><a href="search_gamerecord.php">전적검색</a></div>
    <?php    
    if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
      ?>
      <div class="nav-item"><a href="mypage.php" >마이페이지</a></div>
      <div class="nav-item-bottom"><a href="logout.php" style="margin-top: 25px">로그아웃</a></div>
      <?php
    }else{
      ?>
      <div class="nav-item"><a href="login.php">로그인</a></div>
      <?php

    }
    ?>           
  </div>

  <script>
    function openNav() {
      document.getElementById("left-nav").style.width = "170px";
    }

    function closeNav() {
      document.getElementById("left-nav").style.width = "0";
    }
  </script>
</body>

</html>
