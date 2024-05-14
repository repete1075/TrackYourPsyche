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
    if (isset($_POST['trackdata'])) {
        if (empty($_POST['date']))
        {
            header("Location:track.php?error4=Date cannot be empty");
        }
        else{

        //get user's categories
        $sql="SELECT * FROM User_Conditions WHERE userID='$userid'";
        $result=mysqli_query($conn, $sql);
        //number of user's categories
        $numrows=mysqli_num_rows($result);
        $thedate=$_POST['date'];
        echo $thedate;
        if(!preg_match("/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/", $thedate))
        {
            header("Location:track.php?error4=Invalid date format");
        }


    //get condname relating to condid
        //does the date already exist in database
        $sql="SELECT * FROM User_Condition_Rating WHERE theDate='$thedate' AND userID='$userid'";
        $solution=mysqli_query($conn, $sql);
        $rownumber=mysqli_num_rows($solution);
        echo $rownumber;
        if ($rownumber>0){
            header("Location:track.php?error4=Date already has data. Remove data first, then update.");
        }
        else{

        //for each of user categories
            for ($x=0; $x<$numrows; $x++)
            {

                //get current ID
                $current=mysqli_fetch_assoc($result);
                $catID=$current['ConditionID'];

                //get condname relating to condid
                $sql="SELECT * FROM Conditions WHERE ConditionID='$catID'";
                $cond=mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($cond);
                $condname=$row['ConditionName'];
 
                //get data relating to condition
                $curdata=$_POST[$condname];


                //add data to database
                $sql="INSERT INTO User_Condition_Rating (userID, condID, rating, theDate) VALUES ($userid, $catID, $curdata, '$thedate')";
                
                if (mysqli_query($conn, $sql))
                    header("Location:track.php?error4=Data Added.");
                
            }
        }
    }
}


    
