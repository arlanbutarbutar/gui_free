<?php require_once("controller/functions.php");
  $_SESSION['page-name']="GUI - Configuration Databases"; $_SESSION['page-to']="gui-config";
  if(isset($_POST['gui-config'])){
    $date=date("l, d M Y");
    $conn_check = mysqli_connect('localhost', 'root', '', 'performance_schema');
    mysqli_query($conn_check, "CREATE DATABASE gui_free");
    mysqli_query($conn_check, "CREATE TABLE gui_free.t_databases (
      id_database int PRIMARY KEY AUTO_INCREMENT,
      id_user varchar(100),
      name varchar(50)
    );");
    mysqli_query($conn_check, "CREATE TABLE gui_free.t_menu_navbar (
      id_menu_navbar int PRIMARY KEY AUTO_INCREMENT,
      id_user varchar(100),
      menu_navbar varchar(100),
      url varchar(225)
    );");
    mysqli_query($conn_check, "CREATE TABLE gui_free.t_projects (
      id_project int PRIMARY KEY AUTO_INCREMENT,
      id_user varchar(100),
      name varchar(50),
      route varchar(50),
      progress int,
      domain varchar(225),
      date varchar(35)
    );");
    mysqli_query($conn_check, "CREATE TABLE gui_free.t_users (
      id_user varchar(100) PRIMARY KEY,
      id_status int,
      username varchar(100),
      email varchar(75),
      password varchar(75),
      date varchar(35)
    );");
    mysqli_query($conn_check, "INSERT INTO gui_free.t_users(id_user, id_status, username, email, password, date) VALUES('$2y$10$vWgHQ0nZVP2u/Q2Z7fvg2OWYQNFdfYfBX106t4V1n2ht98bflHiPS','2','admin','admin@gui.my.id','$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG','$date')");
    mysqli_query($conn_check, "CREATE TABLE gui_free.t_users_status (
      id_status int PRIMARY KEY AUTO_INCREMENT,
      status varchar(35)
    );");
    mysqli_query($conn_check, "INSERT INTO gui_free.t_users_status(id_status, status) VALUES('1','Tidak Aktif'), ('2','Aktif')");
    $_SESSION['message-success']="Konfigurasi telah selesai, silahkan daftarkan akunmu dan mulai project baru kamu!";
    $_SESSION['time-message']=time();
    header("Location: auth/signin"); exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("resources/layout/header.php");?>
  </head>
  <body class="az-body" style="font-family: 'Quicksand', sans-serif;">
    <div class="az-signin-wrapper">
      <div class="az-card-signin border-0 shadow text-center" style="border-radius: 15px;height: 350px;">
        <h1 class="font-weight-bold"><img src="resources/img/GUI.png" style="width: 75px;" alt=""> GUI Config</h1>
        <h4 class="mt-n3">Netmedia Framecode</h4>
        <div class="az-signin-header">
          <h3 style="color: #2078e5;">Selamat datang kembali!</h3>
          <p>Silakan mulai untuk membuat konfigurasi database GUI otomatis di phpMyAdmin kamu!</p>
          <form action="" method="POST">
            <button type="submit" name="gui-config" class="btn btn-primary btn-lg shadow btn-block" style="border-radius: 10px;">Mulai</button>
          </form>
        </div>
      </div>
    </div>
    <?php require_once("resources/layout/footer.php");?>
  </body>
</html>
