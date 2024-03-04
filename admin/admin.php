<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../input.css">
</head>

<body class="bg-slate-950 text-slate-200 ">
    <?php
    if (!isset($_SESSION['addUsers'])) {
        $_SESSION['addUsers'] = true;
    }
    if (isset($_POST['toggle'])) {
        $_SESSION['addUsers'] = !$_SESSION['addUsers'];
    }
    $addUsers = $_SESSION['addUsers'];
    ?>
    <div class="container mx-auto p-3 my-5 flex flex-col gap-5">
        <h1 class="text-3xl font-extrabold">Welcome,
            <?php echo $_SESSION["username"]; ?>
        </h1>
        <hr>
        <form method="post">
            <button type="submit" name="toggle" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <?php echo $addUsers ? 'New Note' : 'Add Users'; ?>
            </button>
        </form>
        <?php
        if ($addUsers) {
            include("addUsers.php");
        } else {
            include("default.php");
        }
        ?>

    </div>
</body>

</html>