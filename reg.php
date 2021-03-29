<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>

          table,td {
        border: 1px solid black;
        
    }

    </style>
</head>
<body >

    <?php
        
        $firstNameErr = $lastNameErr = $emailErr = $genderErr = $userNameErr = $passwordErr = $recoveryEmailErr = "";
        $firstName = $lastName = $email = $gender = $userName = $password = $recoveryEmail = "";
        $count = 0;

        if ($_SERVER["REQUEST_METHOD"] =="POST" ) 
        {
            if(empty($_POST['fname'])) 
            {
                $firstNameErr = "Please Fill Up the First Name";
            }
            else
            {
                $firstName = $_POST['fname'];
                $count++;
            }

            if(empty($_POST['lname'])) 
            {
                $lastNameErr = "Please Fill Up the Last Name";
            }
            else
            {
                $lastName = $_POST['lname'];
                $count++;
            }

            if(empty($_POST['email'])) 
            {
                $emailErr = "Please Fill Up the Email";
            }
            else
            {
                $email = $_POST['email'];
                $count++;
            }

            if(isset($_POST['gender']))
            {
                $gender = $_POST['gender'];
                $count++;
                
                if ($gender == "Male")
                {
                    $gender = "Male";
                }
                else
                {
                    $gender = "Female";
                }

           }

            else {
                $genderErr = "Please Check the Gender";
            }

           if(empty($_POST['uname'])) 
            {
                $userNameErr = "Please Fill Up the UserName";
            }
            else
            {
                $userName = $_POST['uname'];
                $count++;
            }

            if(empty($_POST['password'])) 
            {
                $passwordErr = "Please Fill Up the Password";
            }
            else
            {
                $password = $_POST['password'];
                $count++;
            }

            if(empty($_POST['remail'])) 
            {
                $recoveryEmailErr = "Please Fill Up the Recovery Email";
            }
            else
            {
                $recoveryEmail = $_POST['remail'];
                $count++;
            }

            if ($count >= 7)
            {
                $host = "localhost";
                $user = "user";
                $pass = "123";
                $db = "task";

                // Mysqli object-oriented
	            $conn1 = new mysqli($host, $user, $pass, $db);

                if($conn1->connect_error) {
                    echo "Database Connection Failed!";
                    echo "<br>";
                    echo $conn1->connect_error;
                }

                else {

                    echo "Database Connection Successful!";
                    
                    $stmt1 = $conn1->prepare("insert into user (username, password, fname, lname, email, remail, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt1->bind_param("sssssss", $userName, $password, $firstName, $lastName, $email, $recoveryEmail, $gender);
                    $status = $stmt1->execute();
            
                    if($status) {
                        echo "<br>";
                        echo "Data Insertion Successful.";
                    }
                    else {
                        echo "Failed to Insert Data.";
                        echo "<br>";
                        echo $conn1->error;
                    }
                }
            
                $conn1->close();
           }
        }
?>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <table width="50%" align="center">
            <tr >
                <td colspan="3" align="center">
                    <i>
                    <h2>Sign-Up</h2>  
                </td>
            </tr>

            <tr>
                <td width="60%" align="center">
                   <b> <p style="font-size: 16px;">First Name</p>
                </td>

                <td width="60%"align="center">
                    <input type="text" name="fname" value="" placeholder="Type First Name" size="30px">
                    <p style="color:red"><?php echo $firstNameErr; ?></p>
                </td>
                <td width="10%">
                </td>
            </tr>

            <tr>
                <td width="50%" align="center">
                   <b> <p style="font-size: 16px;">Last Name</p>
                </td>

                <td width="50%"align="center">
                    <input type="text" name="lname" value="" placeholder="Type Last Name" size="30px" >
                    <p style="color:red"><?php echo $lastNameErr; ?></p>
                </td>
                <td width="10%">
                </td>
            </tr>
             <tr>
                <td width="50%" align="center">
                   <b> <p style="font-size: 16px;">Email</p>
                </td>
                <td width="60%"align="center">
                    <input type="email" name="email" id="" value="" placeholder="Type Your Email" size="30px" >
                    <p style="color:red"><?php echo $emailErr; ?></p>
                </td>
                <td width="10%">
                </td>
            </tr>

             <tr>
               <td align="center" width="50%">
               <b> <p style="font-size: 16px;">Gender</p>
               </td>

                <td align="center" width="60%">
                    
                <input type="radio" name="gender" value="Male" >  Male 
                <input type="radio" name="gender" value="Female" > Female
                <p style="color:red"><?php echo $genderErr; ?></p>
                </td>
                <td width="10%">
                </td>
            </tr>

            <tr>
           </tr>

             <tr >
               <td colspan="3" align="center">
                    <i>
                    <h2>User Account Information</h2>
                </td>
            </tr>

            <tr>
                <td width="50%" align="center">
                   <b> <p style="font-size: 16px;">UserName</p>
               </td>

                <td width="60%"align="center">
                   <input type="text" name="uname" value="" placeholder="Type User Name" size="30px">
                    <p style="color:red"><?php echo $userNameErr; ?></p>
               </td>

                <td width="10%">
                </td>
            </tr>

                <tr>
                <td width="50%" align="center">
                   <b> <p style="font-size: 16px;">Password</p>
                </td>

                <td width="60%"align="center">
                   <input type="password" name="password" value="" placeholder="Type Password" size="30px">
                    
                    <p style="color:red"><?php echo $passwordErr; ?></p>
                </td>

                <td width="10%">
                </td>
            </tr>

                <tr>
                <td width="50%" align="center">
                   <b> <p style="font-size: 16px;">Recovery Email</p>
                </td>

                <td width="60%"align="center">

                    <input type="email" name="remail" value="" placeholder="Type Recovery Email" size="30px">
                    <p style="color:red"><?php echo $recoveryEmailErr; ?></p>
                </td>
                <td width="10%">
                </td>
            </tr>

            <tr height="50px">
                <td align="right"  colspan="3">
                    <input type="submit" name="" value="Submit"> 
                </td>
            </tr>
        </table>
    </form>

    <center>
    <br>
    <button onclick="location.href='login.php'">Login</button>
    </center>

</body>
</html>