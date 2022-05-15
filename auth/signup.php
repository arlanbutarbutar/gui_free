<?php require_once("../controller/script.php");
  if(isset($_SESSION['id-admin'])){header("Location: ../route.php");exit;}
  $_SESSION['page-name']="Signup - GUI Netmedia Framecode"; $_SESSION['page-to']="signup";
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
    <div class="az-signup-wrapper">
      <div class="az-column-signup-left">
        <div>
          <img src="../resources/img/netmedia-framecode.png" style="width: 100px" alt="Icon Brand">
          <h1>Netmedia Framecode</h1>
          <p>Netmedia Framecode adalah layanan pembuatan website yang dibuat dengan tujuan untuk membantu dalam digitalisasi UKM. NET dibuat oleh pribadi atau satu orang saja dalam usahanya untuk mengembangkan diri dan juga dunia usaha yang masih belum mengandalkan teknologi di bidang aplikasi berbasis website. Saat ini pada tahun 2021 NET telah merubah diri bekerja sama dengan berbagai anak-anak muda milenial di kota kupang dengan hobi di bidang developer, designer, dan juga full stack. Pemilik NET sejauh ini telah mengantongi berbagai sertifikat dari <a style="cursor: pointer;" onclick="window.location.href='https://dicoding.com'" class="text-decoration-none text-primary">Dicoding</a>, <a style="cursor: pointer;" onclick="window.location.href='https://codepolitan.com'" class="text-decoration-none text-primary">Codepolitan</a>, dan <a style="cursor: pointer;" onclick="window.location.href='https://id.alibabacloud.com/?accounttraceid=3e4404f16fca404f8f6a3175300f25efagsz'" class="text-decoration-none text-primary">Alibaba Cloud Indonesia</a>. NET ingin mengucapkan terima kasih kepada klien NET yang telah mempercayakan layanan NET ini. Thks Guys :)</p>
          <span>Salam hangat,</span><br>
          <span>Sahala Z.R Butar Butar</span><br>
          <span>Founder Netmedia Framecode</span><br><br><br>
          <a style="cursor: pointer;border-radius: 10px;" onclick="window.location.href='https://www.netmedia-framecode.com'" class="btn btn-outline-primary shadow" target="_blank">Lihat Layanan</a>
        </div>
      </div>
      <div class="az-column-signup border-0 shadow text-center">
        <h1>GUI</h1>
        <h4 class="mt-n5">Netmedia Framecode</h4>
        <div class="az-signup-header">
          <h2 class="text-primary">Memulai</h2>
          <p>Ini gratis untuk mendaftar dan hanya membutuhkan satu menit.</p>
          <form action="" method="POST">
            <div class="form-group">
              <label>Nama Panggilan</label>
              <input type="text" name="username" class="form-control border-0 shadow text-center" style="border-radius: 10px;" placeholder="Nama Panggilan" required>
            </div>
            <div class="form-group">
              <label>e-Mail</label>
              <input type="email" name="email" class="form-control border-0 shadow text-center" style="border-radius: 10px;" placeholder="e-Mail" required>
            </div>
            <div class="form-group">
              <label>Kata Sandi</label>
              <input type="password" name="password" class="form-control border-0 shadow text-center" style="border-radius: 10px;" placeholder="Kata Sandi" required>
            </div>
            <button type="submit" name="daftar" class="btn btn-primary shadow btn-block mt-5" style="border-radius: 10px;">Daftar</button>
          </form>
        </div>
        <div class="az-signup-footer">
          <p>Sudah punya akun? <a class="text-primary" style="cursor: pointer;" onclick="window.location.href='signin'">Masuk sekarang.</a></p>
        </div>
      </div>
    </div>
    <?php require_once("../resources/layout/auth-footer.php");?>
  </body>
</html>
