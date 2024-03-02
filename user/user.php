<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../input.css">
</head>

<body class="bg-slate-950 text-slate-200 ">
    <div class="container mx-auto p-3 my-5 flex flex-col gap-5">
        <h1 class="text-3xl font-extrabold">Welcome, <?php echo $_SESSION["username"]; ?></h1>
        <hr>
        <h1 class="text-3xl font-extrabold">Have a look at the latest updates from VPMP!</h1>
        <div>
            <div class="flex flex-wrap flex-col md:flex-row gap-5">
                <?php
                $sql = "SELECT *, DATE_FORMAT(posted_on, '%W, %M %d, %Y') AS formatted_date FROM updates ORDER BY posted_on DESC;";
                $conn = new mysqli("localhost", "root", "", "project");
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $i = 0;
                    while ($row = $result->fetch_assoc()) {
                        
                        echo "<div class='bg-slate-900 p-5 flex flex-col gap-3 rounded-3xl shadow-3xl'>";
                        echo "<div class=' text-sm text-violet-200'>" . $row["formatted_date"] . "</div>";
                        echo "<h1 class='text-2xl font-bold'>" . $row["title"] . "</h1>";
                        echo "<hr>";
                        echo "<p class='text-lg'>" . $row["note"] . "</p>";
                        echo "<div class=' text-xs'>" . $row["note_from"] . " • Sem " . $row["sem"] . "</div>";
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