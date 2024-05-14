<!DOCTYPE html>
<html lang="eng">
    <head>
        <title>Login</title>
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
                <li><a href="main.html">Home</a></li>
                <li><a href="logaccount.php">Track</a></li>
                <li><a href="logaccount.php">Add</a></li>
                <li><a href="logaccount.php">Analyze</a></li>
                <li><a href="logaccount.php">Login</a>|<a href="logaccount.php">New Account</a></li>
            </ul>
        </nav>

        <main>
            <div class="grid2">
                <div id="login">
                    <h2>Login</h2>
                    <?php if (isset($_GET['error'])){?>
                        <p class="error"><?php echo $_GET['error'];?></p>
                    <?php } ?>
                    <form action="login.php" method="post">
                        <label for="userName">Username:</label>
                        <input type="text" id="userName" name="userName" required>
                        <br>
                        <label for="passWord">Password:</label>
                        <input type="password" id="passWord" name="passWord" required>
                        <br>
                        <button type="submit">Login</button>
                    </form>
                </div>
                <div id="createaccount">
                    <h2>Create Account</h2>
                    <?php if (isset($_GET['error2'])){?>
                        <p class="error2"><?php echo $_GET['error2'];?></p>
                    <?php } ?>
                    <form action="createaccount.php" method="post">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" required>
                        <br>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" required>
                        <br>
                        <label for="Username">Username:</label>
                        <input type="text" id="Username" name="Username" required>
                        <br>
                        <label for="Password">Password:</label>
                        <input type="password" id="Password" name="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number, one uppercase, and one lowercase letter, and be at least 8 characters. required">
                        <button type="button" id="buttonquest" title="Must contain at least one number, one uppercase, and one lowercase letter, and be at least 8 characters. required">?</button>
                        <br>
                        <button type="submit">Create Account</button>
                    </form>
                </div>
            </div>
        </main>
        </div>
            <footer id="footer">
                <h3><a href="helppage.html">Need Help? Visit our help desk!</a></h3>
            </footer>
        </div>
</html>