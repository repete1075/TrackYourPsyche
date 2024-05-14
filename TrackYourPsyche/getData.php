<?php 
//arrays
//condArray: hold condition names
//condIDArray: hold condition IDs
//conditionrate: holds rating
//thedate:holds date
//num_rows: how many categories
//length: how manyratings
//usercondCount:how many conditions
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



//get user conditions
    $condArray=[];
    $conIDArray=[];
    $conditionrate=[];
    $thedate=[];
    //get user's categories ID
    $sql="SELECT * FROM User_Conditions WHERE userID='$userid'";
    $result=mysqli_query($conn, $sql);
    $numrows=mysqli_num_rows($result);


    //for each of user categories
    for ($x=0; $x<$numrows; $x++)
    {
        $current=mysqli_fetch_assoc($result);
        $catID=$current['ConditionID'];
        //$condArray.=$catID;
        $condIDArray[]=$catID;
    }


//get condition names
$sql="SELECT * FROM Conditions";
$allcond=mysqli_query($conn, $sql);
$amout=mysqli_num_rows($allcond);


    //how many condiitions does user have
    $usercondCount=count($condIDArray);

    $allconditionArray=[];

    for ($x=0;$x<$amout;$x++)
    {
        $currentcond=mysqli_fetch_assoc($allcond);
        $allconditionArray[]=$currentcond['ConditionName'];
    }

    for($x=0;$x<$usercondCount;$x++)
    {
        for($y=0;$y<$amout;$y++)
        {
            if ($y==($condIDArray[$x]-1))
            {
                $condArray[]=$allconditionArray[$y];
            }
            
        }
    }


    //get all user data
    $sql="SELECT * FROM User_Condition_Rating WHERE userID='$userid' ORDER BY condID, theDate ASC";
    $userconrate=mysqli_query($conn, $sql);

    $length=mysqli_num_rows($userconrate);
    for ($x=0;$x<$length;$x++)
    {
        $currentrate=mysqli_fetch_assoc($userconrate);
        $conditionrate[]=$currentrate['rating'];
        $thedate[]=$currentrate['theDate'];
    }
   
    $uniquedate=[];
    $datecount=count($thedate);
  
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

    
//get the names of categories
    $string="{
        \"cols\":[
        {\"id\":\"\",\"label\":\"Date\",\"pattern\":\"\",\"type\":\"string\"},";
    
    for($x=0;$x<$usercondCount;$x++)
{
    if ($x==($usercondCount-1))
    {
        $string.="{\"id\":\"\",\"label\":\"$condArray[$x]\",\"pattern\":\"\",\"type\":\"number\"}],
        \"rows\":[";
    }
    else
        $string.="{\"id\":\"\",\"label\":\"$condArray[$x]\",\"pattern\":\"\",\"type\":\"number\"},";
}
$number=$length/$usercondCount;

for($y=0;$y<$number;$y++)
{
    
   $string.="{\"c\":[
                    {\"v\":\"$uniquedate[$y]\"},";
    for ($z=0;$z<$usercondCount;$z++)
    {
        if($z==($usercondCount-1))
        {
            if($y==(($number-1)))
            {
                $a=$y+($z*$number);
            $string.="{\"v\":$conditionrate[$a]}
            ]}";
            }
            else{
                $a=$y+($z*$number);
            $string.="{\"v\":$conditionrate[$a]}
            ]},";
            }
            
        }
        else
        {
            $a=$y+($z*$number);
            $string.="{\"v\":$conditionrate[$a]},";
        }
    } 
}

$string.="]}";


//$myarray=json_decode($string);


//$json=json_encode($myarray);
$json2=json_encode($string);
$json=json_decode($json2);

//var_dump($json);

echo $json;


  