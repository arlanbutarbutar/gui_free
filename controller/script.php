<?php if(!isset($_SESSION[''])){session_start();}
require_once("db_connect.php");require_once("functions.php");
if (isset($_SESSION['time-message'])) {
  if((time()-$_SESSION['time-message'])>2){
    if(isset($_SESSION['message-success'])){unset($_SESSION['message-success']);}
    if(isset($_SESSION['message-info'])){unset($_SESSION['message-info']);}
    if(isset($_SESSION['message-warning'])){unset($_SESSION['message-warning']);}
    if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
    if(isset($_SESSION['message-dark'])){unset($_SESSION['message-dark']);}
    unset($_SESSION['time-alert']);}}
if(!isset($_SESSION['id-admin'])){
  if(isset($_POST['masuk'])){
    if(entryUserAdmin($_POST)>0){
      header("Location: ../route.php"); exit();}}
  if(isset($_POST['daftar'])){
    if(createUserAdmin($_POST)>0){
      $_SESSION['message-success']="Akun kamu telah terdaftar!";
      $_SESSION['time-message']=time();
      header("Location: signin"); exit();}}
}
if(isset($_SESSION['id-admin'])){
  $idUser=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['id-admin']))));
  $nameServer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['nameServer']))));
  $mailServer=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['mailServer']))));
  $projectView=mysqli_query($conn, "SELECT * FROM t_projects WHERE id_user='$idUser' AND progress<100");
  $data1=25;
  $result1=mysqli_query($conn, "SELECT * FROM t_projects WHERE id_user='$idUser'");
  $total1=mysqli_num_rows($result1);
  $total_page1=ceil($total1/$data1);
  $page1=(isset($_GET['page']))?$_GET['page']:1;
  $awal_data1=($data1*$page1)-$data1;
  $project=mysqli_query($conn, "SELECT * FROM t_projects WHERE id_user='$idUser' ORDER BY id_project ASC LIMIT $awal_data1, $data1");
  if(isset($_POST['add-project'])){
    if(createProject($_POST)>0){
      $_SESSION['message-success']="Data projek berhasil ditambahkan.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();
    }else{
      $_SESSION['message-warning']="Maaf, sepertinya ada kesalahan saat menyambungkan ke database.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();}}
  if(isset($_POST['edit-project'])){
    if(editProject($_POST)>0){
      $_SESSION['message-success']="Data projek berhasil diubah.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();
    }else{
      $_SESSION['message-warning']="Maaf, anda tidak mengubah data apapun.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();}}
  if(isset($_POST['delete-project'])){
    if(deleteProject($_POST)>0){
      $_SESSION['message-success']="Data projek berhasil dihapus.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();
    }else{
      $_SESSION['message-warning']="Maaf, sepertinya ada kesalahan saat menyambungkan ke database.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();}}
  $menuNavbar=mysqli_query($conn, "SELECT * FROM t_menu_navbar WHERE id_user='$idUser'");
  if(isset($_POST['add-menu-navbar'])){
    if(addMenuNavbar($_POST)>0){
      $_SESSION['message-success']="Data menu berhasil ditambahkan.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();
    }else{
      $_SESSION['message-success']="Maaf, sepertinya ada kesalahan saat menyambungkan ke database.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();}}
  if(isset($_POST['hapus-menu'])){
    if(hapusMenu($_POST)>0){
      $_SESSION['message-success']="Data menu berhasil ditambahkan.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();
    }else{
      $_SESSION['message-success']="Maaf, sepertinya ada kesalahan saat menyambungkan ke database.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();}}
  $databases=mysqli_query($conn, "SELECT * FROM t_databases WHERE id_user='$idUser'");
  if(isset($_POST['code-project'])){
    $_SESSION['route']=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['route']))));
    header("Location: views");exit();}
  if(isset($_POST['db-wordpress'])){
    if(dbWordpress($_POST)>0){
      $_SESSION['message-success']="Database wordpress telah dibuat (Default: db_wordpress).";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();
    }else{
      $_SESSION['message-warning']="Maaf, sepertinya ada kesalahan saat menyambungkan ke database.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); exit();
    }
  }
  $db_wordpress=mysqli_query($conn, "SELECT * FROM t_databases WHERE name='db_wordpress'");
}
if(isset($_SESSION['route'])){
  $route=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['route']))));
}

// ==== Fitur pencarian file ====
// $filter = "in";
// $folder = '../'.$route;
// $proses = new RecursiveDirectoryIterator("$folder");
// foreach(new RecursiveIteratorIterator($proses) as $file)
// {
//   if (!((strpos(strtolower($file), $filter)) === false) || empty($filter))
//   {
//     $tampil[] = preg_replace("#/#", "/", $file);
//   }
// }
// sort($tampil);
// print_r($tampil);