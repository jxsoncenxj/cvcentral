<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>REGISTER</title>
    <link type="image/png" sizes="16x16" rel="icon" href=".../icons8-opened-folder-16.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
</head>

<body>




    <div class="container-fluid">
        <div class="col CV">
            <div class="form-group">
                <form action="register.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="email" class="form-control my-2" placeholder="Email">
                    <input type="password" name="password" class="form-control my-2" placeholder="Password">
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="submit" class="btn btn-dark mx-1" value="Register">
                        <input type="reset" class="btn btn-dark" value="Clear">
                    </div>
                </form>
                <p>Already have an account? <a href="login.php">Log in</a></p>
            </div>
        </div>
    </div>
    <?php
    //let user register and pass the details to the database
    if (isset($_POST['submit'])) {
        //connect to database
        include 'connect.php';
        //get email and password from form
        $email = $_POST['email'];
        $password = $_POST['password'];
        //validate email and password
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } else if (strlen($password) < 8) {
            echo "Password must be at least 8 characters long";
        } else {
            //check if email exists in database
            $sql = "SELECT * FROM cvs WHERE email = '$email'";
            $result = $conn->query($sql);
            //if email exists
            if ($result->num_rows > 0) {
                echo "Email already exists";
            } else {
                //hash password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                //insert user details into database
                $sql = "INSERT INTO cvs (email, password) VALUES ('$email', '$hashed_password')";
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                    header("Location: login.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    }
    ?>

</body>

</html>