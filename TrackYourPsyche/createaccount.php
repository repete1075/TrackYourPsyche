<?php 

session_start(); 
    $sname= "localhost";
    $uname= "root";
    $password = "";
    $db_name = "Track_My_Psyche";

    /*connecting to server*/
   // $conn = mysqli_connect($sname, $uname, $password, $db_name);
    //if (!$conn) {
     //   echo "Connection failed!";
    //    header ("Location: instruct.php?error3=Database setup needed.");
   // }
        try{
            $conn = mysqli_connect($sname, $uname, $password, $db_name);
        }
        catch (Exception $e){
            header("Location: instruct.php?error3=You do not have the database set up, please follow these instructions.");
        }


    /*was the form filled out*/
    if (isset($_POST['Username']) && isset($_POST['Password']) &&isset($_POST['email'])&&isset($_POST['fname'])) {
        echo "Working...";
    }
    $usname=$_POST['Username'];
    $psword=$_POST['Password'];
    $eMail=$_POST['email'];
    $fname=$_POST['fname'];
echo "working1.5";

    /*check if username or email already exists*/
    $question="SELECT * FROM User_Profile WHERE email='$eMail'";
    $q2="SELECT * FROM User_Profile WHERE username='$usname'";
    $results=mysqli_query($conn, $question);
    $result2=mysqli_query($conn, $q2);
    echo "2";
    $num_rows=mysqli_num_rows($results);
    $numrows2=mysqli_num_rows($result2);
    echo "3";
    if ($num_rows>0||$numrows2>0){
        header("Location:logaccount.php?error2=Account already exists. Log in or Create new account.");
    }
echo "work2";

    $sql="INSERT INTO User_Profile (fname, username, email, password) VALUES ('$fname','$usname', '$eMail', '$psword')";


    if(mysqli_query($conn,$sql)){
        echo "logged in";
        //add initial conditions to user 
        //get userID   
        $sql="SELECT * FROM User_Profile WHERE username='$usname'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        $usID=$row['userID'];

        $sql2="INSERT INTO User_Conditions (userID, ConditionID)
        VALUES ('$usID', '1'), ('$usID', '2'), ('$usID', '3'), ('$usID','4'),('$usID','5')";
        if(mysqli_query($conn, $sql2)){
            header("Location: logaccount.php?error2=Account Created. Please Log in.");
        }
        else
        echo "ohno";
        
    }
    else{
        echo "Error: ". $instruct . mysqli_error($conn);
    }
    ?>