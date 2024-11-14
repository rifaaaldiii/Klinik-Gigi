<?php
include '../../../../env/env.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query_delete = mysqli_query($conn, "DELETE FROM asistens WHERE id = '$id'");

    if ($query_delete) {
        echo "<script>alert('Data berhasil dihapus'); window.history.back();</script>";
    }
}
