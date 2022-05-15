<?php require_once("../Controller/script.php");
if(isset($_SESSION['id-admin'])){
  $_SESSION = [];
  session_unset();
  session_destroy();
  header("Location: ../route.php");exit;}
