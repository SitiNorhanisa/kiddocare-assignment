<?php
/*
* This file should display the login form. Login and authentication process should use user credentials
* from the file users.txt
*/


if (isset($_POST['loginBtn'])) {

    $success = false;
    $userList = file('dummy.txt');
    // $userList = file_get_contents('users.txt');
    // $userList = explode("\n", $userList);
    $un = $_POST['userN'];
    $pwd = $_POST['passW'];

    // if (isset($_POST['loginBtn'])) {
    foreach ($userList as $user) {
        $userDetails = explode('|', $user);
        $pwdarray = $userDetails[1];

        if (strcmp($pwdarray, $pwd) == 0) {
            // $success = true;
            echo "Username : " . $un . "<br>";
            echo "Password : " . $pwd . "<br>";
            echo "Success" . $pwd;
            break;
        } else {
            echo "Fail. Username: " . $un . " Password: " . $pwd . "<br>";
        }

        print_r($userDetails) . "<br>";

        echo $userDetails[0] . " " . $userDetails[1] . "<br>";
    }

    // if ($success) {
    //     echo "Success" . $pwd;
    //     # code...
    // } else {
    //     echo "Fail. Username: " . $un . " Password: " . $pwd;
    // }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootsrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Login</title>

</head>

<body>
    <div class="container">

        <h5>Login page</h5>

        <!-- form -->
        <div>
            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="userN" aria-describedby="usernameHelp" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" name="passW" placeholder="Password" required>
                </div>
                </br>
                <input type="submit" class="btn btn-primary" name="loginBtn" value="Sign in"></input>
            </form>
        </div>

    </div>

    <!-- <script src="js/login.js"> -->
    </script>
</body>

</html>