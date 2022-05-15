<?php if(!isset($_SESSION)){session_start();}
$date=date("l, d M Y"); $datetime=date("h:i:s a");
if(!isset($_SESSION['id-admin'])){
  function createUserAdmin($data){global $conn,$date,$datetime;
    $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
    $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $checkEmail=mysqli_query($conn, "SELECT * FROM t_users WHERE email='$email'");
    if(mysqli_num_rows($checkEmail)>0){
      $_SESSION['message-danger']="Maaf, email yang kamu masukan sudah ada.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); return false;}
    $id_user=password_hash($email, PASSWORD_DEFAULT);
    $pass=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));$check_lenght_pass=strlen($pass);
    if($check_lenght_pass<8){
      $_SESSION['message-danger']="Maaf, kata sandi terlalu pendek. (Min: 8)!";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']);return false;}
    $password=password_hash($pass, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO t_users(id_user,id_status,username,email,password,date) VALUES('$id_user','2','$username','$email','$password','$date $datetime')");
    return mysqli_affected_rows($conn);}
  function entryUserAdmin($data){global $conn;
    $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
    $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
    $users=mysqli_query($conn, "SELECT * FROM t_users WHERE email='$email'");
    if(mysqli_num_rows($users)==0){
      $_SESSION['message-danger']="Maaf, akun email yang anda masukan belum terdaftar.";
      $_SESSION['time-message']=time();
      header("Location: ".$_SESSION['page-to']); return false;
    }else if(mysqli_num_rows($users)>0){
      $row=mysqli_fetch_assoc($users);
      if($row['id_status']==1){
        $_SESSION['message-danger']="Maaf, akun anda belum diverifikasi, silakan cek email anda untuk memverifikasi akun anda. Jika tidak ada di inbox, cek di spam anda!";
        $_SESSION['time-message']=time();
        header("Location: ".$_SESSION['page-to']); return false;
      }else if($row['id_status']==2){
        if(password_verify($password, $row['password'])){
          $_SESSION['id-admin']=$row['id_user'];
          $_SESSION['nameServer']=$row['username'];
          $_SESSION['mailServer']=$row['email'];
          $_SESSION['dateServer']=$row['date'];
          return mysqli_affected_rows($conn);
        }else{
          $_SESSION['message-danger']="Maaf, kata sandi yang Anda masukkan tidak cocok.";
          $_SESSION['time-message']=time();
          header("Location: ".$_SESSION['page-to']); return false;}}}}
  // function __($data){global $conn;}
}
if(isset($_SESSION['id-admin'])&&$_SESSION['id-admin']!=""){
  function addMenuNavbar($data){global $conn,$idUser;
    $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
    $url=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['url']))));
    mysqli_query($conn, "INSERT INTO t_menu_navbar(id_user,menu_navbar,url) VALUES('$idUser','$name','$url')");
    return mysqli_affected_rows($conn);}
  function createProject($data){global $conn,$date,$idUser;
    $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
    $name_db=str_replace(" ", "_", $name);
    $name_db=strtolower($name_db);
    $checkName=mysqli_query($conn, "SELECT * FROM t_projects WHERE name='$name'");
    if(mysqli_num_rows($checkName)>0){
      $_SESSION['message-danger']="Maaf, nama projek anda sudah terpakai.";
      $_SESSION['time-message']=time();
      return false;}
    $route=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['route']))));
    $route=str_replace(" ", "_", $route);
    $route=strtolower($route);
    $checkRoute=mysqli_query($conn, "SELECT * FROM t_projects WHERE route='$route'");
    if(mysqli_num_rows($checkRoute)>0){
      $_SESSION['message-danger']="Maaf, link rute aplikasi anda terdapat duplikasi silakan pilih rute yang lain.";
      $_SESSION['time-message']=time();
      return false;}
    $progress=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['progress']))));
    // Adding a new work project folder
    // Checking folder
    if ( is_dir($route) ) {
      $_SESSION['message-danger']="Maaf, route kamu sudah ada silakan buat route untuk folder project kamu yang baru.";
      $_SESSION['time-message']=time();
      return false;}
    if ( !mkdir($route, 0777, true) ) {
      $_SESSION['message-danger']="Maaf, folder project yang kamu buat gagal.";
      $_SESSION['time-message']=time();
      return false;}
    // Adding folder
    mkdir($route.'/views', 0777, true);
    mkdir($route.'/assets/css', 0777, true);
    mkdir($route.'/assets/js', 0777, true);
    mkdir($route.'/controller', 0777, true);
    mkdir($route.'/resources/layout', 0777, true);
    mkdir($route.'/resources/pattern', 0777, true);
    mkdir($route.'/vendor', 0777, true);
    // Adding file
    // file index
    $file2 = "index.php";
    $file2 = fopen($route . '/' . $file2,"w");
    fwrite($file2,'
      <!DOCTYPE html>
      <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
        </head>
        <body>
          <script>
          // similar behavior as an HTTP redirect
          window.location.replace("views/welcome");
          </script>
        </body>
      </html>
    ');
    fclose($file2);
    // file welcome in folder app/
    $file3 = "welcome.php";
    $file3 = fopen($route . '/views/' . $file3,"w");
    fwrite($file3,'
      <!DOCTYPE html>
      <html lang="id">
      <head>
          <meta charset="utf-8">
          <title>Netmedia Framecode</title>
      
          <style type="text/css">
      
          ::selection { background-color: #E13300; color: white; }
          ::-moz-selection { background-color: #E13300; color: white; }
      
          body {
              background-color: #fff;
              margin: 40px;
              font: 13px/20px normal Helvetica, Arial, sans-serif;
              color: #4F5155;
          }
      
          a {
              color: #003399;
              background-color: transparent;
              font-weight: normal;
          }
      
          h1 {
              color: #444;
              background-color: transparent;
              border-bottom: 1px solid #D0D0D0;
              font-size: 19px;
              font-weight: normal;
              margin: 0 0 14px 0;
              padding: 14px 15px 10px 15px;
          }
      
          code {
              font-family: Consolas, Monaco, Courier New, Courier, monospace;
              font-size: 12px;
              background-color: #f9f9f9;
              border: 1px solid #D0D0D0;
              color: #002166;
              display: block;
              margin: 14px 0 14px 0;
              padding: 12px 10px 12px 10px;
          }
      
          #body {
              margin: 0 15px 0 15px;
          }
      
          p.footer {
              text-align: right;
              font-size: 11px;
              border-top: 1px solid #D0D0D0;
              line-height: 32px;
              padding: 0 10px 0 10px;
              margin: 20px 0 0 0;
          }
      
          #container {
              margin: 10px;
              border: 1px solid #D0D0D0;
              box-shadow: 0 0 8px #D0D0D0;
          }
          </style>
      </head>
      <body>
      
      <div id="container">
          <h1>Welcome to Netmedia Framecode</h1>
      
          <div id="body">
              <p>The page you are looking at is being generated dynamically by Netmedia Framecode.</p>
      
              <p>If you would like to edit this page you"ll find it located at:</p>
              <code>views/welcome.php</code>
      
              <p>Your project <a href="index">Open</a>.</p>
          </div>
      </div>
      
      </body>
      </html>
    ');
    fclose($file3);
    // file index in folder app/
    $file4 = "index.php";
    $file4 = fopen($route . '/views/' . $file4,"w");
    fwrite($file4,'
      <!DOCTYPE html>
      <html lang="en">
        <head>
          <?php require_once("../resources/layout/header.php");?>
        </head>
        <body>
          <?php require_once("../resources/layout/navbar.php");?>
          <!-- Code Welcome -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </symbol>
                </svg>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                  <div>
                    Hallo '.$_SESSION['nameServer'].', terima kasih sudah menggunakan <strong>XAMPP Modify from ar.code_</strong> . Silakan lanjutkan project kamu, semangat ngoding '.$_SESSION['nameServer'].' :) .
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Code Welcome -->

          <!-- Code Project -->
          <!-- ... -->
          <!-- End Code Project -->
          <?php require_once("../resources/layout/header.php");?>
        </body>
      </html>
    ');
    fclose($file4);
    // file functions in folder controller/
    $file5 = "functions.php";
    $file5 = fopen($route . '/controller/' . $file5,"w");
    // file script in folder controller/
    $file6 = "script.php";
    $file6 = fopen($route . '/controller/' . $file6,"w");
    fwrite($file6,'
      <?php require_once("db_connect.php"); require_once("functions.php");

        // for your information!!
        // file db_connect.php dan functions.php berada di satu folder yang sama dengan script.php
        // file db_connect.php berfungsi untuk menghubungkan atau koneksi data dari web ke database
        // file functions.php berfungsi sebagai sebuah code system kamu untuk bisa melakukan CRUD dan manipulasi data
        // Jika kamu bingung silakan kirim pesan kepada kami di support@net-code.tech

        // Silakan menambahkan dibawah untuk melanjutkan project kamu
    ');
    fclose($file6);
    // file db_connect in folder controller/
    $file7 = "db_connect.php";
    $file7 = fopen($route . '/controller/' . $file7,"w");
    fwrite($file7,'
      <?php 
        // Ubah sesuai Web Server Local yang kalian gunakan
        // Sebagai contoh Web Server XAMPP, kalian ubah password dan nama database sesuai yang ada di XAMPP kalian

        $conn=mysqli_connect("localhost","root","","'.$name_db.'");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);}
    ');
    fclose($file7);
    // file header in folder /resources/layout/
    $file8 = "header.php";
    $file8 = fopen($route . '/resources/layout/' . $file8,"w");
    fwrite($file8,'
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>'.$name.'</title>
      <!-- kamu bisa menggunakan assets bootstrap dan memanggilnya dari folder htdocs/assets/css/ -->
      <!-- atau kamu gunakan Bootstrap CDN via jsDelivr, namum jika kamu gunakan ini maka kamu butuh koneksi internet-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    ');
    fclose($file8);
    // file navbar in folder /resources/layout/
    $file9 = "navbar.php";
    $file9 = fopen($route . '/resources/layout/' . $file9,"w");
    // file footer in folder /resources/layout/
    $file10 = "footer.php";
    $file10 = fopen($route . '/resources/layout/' . $file10,"w");
    fwrite($file10,'
      <!-- kamu bisa menggunakan assets bootstrap dan memanggilnya dari folder htdocs/assets/js/ -->
      <!-- atau kamu gunakan Bootstrap CDN via jsDelivr, namum jika kamu gunakan ini maka kamu butuh koneksi internet-->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    ');
    fclose($file10);
    mysqli_query($conn, "CREATE DATABASE $name_db");
    mysqli_query($conn, "INSERT INTO t_databases(id_user,name) VALUES('$idUser','$name_db')");
    mysqli_query($conn, "INSERT INTO t_projects(id_user,name,route,progress,date) VALUES('$idUser','$name','$route','$progress','$date')");
    return mysqli_affected_rows($conn);}
  function editProject($data){global $conn;
    $id_project=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-project']))));
    $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
    $nameOld=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nameOld']))));
    if($name!=$nameOld){
      $checkName=mysqli_query($conn, "SELECT * FROM t_projects WHERE name='$name'");
      if(mysqli_num_rows($checkName)>0){
        $_SESSION['message-danger']="Maaf, nama projek anda sudah terpakai.";
        $_SESSION['time-message']=time();
        return false;}}
    $route=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['route']))));
    $routeOld=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['routeOld']))));
    if($route!=$routeOld){
      rename($routeOld, $route);
      $checkRoute=mysqli_query($conn, "SELECT * FROM t_projects WHERE route='$route'");
      if(mysqli_num_rows($checkRoute)>0){
        $_SESSION['message-danger']="Maaf, link rute aplikasi anda terdapat duplikasi silakan pilih rute yang lain.";
        $_SESSION['time-message']=time();
        return false;}}
    $progress=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['progress']))));
    $progressOld=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['progressOld']))));
    if(empty($progress)){
      $progress=$progressOld;}
    $domain=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['domain']))));
    $domainOld=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['domainOld']))));
    if($domain!=$domainOld){
      $checkDomain=mysqli_query($conn, "SELECT * FROM t_projects WHERE domain='$domain'");
      if(mysqli_num_rows($checkDomain)>0){
        $_SESSION['message-danger']="Maaf, domain yang ingin anda gunakan sama dengan domain lama.";
        $_SESSION['time-message']=time();
        return false;}}
    mysqli_query($conn, "UPDATE t_projects SET name='$name', route='$route', progress='$progress', domain='$domain' WHERE id_project='$id_project'");
    return mysqli_affected_rows($conn);}
  function deleteProject($data){global $conn;
    $id_project=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-project']))));
    $checkID=mysqli_query($conn, "SELECT * FROM t_projects WHERE id_project='$id_project'");
    if(mysqli_num_rows($checkID)==0){
      $_SESSION['message-danger']="Maaf, sepertinya ada kesalahan dalam pemanggilan data.";
      $_SESSION['time-message']=time();
      return false;}
    $route=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['route']))));
    destroyDir($route);
    $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
    $name_db=str_replace(" ", "_", $name);
    $name_db=strtolower($name_db);
    mysqli_query($conn, "DELETE FROM t_databases WHERE name='$name_db'");
    mysqli_query($conn, "DROP DATABASE $name_db");
    mysqli_query($conn, "DELETE FROM t_projects WHERE id_project='$id_project'");
    return mysqli_affected_rows($conn);}
  function destroyDir($dir,$virtual=false){
    $ds=DIRECTORY_SEPARATOR;
    $dir=$virtual?realpath($dir):$dir;
    $dir=substr($dir,-1)==$ds?substr($dir,0,-1):$dir;
    if(is_dir($dir)&&$handle=opendir($dir)){
      while($file=readdir($handle)){
        if($file=='.'||$file=='..'){
          continue;
        }elseif(is_dir($dir.$ds.$file)){
          destroyDir($dir.$ds.$file);
        }else{
          unlink($dir.$ds.$file);}}
      closedir($handle);
      rmdir($dir);
      return true;
    }else{
      return false;}}
  function hapusMenu($data){global $conn;
    $id_menu=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-menu']))));
    mysqli_query($conn, "DELETE FROM t_menu_navbar WHERE id_menu_navbar='$id_menu'");
    return mysqli_affected_rows($conn);}
  function dbWordpress(){global $conn,$idUser;
    mysqli_query($conn, "CREATE DATABASE db_wordpress");
    mysqli_query($conn, "INSERT INTO t_databases(id_user,name) VALUES('$idUser','db_wordpress')");
    return mysqli_affected_rows($conn);}
  // function __($data){global $conn;}
}