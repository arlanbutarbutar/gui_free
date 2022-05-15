<?php require_once("../controller/script.php");
  if(isset($_SESSION['id-admin'])){header("Location: ../route.php");exit;}
  if(isset($_GET['en']) && $_GET['en']!=""){
    $data=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['en']))));
    $_SESSION['page-name']="Signin - GUI Netmedia Framecode"; $_SESSION['page-to']="signin?en=".$data;
    mysqli_query($conn, "UPDATE t_users SET id_status='2' WHERE id_user='$data'");
  }else{
    $_SESSION['page-name']="Signin - GUI Netmedia Framecode"; $_SESSION['page-to']="signin";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once("../resources/layout/auth-header.php");?>
  </head>
  <body class="az-body" style="font-family: 'Quicksand', sans-serif;">
    <?php if(isset($_SESSION['message-success'])){?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success']?>"></div>
    <?php } if(isset($_SESSION['message-info'])){?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info']?>"></div>
    <?php } if(isset($_SESSION['message-warning'])){?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning']?>"></div>
    <?php } if(isset($_SESSION['message-danger'])){?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger']?>"></div>
    <?php }?>
    <div class="az-signin-wrapper">
      <div class="az-card-signin border-0 shadow text-center" style="border-radius: 15px;">
        <h1 class="font-weight-bold"><img src="../resources/img/GUI.png" style="width: 75px;" alt=""> GUI</h1>
        <h4 class="mt-n3">Netmedia Framecode</h4>
        <div class="az-signin-header">
          <h3 style="color: #2078e5">Selamat datang kembali!</h3>
          <p>Silakan masuk untuk mengelola proyek anda.</p>
          <form action="" method="POST">
            <div class="form-group">
              <label>e-Mail</label>
              <input type="email" name="email" class="form-control border-0 shadow text-center" style="border-radius: 10px;" placeholder="e-Mail" required autofocus>
            </div>
            <div class="form-group">
              <label>Kata Sandi</label>
              <input type="password" name="password" class="form-control border-0 shadow text-center" style="border-radius: 10px;" placeholder="Kata Sandi" required>
            </div>
            <button type="submit" name="masuk" class="btn btn-primary btn-sm btn-block" style="border-radius: 10px;">Masuk</button>
          </form>
        </div>
        <div class="az-signin-footer">
          <p>Belum punya akun? <a class="text-primary" style="cursor: pointer;" onclick="window.location.href='signup'">buat akun baru</a></p>
        </div>
      </div>
    </div>
    <?php require_once("../resources/layout/auth-footer.php");?>
  </body>
</html>
