<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File_Handling_03_Login</title>
</head>
<body>


<?php
    $uname_1 = $password_1 = $unameErr = $passwordErr = "";
    $uname_2 = $password_2 = "";
    $flag = 0;
    $count = 0;
    

    if ($_SERVER["REQUEST_METHOD"] =="POST" )
    {
        if(empty($_POST['uname'])) 

            {
                $unameErr = "Please Fill Up the UserName";
            }
            else
            {
                $uname_1 = $_POST['uname'];
                $count++;
            }

        if(empty($_POST['password'])) 

            {
                $passwordErr = "Please Fill Up the Password";
            }
            else
            {
                $password_1 = $_POST['password'];
                $count++;
            }

            if ($count >= 2)
            {
                //Database 

                $host = "localhost";
                $user = "user";
                $pass = "123";
                $db = "task";

                 // Mysqli object-oriented

	            $conn1 = new mysqli($host, $user, $pass, $db);
            
                if($conn1->connect_error)
                {
                    echo "Database Connection Failed!";
                    echo "<br>";
                    echo $conn1->connect_error;
                }

                else
                {
                    //"Database Connection Successful!";
                    
                    $stmt1 = $conn1->prepare("select username, password from user where username=?");
                    $stmt1->bind_param("s", $uname_1);
                    $stmt1->execute();
                    $res2 = $stmt1->get_result();
                    $user = $res2->fetch_assoc();


                    $uname_2 = $user['username'];
                    $password_2 = $user['password'];

                    if ($uname_1 == $uname_2 && $password_1 == $password_2)
                    {

                        echo "<br>";
                        echo "Login Successful!!!";

                        echo "<br>";
                        echo "Username: " . $user['username'];
                        echo "<br>";
                        echo "Password: " . $user['password'];
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";

                        $flag = 1;
                    }
                    else
                    {
                        echo "<br>";
                        echo "Login Unsuccessful!!";
                    }
                    if ($flag>0)
                    {
                
                        $_SESSION['userId'] = $uname_1;
                        $_SESSION['password'] = $password_1;
                    
                    }

                }
        
            }
        
        }
    session_unset();
    session_destroy();
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

    <center>
    <i>
    <h2>User Login</h2>
    
    <b> <p style="font-size: 16px;">UserName</p> <input type="text" name="uname" value="" placeholder="Type UserName" size="30px">
    <p style="color:red"><?php echo $unameErr; ?></p>
    
                    
    <b> <p style="font-size: 16px;">Password</p> <input type="password" name="password" value="" placeholder="Type Password" size="30px">
    <p style="color:red"><?php echo $passwordErr; ?></p>
    
    <br> <br> <input type="submit" name="" value="Login">                       
</form>
</center> 

<center>
<br>
<button onclick="location.href='reg.php'">Sign Up</button>
</center>

</body>
</html>