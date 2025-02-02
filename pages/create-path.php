<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../assets/js/learning-path.js" defer></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <?php
        if (isset($_COOKIE['loggedIn']) || !empty($_GET)) {

            echo '<header>
                    <nav>
                        <span>
                            <a href="learning-paths.php">Learning Paths</a>|
                            <a href="create-path.php">Create a Learning Path</a>|
                            <a href="../index.php">Home</a>|
                            <a href="pages/user-profile.php">Profile</a>
                        </span>
                        <span id="login">
                            <a onclick="logout();">Logout</a>
                        </span>
                    </nav>        
                </header>';
        
        } else {
            echo '<header>
            <nav>
                <span>
                    <a href="learning-paths.php">Learning Paths</a>|
                    <a href="../index.php">Home</a>
                </span>
                <span id="login">
                    <a href="register.php">Register</a>|
                    <a href="login.php">Login</a>
                </span>
            </nav>        
        </header>';
        }
    ?>

    <p>Create a Learning Path</p>
    <br>

    <form method="post" action="../assets/php/path-form.php" id="learning-path-form">
        <label for="path_name">Learning Path Name</label>
        <input type="text" id="path_name" name="path_name">

        <label for="path_desc">Path Description</label>
        <textarea id="path_desc" name="path_desc" cols="30" rows="10"></textarea>

        <label for="given_resources" id="given_resources" name="given_resources">Resources</label>
        <input type="text" id='given_resources1' name='given_resources1'>
        <div id="append"></div>
        <input type="button" id="add-button" value="Add">
        <br>
        <input type="number" name="counter" id="counter" hidden="true">
        <input type="text" id='edit' name='edit' value='false' hidden='true'>
        <br>
        <br>
        <input type="submit" id='create' class='userSubmitOptions'>
    </form>
    
    <script>
    const logout = () => {
        location.href = "login.php";
            document.cookie = "loggedIn=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "email=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "userId=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
    </script>

</body>
</html>