<?php 
    $sessionId = $_SESSION['id'];
    $user = User::getUserDataFromId($sessionId);
?>

<div class="header">
    <img class="logo" src="./assets/logo_dinkstagram.svg" alt="Logo Dinkstagram"/>
        <div class="header__user">
            <a  class="search" href="#"><img src="./assets/icon_search.svg" alt="Search button"/></a>
            <img class="header__profilePicture" src="profile_pictures/<?php echo $user['profile_picture']; ?>" alt="Profile picture">
            <a href="<?php echo "profile.php?id=".$user['id']; ?>" class="header__username"><?php echo htmlspecialchars($user['firstname']); ?></a>
        </div>
</div>