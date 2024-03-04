<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./input.css">
</head>

<body class="">
    <div class="welcome-screen h-screen px-5 md:px-0  flex justify-center  items-center text-white">
        <div class=" text-center md:text-start container mx-auto items-center justify-center px-3 md:gap-0 flex flex-col md:flex-row gap-10">
            <div class="md:w-1/2 ">
                <div class="md:text-7xl text-5xl font-extrabold">
                    Welcome to <span class="text-indigo-500">
                        CONVOS
                    </span>
                </div>
                <div class="md:text-3xl text-xl">From teachers at VPMP to you!</div>
                <div class="md:text-3xl text-xl">All new announcements at your fingertips!</div>
            </div>

            <div class="md:w-1/2 flex items-center justify-center">
                <div class="rounded-3xl p-5 flex items-center justify-center flex-col  backdrop-filter backdrop-blur-sm shadow-2xl drop-shadow-2xl shadow-slate-900  border-opacity-45">
                    <h1 class="text-3xl">Login</h1>
                    <form method="POST" class=" flex flex-col gap-3">

                        <label for="username">
                            Username
                        </label>
                        <input type="text" spellcheck="false" name="username" id="username" class="input  text-black p-3 rounded-lg   ring-0 active:ring-0 border-0 focus:ring-0 focus:border-0 border-none " />
                        <label for="password">
                            Password
                        </label>
                        <input type="password" name="password" id="password" class="input  text-black p-3 rounded-lg   ring-0 active:ring-0 border-0 focus:ring-0 focus:border-0 border-none " />
                        <input type="submit" name="submit" class="bg-indigo-500 text-white p-3 rounded-lg"></input>


                    </form>
                </div>
            </div>

        </div>
    </div>

    <?php

    session_start();

    function authenticate($inputUsername, $inputPassword)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM userdata where username = '" . $inputUsername . "' and password = '" . $inputPassword . "';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $role = $row["role"];
                $_SESSION['userType'] = $role;
                $_SESSION['username'] = $inputUsername;
                return true;
            }
        }
        $conn->close();
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        return false;
    }
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (authenticate($username, $password)) {
            $_SESSION['loggedin'] = true;
            header('Location: /project/home.php');
            exit;
        } else {
            exit;
        }
    }
    ?>

</body>

</html>