<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="./"><img src="../resources/img/GUI.png" alt="logo" style="width: 50px;height: 40px;"/></a>
    <a class="sidebar-brand brand-logo-mini" href="./"><img src="../resources/img/GUI.png" alt="logo" style="width: 50px;height: 40px;"/></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="../resources/img/user.png" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal"><?= $_SESSION['nameServer']?></h5>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Rute: <?= $_SESSION['route']?></span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="./">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php
      $folder="../".$route;
      $page=10;
      $open=opendir($folder) or die('Folder tidak ditemukan ...!');
      while($file=readdir($open)){
        if($file !='.' && $file !='..'){
          $files[]=$file;
        }
      }
      $jumlah_file=count($files);
      for($x=0;$x<(0+$page);$x++){
        if($x<$jumlah_file){
          $dot=preg_quote(".");
          if(!preg_match("/".$dot."/i", $files[$x])){
    ?>
    <li class="nav-item menu-items">
      <a class="nav-link text-lowercase" data-bs-toggle="collapse" href="#folder<?= ucwords($files[$x])?>" aria-expanded="false" aria-controls="folder<?= ucwords($files[$x])?>">
        <span class="menu-icon">
          <i class="mdi mdi-file-tree"></i>
        </span>
        <span class="menu-title"><?= ucwords($files[$x])?></span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="folder<?= ucwords($files[$x])?>">
        <ul class="nav flex-column sub-menu">
          <?php
            $dir="../".$route."/".$files[$x];
            if(is_dir($dir)){
              if($handle=opendir($dir)){
                while(($sub_file=readdir($handle))!==false){
                  if($sub_file != "." && $sub_file != ".."){
                    if(preg_match("/".$dot."/i", $sub_file)){
          ?>
          <li class="nav-item"><a class="nav-link" href="<?= "../".$route."/".$files[$x]."/".$sub_file?>"><?= $sub_file?></a></li>
          <?php }else{?>
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#sub-folder<?= $sub_file?>" aria-expanded="false" aria-controls="sub-folder<?= $sub_file?>">
              <span class="menu-icon">
                <i class="mdi mdi-file-tree"></i>
              </span>
              <span class="menu-title"><?= $sub_file?></span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="sub-folder<?= $sub_file?>">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
              </ul>
            </div>
          </li>
          <?php }}}closedir($handle);}}?>
        </ul>
      </div>
    </li>
    <?php }else{?>
    <li class="nav-item menu-items">
      <a class="nav-link text-lowercase" href="code?src=<?= $files[$x]?>">
        <span class="menu-icon">
          <i class="mdi mdi-file"></i>
        </span>
        <span class="menu-title"><?= ucwords($files[$x])?></span>
      </a>
    </li>
    <?php }}}?>
  </ul>
</nav>