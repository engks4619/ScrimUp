<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)


error_reporting(E_ALL);

define('CLIENT_ID', '05b8fc3803d347058d96621464b0bd5b');
define('CLIENT_SECRET', 'E5o2Yilh5WCW85J5qVtpklNADe7h7KF2');
define('REDIRECT_URI', 'https://scrimmatchup.mooo.com:443/battlenetlogin.php');
define('SCOPE','openid');

$authorizeURL = 'https://apac.battle.net/oauth/authorize';
$tokenURL = 'https://apac.battle.net/oauth/token';
$apiURLBase = 'https://apac.battle.net/oauth/userinfo';

session_start();


// Start the login process by sending the user to Discord's authorization page
if(get2('action') == 'login') {
  $params = array(
    'response_type' => 'code',
    'client_id' => CLIENT_ID,
    'scope' => SCOPE, 
    'redirect_uri' => REDIRECT_URI,
  );
 

  // Redirect the user to Discord's authorization page
  header('Location: https://apac.battle.net/oauth/authorize' . '?' . http_build_query($params));
  die();
}


// When Discord redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get2('code')) {

  // Exchange the auth code for a token
  $token = apiRequest2($tokenURL, array(
    "grant_type" => "authorization_code",
    'response_type' => 'code',
    'client_id' => CLIENT_ID,
    'client_secret' => CLIENT_SECRET,
    'redirect_uri' => 'https://scrimmatchup.mooo.com:443/battlenetlogin.php',
    'code' => get2('code')
  ));
  $logout_token = $token->access_token;
  $_SESSION['access_token'] = $token->access_token;


  header('Location: ' . $_SERVER['PHP_SELF']);
}
if(get2('action')=='logout'){
  session_destroy();
}

if(session2('access_token')) {
  $openid = apiRequest2($apiURLBase);
  $battlenetname="$openid->battletag";
  $stmt = $con->prepare("UPDATE users SET battlenetname = '$battlenetname' WHERE username=:uname");
  $stmt->bindParam(':uname', $user_id);
  $stmt->execute(); 

  echo '<h3>Logged In</h3>';  
  echo '<pre>';
    print_r($openid);
  echo '</pre>';
  echo '<p><a href="?action=logout">Log Out</a></p>';

} else {
  echo '<h3>Not logged in</h3>';
  echo '<p><a href="?action=login">Log In</a></p>';
}


if(get2('action') == 'logout') {
  // This must to logout you, but it didn't worked(
  session_destroy();
  $params = array(
    'access_token' => $logout_token
  );

  // Redirect the user to Discord's revoke page
  header('Location: https://battle.net/oauth/token/revoke' . '?' . http_build_query($params));
  die();
}

    function apiRequest2($url, $post=FALSE, $headers=array()) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $response = curl_exec($ch);


    if($post)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

    $headers[] = 'Accept: application/json';

    if(session2('access_token'))
      $headers[] = 'Authorization: Bearer ' . session2('access_token');

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    return json_decode($response);
  }

  function get2($key, $default=NULL) {
    return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
  }

  function session2($key, $default=NULL) {
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
  }



?>
