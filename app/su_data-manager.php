<?php

require_once 'controller/c_user-manager.php';

$user = 'root';
$pass = '';
$dbh = new PDO('mysql:host=localhost;dbname=db_praksi', $user, $pass);

$sth = $dbh->prepare('SELECT * from alternatif');
$sth->execute();
$tbalter = $sth->fetchAll();

$sth = $dbh->prepare('SELECT * from jenis');
$sth->execute();
$tbjenis = $sth->fetchAll();

$sth = $dbh->prepare('SELECT * from wisata, jenis where wisata.id_jenis=jenis.id_jenis');
$sth->execute();
$tbwisata = $sth->fetchAll();

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
                    <h1 class="h3 mb-2 text-gray-800 mb-3">User Management</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <div class="row">
                                <a href="#" class="btn btn-success btn-circle btn-sm ml-3" data-toggle="modal" data-target="#addAlter">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                <h6 class="m-2 font-weight-bold text-primary">Add New Alternatif</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Alternatif</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($tbalter as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_alternatif']?></td>
                                            <td><a href="controller/c_user-manager.php?edit=<?=$data['id_user']?>" class="btn btn-warning btn-circle">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                <a href="controller/c_user-manager.php?delAlter=<?=$data['id_alternatif'];?>" class="btn btn-danger btn-circle">
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
                                <a href="#" class="btn btn-success btn-circle btn-sm ml-3" data-toggle="modal" data-target="#AddModal">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                <h6 class="m-2 font-weight-bold text-primary">Add New Jenis Wisata</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Wisata</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($tbjenis as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_jenis']?></td>
                                            <td><a href="controller/c_user-manager.php?edit=<?=$data['id_user']?>" class="btn btn-warning btn-circle">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                <a href="controller/c_user-manager.php?delete=<?=$data['id_user']?>" class="btn btn-danger btn-circle">
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
                                <a href="#" class="btn btn-success btn-circle btn-sm ml-3" data-toggle="modal" data-target="#addWisata">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                <h6 class="m-2 font-weight-bold text-primary">Add New Object Wisata</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Object Wisata</th>
                                            <th>Lokasi</th>
                                            <th>Jenis Wisata</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($tbwisata as $data){
                                    ?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$data['nama_wisata']?></td>
                                            <td><?=$data['lokasi']?></td>
                                            <td><?=$data['nama_jenis']?></td>
                                            <td><a href="" data-toggle="modal" data-target="#editWisata" class="btn btn-warning btn-circle">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                <!-- Edit Object Wisata Modal -->
                                                <div class="modal fade" id="editWisata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Object Wisata</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="controller/c_data-manager.php" method="POST">
                                                            <div class="form-group">
                                                                <label for="formGroupExampleInput2">Nama Wisata</label>
                                                                <input value="<?=$data['nama_wisata']?>" name="namaWisata" type="text" class="form-control" id="formGroupExampleInput2" placeholder=". . .">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="formGroupExampleInput2">Lokasi Wisata</label>
                                                                <input value="<?=$data['lokasi']?>" name="lokasi" type="text" class="form-control" id="formGroupExampleInput2" placeholder=". . .">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Jenis Wisata</label>
                                                                <select name="jenis" class="form-control" id="exampleFormControlSelect1">
                                                                <option disabled selected>Default select</option>
                                                                <?php
                                                                
                                                                foreach ($tbjenis as $data){
                                                                    ?>
                                                                    <option value="<?=$data['id_jenis']?>"><?=$data['nama_jenis']?></option>
                                                                    <?php
                                                                }
                                                                
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <input hidden type="text" name="id" value="<?=$data['id_wisata']?>">

                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="editWisata" class="btn btn-primary">Save changes</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <a href="controller/c_user-manager.php?delWisata=<?=$data['id_wisata']?>" class="btn btn-danger btn-circle">
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

    <!-- Add Alter Modal -->
    <div class="modal fade" id="addAlter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Alternatif</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="controller/c_data-manager.php" method="POST">
                <div class="form-group">
                    <label for="formGroupExampleInput2">Nama Alternatif</label>
                    <input name="alter" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addAlter" class="btn btn-primary">Save changes</button>
            </form>
        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
    </div>
    
    <!-- Add Jenis Wisata Modal -->
    <div class="modal fade" id="addJenis" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Jenis Wisata</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="controller/c_data-manager.php" method="POST">
                <div class="form-group">
                    <label for="formGroupExampleInput2">Nama Jenis Wisata</label>
                    <input name="alter" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
    </div>
    
    <!-- Add Object Wisata Modal -->
    <div class="modal fade" id="addWisata" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Object Wisata</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="controller/c_data-manager.php" method="POST">
                <div class="form-group">
                    <label for="formGroupExampleInput2">Nama Wisata</label>
                    <input name="namaWisata" type="text" class="form-control" id="formGroupExampleInput2" placeholder=". . .">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Lokasi Wisata</label>
                    <input name="lokasi" type="text" class="form-control" id="formGroupExampleInput2" placeholder=". . .">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Jenis Wisata</label>
                    <select name="jenis" class="form-control" id="exampleFormControlSelect1">
                    <option disabled selected>Default select</option>
                    <?php
                    
                    foreach ($tbjenis as $data){
                        ?>
                        <option value="<?=$data['id_jenis']?>"><?=$data['nama_jenis']?></option>
                        <?php
                    }
                    
                    ?>
                    </select>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="addWisata" class="btn btn-primary">Save changes</button>
            </form>
        </div>
        <div class="modal-footer">
        </div>
        </div>
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