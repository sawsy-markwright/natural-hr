<?php
session_start();

if(!empty($_SESSION['user'])) header("Location: /views/secure-area/loggedin.php");

?>
<!doctype html>
<html lang="en">
    <head>
       <title>Natural HR Login Test</title>
    </head>
    <body>

        <h1>Natural HR Login Test</h1>

        <?php if(!empty($_SESSION['errors'])) : ?>
            <div>
                <?php foreach($_SESSION['errors'] AS $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form action="./Auth/login.php" method="post">
            <label>Email</label><br/>
            <input type="text" name="email"/><br/>
            <label>Password</label><br/>
            <input type="text" name="password"/><br/>
            <input type="submit" value="LOGIN"/>
        </form>
        <a href="/views/register.php">Register</a>
    </body>
</html>
<?php if(!empty($_SESSION['errors'])) unset($_SESSION['errors']) ?>