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


if (isset($_SESSION['username'])&& isset($_SESSION['userID'])) {
$userid=$_SESSION['userID'];

function getuserCond($conn, $userid){
    $usecondArray='';
    //get user's categories
    $sql="SELECT * FROM User_Conditions WHERE userID='$userid'";
    $result=mysqli_query($conn, $sql);
    $numrows=mysqli_num_rows($result);

    //for each of user categories
    for ($x=0; $x<$numrows; $x++)
    {
        $current=mysqli_fetch_assoc($result);
        $catID=$current['ConditionID'];

        //get conditon name from id
        $sql="SELECT * FROM Conditions WHERE ConditionID='$catID'";
        $cond=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($cond);
        $condname=$row['ConditionName'];
        $usecondArray.="<label for=$condname>$condname:</label>
        <select name=$condname id=$condname>
            <option value='0'>0</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
        </select>
        <br>
        ";
    }
    echo $usecondArray;
}

function removedata($conn, $userid){
    $removedataa='';
    $sql="SELECT * FROM User_Condition_Rating WHERE userID='$userid' ORDER BY theDate ASC";
    $userconrate=mysqli_query($conn, $sql);

    $length=mysqli_num_rows($userconrate);
    for ($x=0;$x<$length;$x++)
    {
        $currentrate=mysqli_fetch_assoc($userconrate);
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
    $uniquecount=count($uniquedate);
    for ($x=0;$x<$uniquecount;$x++)
    {
        $removedataa.="
                    <input type=\"checkbox\" id=$uniquedate[$x] name=\"dates[]\" value=\"$uniquedate[$x]\">
                    <label for=$uniquedate[$x]>$uniquedate[$x]</label><br>
                    <hr><br>";
    }
    echo $removedataa;

}
?>

 <!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Track Your Psyche</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script src="scripts/myscripts.js"></script>
    </head>

    <body>
    <div id="page-container">
            <div id="content-wrap">
        <header>Track Your Psyche</header>

        <nav>
            <ul>
                <li><a href="maincust.php">Home</a></li>
                <li><a href="track.php">Track</a></li>
                <li><a href="add.php">Add</a></li>
                <li><a href="analyze.php">Analyze</a></li>
                <li>Hello <span class="usersname"><?php echo $_SESSION['username'];?> </span> &emsp;|&emsp;<a href="main.html">Logout</a></li>
            </ul>
        </nav>

        <main>
            <div class="trackform">
                <div id="track">
                    <h2>Track</h2>
                    <p>Track your moods or custom categories on scale from 0 to 5.<br>0 is the least. 5 is the most.<br>Example: If you feel really happy, select 5. If you had good sleep select 5.</p>
                    <?php if (isset($_GET['error4'])){?>
                        <p class="error4"><?php echo $_GET['error4'];?></p>
                    <?php } ?>
                    <form action="trackmood.php" method="post">
                        <div class="dategrid">
                        <label for='date'>Date:
                            <input pattern="(19\20)/d{2})\/(0[1-9]|1[1,2])\/(0[1-9]|[[12][0-9]|3[01])"  placeholder="YYYY/MM/DD" name="date" id="datebox" title="Date should be in format YYYY-MM-DD">
                        </label>
                        <label for="checkDate">Check to use today's date
                            <input type="checkbox" name="checkDate" id="checkDate" onclick="Datecheck()">
                        </label>
                        </div>
                        <br>
                        
                        <?php getuserCond($conn, $userid);?>
                        <button type="submit" name="trackdata">Add Data</button>
                    </form>
                </div>
                <div id="deleteinfo">
                    <h2>Remove Data</h2>
                    <p>The following dates are dates that have data. <br>Select the dates you would like to delete data from.</p>
                    <?php if (isset($_GET['error5'])){?>
                        <p class="error5"><?php echo $_GET['error5'];?></p>
                    <?php } ?>
                    <form action="removedata.php" method="post">
                
                        <?php removedata($conn, $userid);?>
                        <button type="submit" name="removedata">Delete</button>
                    </form>   



                </div>
            </div>
        </main>
        </div>
            <footer id="footer">
                <h3><a href="helppage.html">Need Help? Visit our help desk!</a></h3>
            </footer>
        </div>
    </body>
</html>
<?php }?>