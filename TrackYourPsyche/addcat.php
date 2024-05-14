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

    //was form filled out
    /*was the form filled out*/
    if (isset($_POST['add'])) {
        echo "Working...";
        $toadd=$_POST['add'];
        $userid=$_SESSION['userID'];


        //does column already exist
        $sql="SELECT * FROM Conditions WHERE ConditionName='$toadd'";
        $result=mysqli_query($conn, $sql);
        $numrows=mysqli_num_rows($result);
        
        if($numrows==0)
        {
            //sql instructions to add column
            $sql="INSERT INTO Conditions (ConditionName)
            VALUES ('$toadd')";

        //insert condition into Conditions Table
            if (mysqli_query($conn, $sql)){
                echo "Category added.";
                
            }
        }
}
echo "ok";
//add condition user tie
    //get condition id
    $getid="SELECT * FROM Conditions WHERE ConditionName='$toadd'";
    $result=mysqli_query($conn, $getid);
    $row=mysqli_fetch_assoc($result);
    $conID=$row['ConditionID'];
echo "umm";
echo $conID;
    //is the condition already tied to user
    $isadded="SELECT * FROM User_Conditions WHERE userID='$userid' AND ConditionID='$conID'";
    $alreadylink=mysqli_query($conn, $isadded);
    $numrows2=mysqli_num_rows($alreadylink);
echo $numrows2;
    if ($numrows2==0){ 
        
        //input condid and userid to usercondition table
        $sql="INSERT INTO User_Conditions (userID, ConditionID)
        VALUES ('$userid', '$conID')";
        $result2=mysqli_query($conn, $sql);
    

        //add NULL data to all previous dates for this category!!
        $sql="SELECT * FROM User_Condition_Rating WHERE userID='$userid' ORDER BY theDate ASC";
        $userconrate=mysqli_query($conn, $sql);

        $length=mysqli_num_rows($userconrate);
        if($length!=0)
        {
            for ($x=0;$x<$length;$x++)
            {
                $currentrate=mysqli_fetch_assoc($userconrate);
                $thedate[]=$currentrate['theDate'];
            }
            echo "2";
            $datecount=count($thedate);
            echo "3";

            $uniquedate=[];
            
            echo "yep";

            for ($x=0;$x<$datecount;$x++)
            {
                if ($x==0)
                {
                    $uniquedate[]=$thedate[$x];
                }
            else{
                    if ($thedate[$x]<>$thedate[$x-1])
                        $uniquedate[]=$thedate[$x];
                }
            }
            echo "3";
            $numuniquedates=count($uniquedate);
            echo $numuniquedates;
            for ($x=0;$x<$numuniquedates;$x++)
            {
                $currentdate=$uniquedate[$x];
                $sql="INSERT INTO User_Condition_Rating (userID, condID, rating, theDate) VALUES ($userid, $conID, 0, '$currentdate')";
                echo $sql;
                if (mysqli_query($conn, $sql))
                    echo "success";
            }
        }    
        header("Location:add.php?error3=Category Added.");
}
    else
    {
         header("Location:add.php?error3=Category Already Added.");
    }





    ?>