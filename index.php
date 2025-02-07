<?php

    include("database.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h2>
            Welcome to Linda's Boutique Login!
        </h2>
        username: <br>
        <input type="text" name="username"> <br>
        password:<br>
        <input type="password" name="password"> <br>
        <input type="submit" name="submit" value="register">

    </form>
</body>
</html>

<?php

    // If the server's request method is a POST method, we will store the username and password variables
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($username)){
            echo"Please enter a username!";
        }
        elseif(empty($password)){
            echo"Please enter a password!";
        }

        // Otherwise if both are filled in, we hash the password and then insert credentials into our database
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (user, password)
                    VALUES ('$username', '$hash')";
            try{
                mysqli_query($conn, $sql);
                echo"You are now registered!";
            }
            catch(mysqli_sql_exception){
                echo"That username is taken, please enter a new one!";
            }
                  
        }
    }

mysqli_close($conn);

?>