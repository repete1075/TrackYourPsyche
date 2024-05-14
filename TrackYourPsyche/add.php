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
            <div class="grid3">
            <div id="adding">
                <h2>What else would you like to track?</h2>
                <?php if (isset($_GET['error3'])){?>
                    <p class="error3"><?php echo $_GET['error3'];?></p>
                <?php } ?>
                <form action="addcat.php" method="post">
                    <label for="add">Category</label>
                    <input type="text" id="add" name="add" required>
                    <button type="submit">Add Category</button>
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