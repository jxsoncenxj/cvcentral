<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIEW CV</title>
    <link type="image/png" sizes="16x16" rel="icon" href=".../icons8-opened-folder-16.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <nav id="mainNavbar" class="navbar navbar-dark navbar-expand-md py-0 fixed-top">
        <a href="#" class="navbar-brand">CV Central</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navLinks" aria-label="Toggle navigation">
            <div class="content">
                <ul class="navbar-nav ">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">HOME</a>
                    </li>
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo "<li class='nav-item'>
                            <a href='signout.php' class='nav-link'>LOGOUT</a>
                        </li>";
                    }
                    ?>

                </ul>

            </div>
        </div>
        <form action="search.php" method="POST" class="search-main d-flex d-none d-md-flex">
            <input class="form-control me-2" type="search" placeholder="Search CVs" aria-label="Search">
            <button class="btn btn-dark" type="submit">Search</button>
        </form>
    </nav>

    <div class="container-fluid">
        <div class="row ">

            <div class="col-6  CV Display">
                <?php

                include 'connect.php';

                $id = $_GET['id'];

                $sql = "SELECT * FROM cvs WHERE id = '$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<h1 class = 'display-4'>" . $row["name"] . "<h1>";
                    echo "<p class = 'py-1'>Email: " . $row["email"] . "<p>";
                    echo "<p class = 'py-1'>Key Programming: " . $row["keyprogramming"] . "<p>";
                    echo "<p class = 'py-1'>Profile: " . $row["profile"] . "<p>";
                    echo "<p class = 'py-1'>Education: " . $row["education"] . "<p>";
                    echo "<p class = 'py-1'>Social Media: " . $row["URLlinks"] . "<p>";
                } else {
                    echo "No cv found";
                }

                $conn->close();
                ?>



            </div>
</body>

</html>