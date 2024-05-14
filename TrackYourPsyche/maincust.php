<!--Colors Hex:
Green: $6c7355
Text Whiteish: #c7cdc8
Menu Bar and content background: #9a9f8a
Blue: #334467
Text: #575a54
Button: 808e8a
-->
<?php 

session_start();

if (isset($_SESSION['username'])&& isset($_SESSION['userID'])) {

 ?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Track Your Psyche</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
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
            <div id="welcomemessage">
                <h2>Welcome To Track Your Psyche</h2>
                <h3>Welcome back <?php echo $_SESSION['username'];?>. It's great to see you!</h3>
            </div>
            <div class="grid">
                <div id="tracker" class="frame"><a href="track.php">
                    <h2>Track</h2>
                    <p>Track your daily moods or custom categories.</p></a>
                </div>
                <div id="adder" class="frame"><a href="add.php">
                    <h2>Add</h2>
                    <p>Add custom categories you would like to track.</p></a>
                </div>
                <div id="analyzer" class="frame"><a href="analyze.php">
                    <h2>Analyze</h2>
                    <p>View a graph displaying your data.</p></a>
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
<?php
}else{
    header("Location:main.html");
    exit();
}
?>