<?php
session_start();

if(empty($_SESSION['user'])) {
    $_SESSION['errors'][] = "Please log in";
    header("Location: /");
    exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>Natural HR Login Test</title>
</head>
<body>

<h1>Natural HR Secure Area</h1>
<p>Welcome to the Secure Area <?php echo $_SESSION['user']->fullname ?></p>
<img src="/Uploads/<?php echo $_SESSION['user']->file ?>"/>
<a href="/Views/secure-area/logout.php">Logout</a>

</body>
</html>
