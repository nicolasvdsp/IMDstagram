<?php 
    $sessionId = $_SESSION['id'];
    $user = User::getUserDataFromId($sessionId);
?>

<nav class="navbar">
    <a class="navbar__btn" href="index.php">Home</a>
    <a class="navbar__btn" href="add.php">Add</a>
    <a class="navbar__btn" href="<?php echo "profile.php?id=".$user['id']; ?>">User</a>
</nav>