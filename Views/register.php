<?php
session_start();

if(!empty($_SESSION['user'])) header("Location: /Views/secure-area/loggedin.php");

?>
<!doctype html>
<html lang="en">
    <head>
       <title>Natural HR Login Test</title>
    </head>
    <body>

        <h1>Natural HR Register</h1>

        <?php if(!empty($_SESSION['errors'])) : ?>
            <div>
                <?php foreach($_SESSION['errors'] AS $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form action="/Auth/register.php" method="post" enctype="multipart/form-data">
            <label>Email</label>
            <br/>
            <input type="text" name="email"/>
            <br/>
            <label>Password</label><br/>
            <input type="password" name="password"/>
            <br/>
            <label>Name</label><br/>
            <input type="text" name="fullname"/>
            <br/>
            <label>Profile Picture</label><br/>
            <input type="file" name="file" id="file"/>
            <br/><br/>
            <input type="submit" value="REGISTER"/>
        </form>
        <a href="/">Login</a>
    </body>
</html>
<?php session_destroy() ?>