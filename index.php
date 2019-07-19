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
        <!-- ADD MODAL -->
        <div class="modal" id="addmodal">
            <a class="modal-overlay" aria-label="Close"></a>
            <div class="modal-container">
                <div class="modal-header">
                    <a onclick="closeAddModal()" class="btn btn-clear float-right" aria-label="Close"></a>
                    <div class="modal-title h5">Add Member</div>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <form class="form" method="post">
                            <label>Full Name</label>
                            <input type="text" name="add-fullname" id="add-fullname" value="">
                            <label>Mykad</label>
                            <input type="text" name="add-mykad" id="add-mykad" value="">
                            <label>Email</label>
                            <input type="email" name="add-email" id="add-email" value="">
                            <label>Date Registered</label>
                            <input type="date" name="add-date_registered" id="add-date_registered" value="">
                            <input class="btn btn-success" type="submit" name="add" value="Tambah">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                  ...
                </div>
            </div>
        </div>
        <!-- UPDATE MODAL -->
        <div class="modal" id="updatemodal">
            <a class="modal-overlay" aria-label="Close"></a>
            <div class="modal-container">
                <div class="modal-header">
                    <a onclick="closeUpdateModal()" class="btn btn-clear float-right" aria-label="Close"></a>
                    <div class="modal-title h5">Update</div>
                </div>
                <div class="modal-body">
                    <div class="content">
                        <form class="form" method="post">
                            <label>Full Name</label>
                            <input type="text" name="update-fullname" id="update-fullname" value="">
                            <label>Mykad</label>
                            <input type="text" name="update-mykad" id="update-mykad" value="">
                            <label>Email</label>
                            <input type="email" name="update-email" id="update-email" value="">
                            <label>Date Registered</label>
                            <input type="date" name="update-date_registered" id="update-date_registered" value="">
                            <input type="hidden" name="update-id" id="update-id" value="">
                            <input class="btn btn-success" type="submit" name="update" value="Update">
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                  Amir Asyraf
                </div>
            </div>
        </div>
        <script type="text/javascript" src="src/js/index.js"></script>
        <script type="text/javascript">
            document.getElementById('add-date_registered').valueAsDate = new Date();
        </script>
    </body>
</html>