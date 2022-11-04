<?php
require('user_validator.php');

// checks if user has submitted form
if (isset($_POST['submit'])) {
    // validates POST entries with script. 
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();
}

?>

<html lang="en">

<head>
    <title>PHP OOP Tutorial</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="new-user">
        <h2>Create New User</h2>
        <!-- Uses this page's PHP to handle form action -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($_POST['username']) ?? '' ?>">
            <div class="error">
                <?php echo $errors['username'] ?? '' ?>
            </div>

            <label>Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email']) ?? '' ?>">
            <div class="error">
                <?php echo $errors['email'] ?? '' ?>
            </div>

            <input type="submit" value="submit" name="submit">
        </form>
    </div>
</body>

</html>