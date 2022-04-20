<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-fluid ">
        <div class="col CV">
            <div class="form-group">
                <form action="login.php" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" name="email" class="form-control my-2" placeholder="Email">
                    <input type="password" name="password" class="form-control my-2" placeholder="Password">
                    <div class="d-flex justify-content-center">
                        <input type="submit" name="submit" class="btn 
                    btn-dark " value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php
include 'connect.php';
if (isset($_POST['submit'])) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //get email and hashed password from form
    $email = $_POST['email'];
    $hashed_password = $_POST['password'];
    //validate email and password
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        //check if email exists in database
        $sql = "SELECT * FROM cvs WHERE email = '$email'";
        $result = $conn->query($sql);
        //if email exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            //check if password is correct
            if (password_verify($hashed_password, $row["password"])) {
                //set user as logged in
                if (!isset($_SESSION)) session_start();
                $_SESSION['id'] = $row["id"];
                $_SESSION['name'] = $row["name"];
                $_SESSION['email'] = $row["email"];
                $_SESSION['keyprogramming'] = $row["keyprogramming"];
                //redirect to home page
                header("Location: index.php");
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "Email not found";
        }
    }
    $conn->close();
}
?>