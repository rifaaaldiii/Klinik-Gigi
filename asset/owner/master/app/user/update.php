<?php
include '../../../../../env/env.php'; // Pastikan path ke file konfigurasi database benar
session_start();

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    if ((empty($_POST['email'])) || (empty($_POST['username'])) ||
        (empty($_POST['pass'])) || (empty($_POST['pass2'])) || (empty($_POST['role']))
    ) {
        header("window.history.back()");
    } else {
        if (req($_POST) > 0) {
            echo "<script>
        alert('User berhasil diperbarui!');
        document.location.href = '../../../master/index.php?page=User';
        </script>";
        } else {
            echo mysqli_error($conn);
        }
    }
}

function req($data)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $data["email"]);
    $user = mysqli_real_escape_string($conn, $data["username"]);
    $pass = $data["pass"];
    $pass2 = $data["pass2"];
    $role = $data["role"];
    $id = $data["id"];
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
        alert('Format email tidak valid!');
        window.history.back();
        </script>";
        return false;
    }

    // Validasi panjang username
    if (strlen($user) < 4) {
        echo "<script>
        alert('Username minimal 4 karakter!');
        window.history.back();
        </script>";
        return false;
    }

    // Validasi password
    if (strlen($pass) < 8) {
        echo "<script>
        alert('Password minimal 8 karakter!');
        window.history.back();
        </script>";
        return false;
    }

    if ($pass !== $pass2) {
        echo "<script>
        alert('Password tidak sesuai!!!');
        window.history.back();
        </script>";
        return false;
    }

    $pass = password_hash($pass, PASSWORD_DEFAULT);

    // Prepared statement untuk update
    $stmt = $conn->prepare("UPDATE user SET username = ?, email = ?, password = ?, role = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $user, $email, $pass, $role, $id);
    $stmt->execute();

    return $stmt->affected_rows;
}