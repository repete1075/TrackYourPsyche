<?php 

session_start(); 
    $sname= "localhost";
    $uname= "root";
    $password = "";
    $db_name = "Track_My_Psyche";

    /*connecting to server*/
    $conn = mysqli_connect($sname, $uname, $password, $db_name);
    if (!$conn) {
        echo "Connection failed!";
    }
        $userid=$_SESSION['userID'];


    //was form filled out
    /*was the form filled out*/
    if (isset($_POST['removedata'])) {
        $datedelete=$_POST['dates'];
        if(empty($datedelete))
        {
            header("Location:track.php?error5=No dates selected. No data removed.");
        }
        else{
            $count=count($datedelete);
            echo $count;
            echo $datedelete[0];
            for ($x=0; $x<$count;$x++)
            {
                $sql="DELETE FROM User_Condition_Rating WHERE theDate='$datedelete[$x]' AND userID='$userid'";
                mysqli_query($conn, $sql);
            }
            header("Location:track.php?error5=Data removed.");
        }

    }


    
