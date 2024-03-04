<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-slate-200 ">
    <?php
    if ($_SESSION["username"] == "" || !isset($_SESSION["username"])) {
        header("Location:/project/welcome.php");
    }
    ?>
    <div class="container mx-auto p-3 my-5 flex flex-col gap-5">
        <hr>
        <h1 class="text-3xl font-extrabold">Add a new member!</h1>
        <form method="POST" class="flex flex-col gap-3 ">
            <div class="flex flex-col md:flex-row gap-3">

                <div class="flex flex-col gap-3">
                    <input type="hidden" name="form_submitted" value="<?php echo time(); ?>">
                    <input type="text" name="username" id="title" placeholder="Username"
                        class="input p-3 rounded-xl bg-slate-800 text-slate-200">
                    <input type="text" name="password" id="note_from" placeholder="Password"
                        class=" p-3 rounded-xl input bg-slate-800 text-slate-200">
                    <input type="text" name="role" id="note_from" placeholder="Role(admin/user)"
                        class=" p-3 rounded-xl input bg-slate-800 text-slate-200">
                </div>
            </div>
            <div>
                <input type="submit" value="Post" name="submit"
                    class="btn px-5 hover:bg-violet-500 p-3 w-auto hover:cursor-pointer rounded-xl bg-violet-700 text-slate-200">
            </div>
        </form>
        <h1 class="text-3xl font-extrabold">Add a new member,</h1>

        <?php
        if (isset($_POST["submit"]) && isset($_POST["form_submitted"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $role = $_POST["role"];
            if ($username != "" && $password != "") {
                if ($role == "") {
                    $sql = "INSERT INTO userdata (username, password, role) VALUES ('$username', '$password' , 'user');";
                } else {
                    $sql = "INSERT INTO userdata (username, password, role) VALUES ('$username', '$password' , '$role');";
                }
                $conn = new mysqli("localhost", "root", "", "project");
                if ($conn->query($sql)) {
                    // Redirect to the same page or another page after successful insertion
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                }
            }
        }
        if (isset($_POST["delete"]) && isset($_POST["form_delete"])) {
            $d_username = $_POST["d_username"];
            $sql = "DELETE FROM userdata WHERE username = '$d_username';";
            $conn = new mysqli("localhost", "root", "", "project");
            $conn->query($sql);
        }
        ?>
        <div>
            <div class="flex flex-wrap flex-col md:flex-row gap-5">
                <?php
                $sql = "SELECT * FROM userdata ORDER BY username DESC;";
                $conn = new mysqli("localhost", "root", "", "project");
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='bg-slate-900 p-5 flex flex-col gap-3 rounded-3xl shadow-3xl'>";
                        echo "<div class=' text-sm text-violet-200'>" . $row["username"] . "</div>";
                        echo "<h1 class='text-2xl font-bold'>" . $row["password"] . "</h1>";
                        echo "<p class='text-lg'>" . $row["role"] . "</p>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='form_delete' value='" . time() . "'>";
                        echo "<input type='hidden' name='d_username' value='" . $row["username"] . "'>";
                        echo "<input type='submit' value='Delete' name='delete' class='btn px-5 hover:bg-red-500 p-3 w-auto hover:cursor-pointer rounded-xl bg-red-700 text-slate-200'>";
                        echo "</form>";
                        echo "</div>";
                        $i++;
                    }
                } else {
                    echo "0 results";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>