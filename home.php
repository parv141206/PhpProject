<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php
    session_start();
    // echo "USER" . $_SESSION["userType"];
    if (isset($_SESSION["loggedin"])) {
        if ($_SESSION["userType"] == "admin") {
            include "admin/admin.php";
        } else if ($_SESSION["userType"] == "user") {
            include "user/user.php";
        } else if ($_SESSION["userType"] == "" || $_SESSION["userType"] == null || !isset($_SESSION["userType"])) {
            include "user/user.php";
        } else {
            include "not_logged_in.php";
        }
    } else {
        echo "no session";
    }
    ?>
</body>

</html>