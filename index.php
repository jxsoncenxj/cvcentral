<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Central</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
</head>

<body>

    <nav id="mainNavbar" class="navbar navbar-dark navbar-expand-md py-0 fixed-top">
        <a href="index.php" class="navbar-brand">CV Central</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navLinks" aria-label="Toggle navigation">
            <div class="content">
                <ul class="navbar-nav ">
                    <?php
                    if (!isset($_SESSION['id'])) {
                        echo "<li class='nav-item'>
                            <a href='login.php' class='nav-link'>LOGIN</a>
                        </li>";
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo "<li class='nav-item'>
                            <a href='signout.php' class='nav-link'>LOGOUT</a>
                        </li>";
                    }
                    ?>

                    <?php
                    if (!isset($_SESSION['id'])) {
                        echo "<li class='nav-item'>
                            <a href='register.php' class='nav-link'>REGISTER</a>
                        </li>";
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo "<li class='nav-item'>
        <a  href='viewcv.php?id=" . $_SESSION["id"] . "' class='nav-link'>VIEW MY CV</a>
                    </li>";
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['id'])) {
                        echo "<li class='nav-item'>
        <a  href='editCV.php?id=" . $_SESSION["id"] . "' class='nav-link'>EDIT MY CV</a>
                    </li>";
                    }
                    ?>

                </ul>

            </div>
        </div>
        <form action="search.php" class="search-main d-flex d-none d-md-flex">
            <input class="form-control me-2" type="search" placeholder="Search CVs" aria-label="Search">
            <button class="btn btn-dark" formmethod="GET" type="submit">Search</button>
        </form>
    </nav>


    <div class="col-12 py-20 shadow CV Display">
        <h2>View CVs below:</h2>
        <p class="lead"><em>Click on a name to view the full CV</em></p>
        <?php
        include 'connect.php';
        $sql = "SELECT * FROM cvs";
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
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $(function() {
            $(document).scroll(function() {
                var $nav = $("#mainNavbar");
                $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
            });
        });
    </script>
    <footer>
        <p>&copy; 2022 Jason Cenaj</p>
    </footer>
</body>

</html>