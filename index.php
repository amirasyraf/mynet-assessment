<?php

session_start();
if (!($_SESSION['loggedin'])) {
    header('Location: https://apps.amirasyraf.dev/mynett/login.php');
    exit();
}

require_once 'database.php';
require_once 'crud.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Sistem Pendaftaran Ahli</title>
        <meta name="author" content="Amir Asyraf">
        <meta name="description" content="MYNET - Sistem Pendaftaran Ahli">
        <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
        <link rel="stylesheet" href="src/css/spectre.css" type="text/css">
        <link rel="stylesheet" href="src/css/style.css" type="text/css">
    </head>
    <body>
        <div class="site-container">
            <div class="card">
                <div class="card-header">
                    <div class="card-title h5">Main Page</div>
                    <div class="card-subtitle text-gray">Bla bla bla bla</div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Nama Penuh</th>
                                <th>MyKad</th>
                                <th>Email</th>
                                <th>Tarik Daftar</th>
                                <th>Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach (retrieveMember() as $row) { ?>
                                <tr>
                                    <td><?php echo $row["fullname"]; ?></td>
                                    <td><?php echo $row["mykad"]; ?></td>
                                    <td><?php echo $row["email"]; ?></td>
                                    <td><?php echo $row["date_registered"]; ?></td>
                                    <td>
                                        <div class="inline-wrapper">
                                            <button class="btn btn-primary" onclick="openUpdateModal(<?php echo $row["id"] ?> )">Update</button>
                                            <form method="post">
                                                <input type="hidden" name="id" value="<?php echo $row["id"] ?>">
                                                <input class="btn btn-error" type="submit" name="delete" value="Delete" style="cursor: pointer;">
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" onclick="openAddModal()">Tambah</button>
                    <button class="btn" onclick="logout()">Logout</button>
                </div>
            </div>
        </div>
    </body>
</html>
