<?php 
  $conn=mysqli_connect("localhost","root","","gui_free");
  if (!$conn) {
	  header('Location: ../gui-config'); exit();
  }