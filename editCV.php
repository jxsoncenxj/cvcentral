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
    <?php include 'connect.php';
    session_start();
    error_reporting(0);
    $id = $_SESSION['id'];
    if (isset($_GET['name']) && $_GET['name'] != "") {
        $name = $_GET['name'];
        $nameNew = "UPDATE cvs SET name='$name' WHERE id=$id";
        $conn->query($nameNew);
    }
    if (isset($_GET['keyprogramming']) && $_GET['keyprogramming'] != "") {
        $keyprog = $_GET['keyprogramming'];
        $keyprogNew = "UPDATE cvs SET keyprogramming ='$keyprog' WHERE id=$id";
        $conn->query($keyprogNew);
    }
    if (isset($_GET['profile']) && $_GET['profile'] != "") {
        $profile = $_GET['profile'];
        $profileNew = "UPDATE cvs SET profile='$profile' WHERE id=$id";
        $conn->query($profileNew);
    }
    if (isset($_GET['education']) && $_GET['education'] != "") {
        $education = $_GET['education'];
        $educationNew = "UPDATE cvs SET education='$education' WHERE id=$id";
        $conn->query($educationNew);
    }
    if (isset($_GET['url']) && $_GET['url'] != "") {
        $urlLink = $_GET['url'];
        $urlLinkNew = "UPDATE cvs SET URLlinks ='$urlLink' WHERE id=$id";
        $conn->query($urlLinkNew);
    }
    ?>
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

                    <li class='nav-item'>
                        <a href='viewcv.php?id=" . $_SESSION["id"] . "' class='nav-link'>VIEW MY CV</a>
                    </li>
                </ul>

            </div>
        </div>
        <form action="search.php" method="POST" class="search-main d-flex d-none d-md-flex">
            <input class="form-control me-2" type="search" placeholder="Search CVs" aria-label="Search">
            <button class="btn btn-dark" type="submit">Search</button>
        </form>
    </nav>

    <div class="container-fluid">

        <?php




        $id =  $_SESSION['id'];

        $sql = "SELECT * FROM cvs WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "No cv found";
        }

        $conn->close();
        ?>
        <div class="container-fluid">
            <div class="col-auto CV Display">
                <h2>Edit my CV</h2>
                <form>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="<?php echo $row["name"] ?>"><br>
                        <label for="keyprogramming">Key programming language:</label><br>
                        <input type="text" id="keyprogramming" class="form-control" name="keyprogramming" placeholder="<?php echo $row["keyprogramming"] ?>"><br>
                        <label for="profile">Profile:</label><br>
                        <input type="text" id="profile" class="form-control" name="profile" placeholder="<?php echo $row["profile"] ?>"><br>
                        <label for="education">Education:</label><br>
                        <input type="text" id="education" class="form-control" name="education" placeholder="<?php echo $row["education"] ?>"><br>
                        <label for="url">URL Link:</label><br>
                        <input type="text" id="url" class="form-control" name="url" placeholder="<?php echo $row["URLlinks"] ?>"><br><br>
                        <div class="d-flex justify-content-center">
                            <button name="update" formmethod="GET" class="btn btn-dark btn-lg">Update CV</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>