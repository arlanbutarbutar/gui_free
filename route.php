<?php if(!isset($_SESSION)){session_start();}
  if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	  $uri = 'https://';
  }else{
	  $uri = 'http://';
  }
  $uri .= $_SERVER['HTTP_HOST'];
  $servername = "localhost";
  $database = "gui_free";
  $username = "root";
  $password = "";
  $conn_check = mysqli_connect($servername, $username, $password, $database);
  if(!$conn_check){
	  header('Location: '.$uri.'/apps/gui_free/gui-config'); exit();
  }
  if(!isset($_SESSION['id-admin'])){
    header('Location: '.$uri.'/apps/gui_free/auth/signin'); exit();
  }
  if(isset($_SESSION['id-admin'])){
    header('Location: '.$uri.'/apps/gui_free/home'); exit();
  }
?>