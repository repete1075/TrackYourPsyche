<?php 

session_start(); 
    $sname= "localhost";
    $uname= "root";
    $password = "";
    $db_name = "Track_My_Psyche";

    /*connecting to server*/
    try{
        $conn = mysqli_connect($sname, $uname, $password, $db_name);
    }
    catch (Exception $e){
        header("Location: instruct.php?error3=You do not have the database set up, please follow these instructions.");
    }



    /*was the form filled out*/
    if (isset($_POST['userName']) && isset($_POST['passWord'])) {
        echo "Working...";
    }

    $usename=($_POST['userName']);
    $passW=($_POST['passWord']);

    /*check if empty*/


    $sql="SELECT * FROM User_Profile WHERE username='$usename' AND password='$passW'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)===1){
        $row=mysqli_fetch_assoc($result);
    /*does user exist*/
        if($row['username']===$usename && $row['password']===$passW){
            echo "Logged In";
            $_SESSION['username']=$row['username'];
            $_SESSION['fname']=$row['fname'];
            $_SESSION['userID']=$row['userID'];
            header("Location:maincust.php");
        } else{
            echo "Incorrect Username or Password. Try again or create new account.";
            header("Location: logaccount.php?error=Incorrect Username or Password.");
        }
    }
    else{
        header("Location: logaccount.php?error=Incorrect Username or Password. Try again or create new account.");
    }

?>