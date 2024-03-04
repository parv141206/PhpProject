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

        <h1 class="text-3xl font-extrabold">What news to post today?</h1>
        <form method="POST" class="flex flex-col gap-3 ">
            <div class="flex flex-col md:flex-row gap-3">
                <div class="flex flex-col gap-3">
                    <textarea name="note" id="note" cols="30" rows="6" placeholder="Note" class="input p-3 rounded-xl bg-slate-800 text-slate-200"></textarea>
                </div>
                <div class="flex flex-col gap-3">
                    <input type="hidden" name="form_submitted" value="<?php echo time(); ?>">
                    <input type="text" name="title" id="title" placeholder="Title" class="input p-3 rounded-xl bg-slate-800 text-slate-200">
                    <input type="text" name="note_from" id="note_from" placeholder="Note from" class=" p-3 rounded-xl input bg-slate-800 text-slate-200">
                    <input type="text" name="sem" id="sem" placeholder="Sem" class="input p-3 rounded-xl bg-slate-800 text-slate-200">
                </div>
            </div>
            <div>
                <input type="submit" value="Post" name="submit" class="btn px-5 hover:bg-violet-500 p-3 w-auto hover:cursor-pointer rounded-xl bg-violet-700 text-slate-200">
            </div>
        </form>
        <?php
        if (isset($_POST["submit"]) && isset($_POST["form_submitted"])) {
            $title = $_POST["title"];
            $note = $_POST["note"];
            $note_from = $_POST["note_from"];
            $sem = $_POST["sem"];
            $posted_on = date("Y-m-d H:i:s");
            if ($title != "" && $note != "" && $note_from != "" && $sem != "") {
                $sql = "INSERT INTO updates (title, note, note_from, sem, posted_on) VALUES ('$title', '$note', '$note_from', '$sem', '$posted_on');";
                $conn = new mysqli("localhost", "root", "", "project");
                $conn->query($sql);

                unset($_POST);

                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                echo "<h1 class='text-2xl font-bold bg-red-500 p-3 rounded-xl'>Please fill in all the fields</h1>";
            }
        }
        if (isset($_POST["delete"]) && isset($_POST["form_delete"])) {
            $update_id = $_POST["update_id"];
            $sql = "DELETE FROM updates WHERE id = $update_id;";
            $conn = new mysqli("localhost", "root", "", "project");
            $conn->query($sql);
        }
        ?>
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
                        echo "<div class=' text-sm text-violet-200'>" . $row["id"] . " • " . $row["formatted_date"] . "</div>";
                        echo "<h1 class='text-2xl font-bold'>" . $row["title"] . "</h1>";
                        echo "<hr>";
                        echo "<p class='text-lg'>" . $row["note"] . "</p>";
                        echo "<div class=' text-xs'>" . $row["note_from"] . " • Sem " . $row["sem"] . "</div>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='form_delete' value='" . time() . "'>";
                        echo "<input type='hidden' name='update_id' value='" . $row["id"] . "'>";
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