<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include 'connect.php';
    $search = $_GET['search'];
    $search = htmlspecialchars($search);
    $search = mysqli_real_escape_string($conn, $search);
    $sql = "SELECT * FROM `cvs` WHERE `name` LIKE '%$search%' OR 'keyprogramming" . " LIKE '%$search%'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class = 'container-fluid text-center py-5 shadow-sm CVtext'>";
            echo "<a class='cvName' href='viewcv.php?id=" . $row["id"] . "'>" . $row["name"] . "</a>";
            echo "<p>" . $row["email"] . "</p>";
            echo "<p>" . $row["keyprogramming"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</body>

</html>