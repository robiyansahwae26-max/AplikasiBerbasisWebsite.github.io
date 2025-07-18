<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
        session_start();
        unset($_SESSION['user']);
        unset($_SESSION['pass']);

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Logout',
                text: 'Terima kasih telah menggunakan aplikasi ini.',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'login.php';
                }
            });
        </script>";
    ?>
</body>

</html>