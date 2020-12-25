<?php

$mysqli = new mysqli('localhost', 'root', '', 'db_praksi') or die(mysqli_error($mysqli));

session_start();

if (isset($_POST['add'])){
    $wisata = $_POST['wisata'];
    $alter = $_POST['alter'];
    $biaya = $_POST['Biaya'];
    $keindahan = $_POST['Keindahan'];
    $sarpras = $_POST['Sarpras'];

    $tfix = date("Y-m-d",time());

    $_SESSION['message'] = "Record has been saved";
    $_SESSION['msg_type'] = "success";
    
    $mysqli->query("insert into nilai (id_wisata,id_alternatif,id_kriteria,id_skala,id_bobot) value ('$wisata','$alter', 1 ,'$biaya', 2)") or die($mysqli->error);
    $mysqli->query("insert into nilai (id_wisata,id_alternatif,id_kriteria,id_skala,id_bobot) value ('$wisata','$alter', 2 ,'$keindahan', 1)") or die($mysqli->error);
    $mysqli->query("insert into nilai (id_wisata,id_alternatif,id_kriteria,id_skala,id_bobot) value ('$wisata','$alter', 3 ,'$sarpras', 3)") or die($mysqli->error);
    header('Location: ../topsis.php');
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    
        $_SESSION['message'] = "Record has been deleted";
        $_SESSION['msg_type'] = "danger";
    
        $mysqli->query("delete from nilai where nilai.id_nilai = '$id'") or die($mysqli->error);
        $id--;
        $mysqli->query("delete from nilai where nilai.id_nilai = '$id'") or die($mysqli->error);
        $id--;
        $mysqli->query("delete from nilai where nilai.id_nilai = '$id'") or die($mysqli->error);
        header('Location: ../topsis.php');
    }

?>