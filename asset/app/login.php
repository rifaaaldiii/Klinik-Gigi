<?php
include "../../env/env.php";
session_start();

// loginnnnn
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Menggunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            header("location:../../load.php");
        } else {
            echo "<script>
            alert('Password Salah!!!');
            window.history.back();
            </script>";
        }
    } else {
        echo "<script>
        alert('Email Salah!!!');
        window.history.back();
        </script>";
    }
}
