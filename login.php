<?php
require_once 'database.php';

session_start();
if ($_SESSION['loggedin']) {
    header('Location: https://apps.amirasyraf.dev/mynet-assessment');
    exit();
}

if (isset($_POST['login'])) {
    try {
        $sql = "SELECT hash FROM user WHERE username = :username";

        $username = $_POST['username'];
        $password = $_POST['password'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();

        $hash =  $result[0]['hash'];

        if (count($result) > 0) {
            if (password_verify($password, $hash))
                authorized();
            else
                unauthorized();
        }
        else
            unauthorized();
    }

    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

function authorized() {
    $_SESSION['loggedin'] = true;
    header('Location: https://apps.amirasyraf.dev/mynet-assessment');
    exit();
}

function unauthorized() {
    echo "<div class='incorrect_credential'>
            Incorrect Credentials!
          </div>";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Login - Sistem Pendaftaran Ahli</title>
        <meta name="author" content="Amir Asyraf">
        <meta name="description" content="MYNET - Sistem Pendaftaran Ahli">
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <link rel="stylesheet" href="src/css/spectre.css" type="text/css">
        <link rel="stylesheet" href="src/css/style.css" type="text/css">
    </head>
    <body>
        <div class="site-container">
            <div class="login-container">
                <div class="login-header">
                    <h3>LOGIN</h3>
                </div>
                <div class="login-body">
                    <form class="login-form" method="post">
                        <label>Username</label>
                        <input type="text" name="username">
                        <label>Password</label>
                        <input type="password" name="password">
                        <input class="btn" type="submit" name="login" value="Login">
                    </form>
                </div>
                <div class="login-footer">
                    <p>Amir Asyraf &copy; 2019</p>
                </div>
            </div>
        </div>
    </body>
</html>