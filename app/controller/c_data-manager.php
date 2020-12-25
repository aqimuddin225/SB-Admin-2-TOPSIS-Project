<?php

$mysqli = new mysqli('localhost', 'root', '', 'db_praksi') or die(mysqli_error($mysqli));

session_start();

if (isset($_POST['addAlter'])){
    $alter = $_POST['alter'];
    $tfix = date("Y-m-d",time());

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";
    
    $mysqli->query("insert into alternatif (id_alternatif,nama_alternatif) value (4,'$alter')") or die($mysqli->error);
    header('Location: ../su_data-manager.php');
}

if (isset($_GET['delAlter'])){
    $id = $_GET['delAlter'];
        
        $_SESSION['message'] = "Record has been deleted";
        $_SESSION['msg_type'] = "danger";
    
        $mysqli->query("delete from alternatif where id_alternatif='$id'") or die($mysqli->error);
        header('Location: ../su_data-manager.php');
    }
if (isset($_POST['addWisata'])){
    $wisata = $_POST['namaWisata'];
    $lokasi = $_POST['lokasi'];
    $jenis = $_POST['jenis'];
    $tfix = date("Y-m-d",time());

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";
    
    $mysqli->query("insert into wisata (nama_wisata,lokasi,id_jenis) value ('$wisata','$lokasi','$jenis')") or die($mysqli->error);
    header('Location: ../su_data-manager.php');
}

if (isset($_GET['delWisata'])){
    $id = $_GET['delWisata'];
        
        $_SESSION['message'] = "Record has been deleted";
        $_SESSION['msg_type'] = "danger";
    
        $mysqli->query("delete from wisata where wisata.id_wisata='$id'") or die($mysqli->error);
        header('Location: ../su_data-manager.php');
    }
    if (isset($_POST['editWisata'])){
        $id = $_POST['id'];
        $wisata = $_POST['namaWisata'];
        $lokasi = $_POST['lokasi'];
        $jenis = $_POST['jenis'];
        
            $_SESSION['message'] = "Record has been updated";
            $_SESSION['msg_type'] = "warning";
            
            $mysqli->query("update wisata set nama_wisata='$wisata', lokasi='$lokasi', jenis='$jenis' where id_wisata='$id' ") or die($mysqli->error);
            header('Location: admin.php');
        }

?>