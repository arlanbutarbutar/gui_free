<?php require_once("controller/script.php");
  if(!isset($_SESSION['id-admin'])){header("Location: route.php");exit;}
  $_SESSION['page-name']="Console"; $_SESSION['page-to']="home";
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <?php require_once("resources/layout/header.php");?>
  </head>
  <body class="bg-dark" style="font-family: 'Quicksand', sans-serif;">
    <?php if(isset($_SESSION['message-success'])){?>
    <div class="message-success" data-message-success="<?= $_SESSION['message-success']?>"></div>
    <?php } if(isset($_SESSION['message-info'])){?>
    <div class="message-info" data-message-info="<?= $_SESSION['message-info']?>"></div>
    <?php } if(isset($_SESSION['message-warning'])){?>
    <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning']?>"></div>
    <?php } if(isset($_SESSION['message-danger'])){?>
    <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger']?>"></div>
    <?php }?>

    <div class="az-header shadow">
      <div class="container">
        <div class="az-header-left">
          <a href="home"><img src="resources/img/GUI.png" alt="Icon Brand" style="width: 60px"></a>
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div>
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="home"><img src="resources/img/GUI.png" alt="Icon Brand" style="width: 60px"></a>
            <a href="" class="close">&times;</a>
          </div>
        </div>
        <div class="az-header-right">
          <div class="dropdown az-profile-menu">
            <a href="home" class="az-img-user"><img src="resources/img/user.png" alt="Icon Profile"> </a>
            <div class="dropdown-menu shadow border-0" style="border-radius: 15px;">
              <div class="az-header-profile">
                <div class="az-img-user">
                  <img src="resources/img/user.png" alt="Icon Profile">
                </div>
                <h6><?= $nameServer?></h6>
                <span><?= $mailServer?></span>
              </div>
              <a href="auth/signout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Keluar</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="az-content az-content-dashboard bg-white">
      <div class="container">
        <div class="az-content-body">

          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Hi, welcome back <?= $nameServer?>!</h2>
              <p class="az-dashboard-text">Konsol analisis projek pengembangan website Anda.</p>
            </div>
            <div class="az-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>Start Date</label>
                  <h6><?php $dateRegis=$_SESSION['dateServer']; $dateRegis=date_create($dateRegis); echo date_format($dateRegis, "M d, Y")?></h6>
                </div>
              </div>
              <div class="media">
                <div class="media-body">
                  <label>End Date</label>
                  <h6><?= date("M d, Y")?></h6>
                </div>
              </div>
              <div class="media">
                <div class="media-body">
                  <label>Event Category</label>
                  <h6>All Categories</h6>
                </div>
              </div>
              <button type="button" class="btn btn-primary shadow" style="border-radius: 10px;" data-toggle="modal" data-target="#add-project"><i class="fas fa-plus"></i> Add Project</button>
              <div class="modal fade" id="add-project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content border-0 shadow">
                    <div class="modal-header border-bottom-0">
                      <h5 class="modal-title" id="exampleModalLabel"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="POST">
                      <div class="modal-body text-center">
                        <div class="form-group">
                          <label for="name">Nama projek</label>
                          <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" class="form-control text-center border-0 shadow mb-2" placeholder="Nama projek" style="border-radius: 10px;" required>
                          <span><span class="badge badge-info">Perhatian!!</span> Nama database akan menyesuaikan dengan Nama Project yang kamu masukan!</span>
                        </div>
                        <div class="form-group">
                          <label for="route">Rute Directory</label>
                          <input type="text" name="route" id="route" value="<?php if(isset($_POST['route'])){echo $_POST['route'];}else{echo "apps/";}?>" class="form-control text-center border-0 shadow mb-2" placeholder="Rute" style="border-radius: 10px;" required>
                          <span>Rute yang tersedia seperti berikut => <small class="text-success">'apps/directory-project/'</small></span>
                        </div>
                        <div class="form-group">
                          <label for="progress">Progress</label>
                          <select name="progress" id="progress" style="border-radius: 10px;" class="form-control text-center border-0 shadow">
                            <option value="0">Baru</option>
                            <option value="15">Perancangan DB</option>
                            <option value="50">Perancangan App</option>
                            <option value="75">Pengujian App</option>
                            <option value="98">Revisi App</option>
                            <option value="100">Selesai</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer border-top-0 justify-content-center">
                        <button type="button" class="btn btn-white btn-sm shadow" style="border-radius: 10px;" data-dismiss="modal">Batal</button>
                        <button type="submit" name="add-project" class="btn btn-primary btn-sm shadow" style="border-radius: 10px;">Develop</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="az-dashboard-nav"> 
            <nav class="nav" style="max-width: 750px;">
              <?php if(mysqli_num_rows($menuNavbar)>0){while($row=mysqli_fetch_assoc($menuNavbar)){?>
                <a class="btn btn-outline-primary border-0" style="border-top-left-radius: 10px;border-top-right-radius: 20px;border-bottom-left-radius: 20px;" href="<?= $row['url']?>" target="_blank"><?= $row['menu_navbar']?></a>
                <span class="text-danger ml-n2 mr-2" style="font-size: 12px;cursor: pointer;" data-toggle="modal" data-target="#hapus-menu<?= $row['id_menu_navbar']?>"><i class="fas fa-trash"></i></span>
                <div class="modal fade" id="hapus-menu<?= $row['id_menu_navbar']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content border-0 shadow">
                      <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="" method="POST">
                        <div class="modal-body text-center">
                          Yakin ingin hapus <?= $row['menu_navbar']?>?
                        </div>
                        <div class="modal-footer border-top-0 justify-content-center">
                          <input type="hidden" name="id-menu" value="<?= $row['id_menu_navbar']?>">
                          <button type="button" class="btn btn-white btn-sm shadow" style="border-radius: 10px;" data-dismiss="modal">Batal</button>
                          <button type="submit" name="hapus-menu" class="btn btn-danger btn-sm shadow" style="border-radius: 10px;">Hapus</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php }}?>
              <a class="nav-link" href="" data-toggle="modal" data-target="#add-menu"><i class="fas fa-plus"></i></a>
              <div class="modal fade" id="add-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content border-0 shadow">
                    <div class="modal-header border-bottom-0">
                      <h5 class="modal-title" id="exampleModalLabel"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="POST">
                      <div class="modal-body text-center">
                        <div class="form-group">
                          <label for="name">Nama Menu</label>
                          <input type="text" name="name" id="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" class="form-control text-center border-0 shadow" placeholder="Nama Menu" style="border-radius: 10px;" required>
                        </div>
                        <div class="form-group">
                          <label for="url">URL</label>
                          <input type="text" name="url" id="url" value="<?php if(isset($_POST['url'])){echo $_POST['url'];}?>" class="form-control text-center border-0 shadow" placeholder="URL" style="border-radius: 10px;" required>
                        </div>
                      </div>
                      <div class="modal-footer border-top-0 justify-content-center">
                        <button type="button" class="btn btn-white btn-sm shadow" style="border-radius: 10px;" data-dismiss="modal">Batal</button>
                        <button type="submit" name="add-menu-navbar" class="btn btn-primary btn-sm shadow" style="border-radius: 10px;">Add Menu</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </nav>

            <nav class="nav">
              <a class="nav-link text-primary" href="#" onclick="window.print()"><i class="far fa-file-pdf"></i> Export to PDF</a>
              <a class="nav-link text-primary" href="mailto:support@gui.my.id?subject=Butuh%20Dukungan%20Bantuan%20Developer%20GUI%20-%20Netmedia%20Framecode" target="_blank"><i class="far fa-envelope"></i>Send to Email</a>
              <a class="nav-link text-primary" href="#"><i class="fas fa-ellipsis-h"></i></a>
            </nav>
          </div>
          
          <div class="row row-sm mg-b-20">

            <div class="col-lg-4">
              <div class="card card-dashboard-pageviews border-0 shadow" style="border-radius: 15px;">
                <div class="card-header">
                  <h6 class="card-title">Progress Projects</h6>
                  <p class="card-text">Laporan Progres Projek yang sedang dikerjakan.</p>
                </div>
                <div class="card-body">
                  <?php if(mysqli_num_rows($projectView)==0){?>
                  <div class="az-list-item">
                    <div>
                      <h6>belum ada data!</h6>
                    </div>
                  </div>
                  <?php }else if(mysqli_num_rows($projectView)>0){while($rowPV=mysqli_fetch_assoc($projectView)){?>
                  <div class="az-list-item">
                    <div>
                      <h6><?= $rowPV['name']?></h6>
                      <span><?= $rowPV['route']?></span>
                    </div>
                    <div>
                      <span class="text-warning"><?= $rowPV['progress']?>% (100%)</span>
                    </div>
                  </div>
                  <?php }}?>
                </div>
              </div>
              
              <div class="card card-dashboard-pageviews border-0 shadow mt-3" style="border-radius: 15px;">
                <div class="card-header">
                  <h6 class="card-title">All Databases</h6>
                  <p class="card-text">Menampilkan semua database yang dibuat.</p>
                </div>
                <div class="card-body">
                  <?php if(mysqli_num_rows($databases)==0){?>
                    <p>Belum ada data.</p>
                  <?php }else if(mysqli_num_rows($databases)>0){
                    $count=mysqli_num_rows($databases);?>
                    <p>Records: <?= $count;?></p>
                  <?php while($row=mysqli_fetch_assoc($databases)){?>
                    <a href="/phpmyadmin/index.php?route=/database/structure&server=1&db=<?= $row['name']?>" target='_blank'><i class='fas fa-database mr-2 text-success'></i></a> <?= $row['name']?><br>
                  <?php }}?>
                </div>
              </div>

            </div>

            <div class="col-lg-7 col-xl-8 mg-t-20 mg-lg-t-0">
              <div class="row mb-3">
                <div class="col-lg-4">
                  <a href="http://127.0.0.1:8000" class="text-decoration-none" target="_blank">
                    <div class="card card-body border-0 shadow text-dark text-center" style="border-radius: 15px;">
                      <img src="resources/img/laravel.png" alt="Logo Framework" style="width: 85px" class="m-auto">
                      <h3>Laravel</h3>
                    </div>
                  </a>
                </div>
                <div class="col-lg-4">
                  <a href="http://127.0.0.1:8080" class="text-decoration-none" target="_blank">
                    <div class="card card-body border-0 shadow text-dark text-center" style="border-radius: 15px;">
                      <img src="resources/img/codeigniter.png" alt="Logo Framework" style="width: 75px" class="m-auto">
                      <h3>CodeIgniter</h3>
                    </div>
                  </a>
                </div>
              </div>
              <div class="card card-table-one border-0 shadow" style="border-radius: 15px;">
                <h6 class="card-title">All Project</h6>
                <p class="az-content-text mg-b-20">Semua projek yang kamu kerjakan ada disini, kelola dan kembangkan kreatifitas dan inovasi terbaru kamu :)</p>
                <div class="table-responsive">
                  <table class="table table-sm text-center">
                    <thead>
                      <tr>
                        <th class="font-weight-bold text-center">Nama Projek</th>
                        <th class="font-weight-bold text-center">Rute</th>
                        <th class="font-weight-bold text-center">Domain</th>
                        <th class="font-weight-bold text-center">Progres</th>
                        <th class="font-weight-bold text-center">Tgl Buat</th>
                        <th class="font-weight-bold text-center" colspan="2">Aksi</th>
                        <th class="font-weight-bold text-center">Akses</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(mysqli_num_rows($project)==0){?>
                      <tr class="bg-transparent">
                        <th class="font-weight-bold" colspan="9">belum ada data!</th>
                      </tr>
                      <?php }else if(mysqli_num_rows($project)>0){while($row=mysqli_fetch_assoc($project)){?>
                      <tr class="bg-transparent">
                        <td><strong><?= $row['name']?></strong></td>
                        <td class="text-center"><?= $row['route']?></td>
                        <td class="text-center"><a href="https://<?= $row['domain']?>" target="_blank"><?= $row['domain']?></a></td>
                        <td class="text-center"><?= $row['progress']?>%</td>
                        <td><?= $row['date']?></td>
                        <td>
                          <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#edit-project<?= $row['id_project']?>"> <i class="fas fa-pen text-warning"></i> </button>
                          <div class="modal fade" id="edit-project<?= $row['id_project']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content bg-white border-0 shadow">
                                <div class="modal-header border-bottom-0">
                                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="" method="POST">
                                  <div class="modal-body text-center">
                                    <div class="form-group">
                                      <label for="name">Nama projek</label>
                                      <input type="text" name="name" value="<?= $row['name']?>" class="form-control text-center border-0 shadow" placeholder="Nama projek" style="border-radius: 10px;" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="route">Rute</label>
                                      <input type="text" name="route" value="<?= $row['route']?>" class="form-control text-center border-0 shadow mb-2" placeholder="Rute" style="border-radius: 10px;" required>
                                      <span>Rute yang tersedia seperti berikut => <small class="text-success">'apps/dir_projek/'</small></span>
                                    </div>
                                    <div class="form-group">
                                      <label for="progress">Progress</label>
                                      <select name="progress" id="progress" class="form-control text-center border-0 shadow">
                                        <option value="">Pilih Progress</option>
                                        <option value="0">Baru</option>
                                        <option value="15">Perancangan DB</option>
                                        <option value="50">Perancangan App</option>
                                        <option value="75">Pengujian App</option>
                                        <option value="98">Revisi App</option>
                                        <option value="100">Selesai</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="domain">Domain</label>
                                      <input type="text" name="domain" value="<?= $row['domain']?>" class="form-control text-center border-0 shadow" placeholder="Domain">
                                    </div>
                                  </div>
                                  <div class="modal-footer border-top-0 justify-content-center">
                                    <input type="hidden" name="id-project" value="<?= $row['id_project']?>">
                                    <input type="hidden" name="nameOld" value="<?= $row['name']?>">
                                    <input type="hidden" name="routeOld" value="<?= $row['route']?>">
                                    <input type="hidden" name="domainOld" value="<?= $row['domain']?>">
                                    <input type="hidden" name="progressOld" value="<?= $row['progress']?>">
                                    <button type="button" class="btn btn-white btn-sm shadow" style="border-radius: 10px;" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="edit-project" class="btn btn-warning btn-sm shadow" style="border-radius: 10px;"><i class="fas fa-pen text-dark"></i> Ubah</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#delete-project<?= $row['id_project']?>" style="border-radius: 10px;"> <i class="fas fa-trash text-danger"></i> </button>
                          <div class="modal fade" id="delete-project<?= $row['id_project']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content bg-white border-0 shadow">
                                <div class="modal-header border-bottom-0">
                                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="" method="POST">
                                  <div class="modal-body text-center">
                                    Yakin ingin menghapus data projek <?= $row['name']?>? <br><br> <small><span class="badge badge-warning">Peringatan!!</span> jika kamu ingin menghapus project maka kamu juga <br> harus menghapus File Directory secara manual.</small>
                                  </div>
                                  <div class="modal-footer border-top-0 justify-content-center">
                                    <input type="hidden" name="id-project" value="<?= $row['id_project']?>">
                                    <input type="hidden" name="route" value="<?= $row['route']?>">
                                    <input type="hidden" name="name" value="<?= $row['name']?>">
                                    <button type="button" class="btn btn-white btn-sm shadow" style="border-radius: 10px;" data-dismiss="modal">Batal</button>
                                    <button type="submit" name="delete-project" class="btn btn-danger btn-sm shadow" style="border-radius: 10px;"><i class="fas fa-trash"></i> Hapus</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <a href="<?= $row['route']?>" class="btn btn-success btn-sm shadow ml-2" target="_blank" style="border-radius: 10px;"><i class="fas fa-eye"></i> View</a>
                        </td>
                      </tr>
                      <?php }}?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="az-footer ht-40 border-0 shadow shadow-lg">
      <div class="container ht-100p pd-t-0-f">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Netmedia Framecode <?= date('Y');?></span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Visit <a href="https://www.netmedia-framecode.com" target="_blank">Web Development</a></span>
      </div>
    </div>
    <script type="module" src="assets/js/ionicons.esm.js"></script>
    <script nomodule src="assets/js/ionicons.js"></script>
    <script src="resources/lib/jquery/jquery.min.js"></script>
    <script src="resources/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="resources/lib/ionicons/ionicons.js"></script>
    <script src="resources/lib/jquery.flot/jquery.flot.js"></script>
    <script src="resources/lib/jquery.flot/jquery.flot.resize.js"></script>
    <script src="resources/lib/chart.js/Chart.bundle.min.js"></script>
    <script src="resources/lib/peity/jquery.peity.min.js"></script>
    <script src="resources/js/azia.js"></script>
    <script src="resources/js/chart.flot.sampledata.js"></script>
    <script src="resources/js/dashboard.sampledata.js"></script>
    <script src="resources/js/jquery.cookie.js" type="text/javascript"></script>
    <script>
        const messageSuccess = $('.message-success').data('message-success');
        const messageInfo = $('.message-info').data('message-info');
        const messageWarning = $('.message-warning').data('message-warning');
        const messageDanger = $('.message-danger').data('message-danger');

        if(messageSuccess){
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Terkirim',
                text: messageSuccess,
            })
        }

        if(messageInfo){
            Swal.fire({
                icon: 'info',
                title: 'For your information',
                text: messageInfo,
            })
        }
        if(messageWarning){
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!!',
                text: messageWarning,
            })
        }
        if(messageDanger){
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: messageDanger,
            })
        }
    </script>
    <script>
      $(function(){
        'use strict'

    		var plot = $.plot('#flotChart', [{
          data: flotSampleData3,
          color: '#007bff',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
          }
        },{
          data: flotSampleData4,
          color: '#560bd0',
          lines: {
            fillColor: { colors: [{ opacity: 0 }, { opacity: 0.2 }]}
          }
        }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 8
          },
    			yaxis: {
            show: true,
    				min: 0,
    				max: 100,
            ticks: [[0,''],[20,'20K'],[40,'40K'],[60,'60K'],[80,'80K']],
            tickColor: '#eee'
    			},
    			xaxis: {
            show: true,
            color: '#fff',
            ticks: [[25,'OCT 21'],[75,'OCT 22'],[100,'OCT 23'],[125,'OCT 24']],
          }
        });

        $.plot('#flotChart1', [{
          data: dashData2,
          color: '#00cccc'
        }], {
    			series: {
    				shadowSize: 0,
            lines: {
              show: true,
              lineWidth: 2,
              fill: true,
              fillColor: { colors: [ { opacity: 0.2 }, { opacity: 0.2 } ] }
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 35
          },
    			xaxis: {
            show: false,
            max: 50
          }
    		});

        $.plot('#flotChart2', [{
          data: dashData2,
          color: '#007bff'
        }], {
    			series: {
    				shadowSize: 0,
            bars: {
              show: true,
              lineWidth: 0,
              fill: 1,
              barWidth: .5
            }
    			},
          grid: {
            borderWidth: 0,
            labelMargin: 0
          },
    			yaxis: {
            show: false,
            min: 0,
            max: 35
          },
    			xaxis: {
            show: false,
            max: 20
          }
    		});


        //-------------------------------------------------------------//


        // Line chart
        $('.peity-line').peity('line');

        // Bar charts
        $('.peity-bar').peity('bar');

        // Bar charts
        $('.peity-donut').peity('donut');

        var ctx5 = document.getElementById('chartBar5').getContext('2d');
        new Chart(ctx5, {
          type: 'bar',
          data: {
            labels: [0,1,2,3,4,5,6,7],
            datasets: [{
              data: [2, 4, 10, 20, 45, 40, 35, 18],
              backgroundColor: '#560bd0'
            }, {
              data: [3, 6, 15, 35, 50, 45, 35, 25],
              backgroundColor: '#cad0e8'
            }]
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {
              enabled: false
            },
            legend: {
              display: false,
                labels: {
                  display: false
                }
            },
            scales: {
              yAxes: [{
                display: false,
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  max: 80
                }
              }],
              xAxes: [{
                barPercentage: 0.6,
                gridLines: {
                  color: 'rgba(0,0,0,0.08)'
                },
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  display: false
                }
              }]
            }
          }
        });

        // Donut Chart
        var datapie = {
          labels: ['Search', 'Email', 'Referral', 'Social', 'Other'],
          datasets: [{
            data: [25,20,30,15,10],
            backgroundColor: ['#6f42c1', '#007bff','#17a2b8','#00cccc','#adb2bd']
          }]
        };

        var optionpie = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
          },
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        // For a doughnut chart
        var ctxpie= document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
          type: 'doughnut',
          data: datapie,
          options: optionpie
        });

      });
    </script>
  </body>
</html>
