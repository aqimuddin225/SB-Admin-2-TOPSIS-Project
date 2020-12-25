<?php

require_once 'controller/c_topsis.php';

$user = 'root';
$pass = '';
$dbh = new PDO('mysql:host=localhost;dbname=db_praksi', $user, $pass);

$sth = $dbh->prepare('SELECT nilai.id_nilai, wisata.nama_wisata, jenis.nama_jenis FROM nilai, wisata, jenis WHERE wisata.id_wisata=nilai.id_wisata AND jenis.id_jenis=wisata.id_jenis AND nilai.id_nilai % 3 = 0 GROUP BY wisata.nama_wisata, nilai.id_nilai, nilai.id_alternatif');
$sth->execute();
$tbweight = $sth->fetchAll();

$sth = $dbh->prepare('SELECT wisata.id_wisata, wisata.nama_wisata, jenis.nama_jenis FROM wisata,jenis WHERE jenis.id_jenis=wisata.id_jenis');
$sth->execute();
$tbwisata= $sth->fetchAll();

$sth = $dbh->prepare('SELECT kriteria.nama_kriteria, skala.nama_skala FROM kriteria,bobot,skala WHERE kriteria.id_kriteria=bobot.id_kriteria AND skala.id_skala=bobot.id_skala');
$sth->execute();
$tbkriteria= $sth->fetchAll();

$sth = $dbh->prepare('SELECT * FROM skala');
$sth->execute();
$tbkskala= $sth->fetchAll();

$sth = $dbh->prepare('SELECT * FROM alternatif');
$sth->execute();
$tbkalter= $sth->fetchAll();

$sth = $dbh->prepare('SELECT * FROM 1pembagi, kriteria where 1pembagi.idkriteria=kriteria.id_kriteria');
$sth->execute();
$tbpembagi= $sth->fetchAll();

$sth = $dbh->prepare('SELECT * FROM 3terbobot, kriteria, alternatif, skala where 3terbobot.idskala=skala.id_skala AND 3terbobot.idkriteria=kriteria.id_kriteria AND 3terbobot.idalternatif=alternatif.id_alternatif');
$sth->execute();
$tbnorm= $sth->fetchAll();

$sth = $dbh->prepare('SELECT * FROM 4amax_amin, kriteria where 4amax_amin.idkriteria=kriteria.id_kriteria');
$sth->execute();
$tbpm= $sth->fetchAll();

$sth = $dbh->prepare('SELECT * FROM 5nilaid, 6value, alternatif where 5nilaid.idalternatif=6value.idalternatif and 6value.idalternatif=alternatif.id_alternatif');
$sth->execute();
$tbend= $sth->fetchAll();

$count = '';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AdminPage - Weight</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            
            <li class="nav-item">
                <a class="nav-link" href="weight.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Weight</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="topsis.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>TOPSIS</span></a>
            </li>
            
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
                        <li class="nav-item">
                            <a class="nav-link" href="topsis.php">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>User Management</span></a>
                        </li>
            
                        <li class="nav-item">
                            <a class="nav-link" href="topsis.php">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Data Management</span></a>
                        </li>

                        <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Penilaian</h1>
                    <p class="mb-4">Data bobot pada masing-masing kriteria yang digunakan pada perhitungan <a target="_blank"
                            href="https://datatables.net">TOPSIS</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <a href="#" class="btn btn-success btn-circle btn-sm ml-3" data-toggle="modal" data-target="#AddModal">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                <h6 class="m-2 font-weight-bold text-primary">Add New</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Wisata</th>
                                            <th>Jenis Wisata</th>
                                            <th>Matrix</th>
                                            <th>Method</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($tbweight as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_wisata']?></td>
                                            <td><?=$data['nama_jenis']?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                    penilaian
                                                </button>
                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="">
                                                    <?php
        
                                                    $count = $data['id_nilai'];
                                                    foreach ($tbkriteria as $row){
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">Penilaian <?=$row['nama_kriteria']?></label>
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                            <option value="<?=$data['id_skala']?>" selected><?=$count?></option>
                                                            </select>
                                                        </div>
                                                        <?php
                                                    $count--;
                                                    }

                                                    ?>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <td>TOPSIS</td>
                                            <td>
                                                <a href="controller/c_topsis.php?delete=<?= $data['id_nilai'];?>" class="btn btn-danger btn-circle">
                                                    <i class="fas fa-trash"></i>
                                                </a></td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <h6 class="m-2 font-weight-bold text-primary">Pembagi</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kriteria</th>
                                            <th>Pembagi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1; 
                                        foreach ($tbpembagi as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_kriteria']?></td>
                                            <td><?=$data['bagi']?></td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kriteria</th>
                                            <th>Alternatif</th>
                                            <th>Penilaian</th>
                                            <th>Normalisasi</th>
                                            <th>Terbobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1; 
                                        foreach ($tbnorm as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_kriteria']?></td>
                                            <td><?=$data['nama_alternatif']?></td>
                                            <td><?=$data['nama_skala']?></td>
                                            <td><?=$data['normalisasi']?></td>
                                            <td><?=$data['terbobot']?></td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kriteria</th>
                                            <th>A+</th>
                                            <th>A-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1; 
                                        foreach ($tbpm as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_kriteria']?></td>
                                            <td><?=$data['maximum']?></td>
                                            <td><?=$data['minimum']?></td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Alternatif</th>
                                            <th>D+</th>
                                            <th>D-</th>
                                            <th>value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1; 
                                        foreach ($tbend as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_alternatif']?></td>
                                            <td><?=$data['dplus']?></td>
                                            <td><?=$data['dmin']?></td>
                                            <td><?=$data['val']?></td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Project Prak SI 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- AddNew Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddNewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="AddNewModalLabel">Add New Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="controller/c_topsis.php" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nama Lengkap</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=". . .">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Nama Wisata</label>
            <select name="wisata" class="form-control" id="exampleFormControlSelect1">
            <option disabled selected>Choose . . .</option>
            <?php
            
            foreach ($tbwisata as $data){
                ?>
                <option value="<?=$data['id_wisata']?>"><?=$data['nama_wisata']?></option>
                <?php
            }                              

            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Kepuasan Anda</label>
            <select name="alter" class="form-control" id="exampleFormControlSelect1">
            <option disabled selected>Choose . . .</option>
            <?php
            
            foreach ($tbkalter as $data){
                ?>
                <option value="<?=$data['id_alternatif']?>"><?=$data['nama_alternatif']?></option>
                <?php
            }                              

            ?>
            </select>
        </div>
        <?php
        
        foreach ($tbkriteria as $data){
            ?>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Penilaian <?=$data['nama_kriteria']?></label>
                <select class="form-control" name="<?=$data['nama_kriteria']?>" id="exampleFormControlSelect1">
                <option disabled selected>Choose . . .</option>
                <?php
                
                foreach ($tbkskala as $data){
                    ?>
                    <option value="<?=$data['id_skala']?>"><?=$data['nama_skala']?></option>
                    <?php
                }                              

                ?>
                </select>
            </div>
            <?php
        }

        ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="add">Save changes</button>
        </div>
        </div>
        </form>
    </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>