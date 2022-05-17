<nav>
    <a href="reconnect.php">
        <div class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "reconnect.php"){ echo "active";} ?>">
            <img id="reconnect" src="icons/reconnect.svg" alt="reconnect-button">
            <p class="nav-title">reconnect</p>
        </div>
    </a>
    <a href="feed.php">
        <div class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "feed.php" || basename($_SERVER['PHP_SELF']) === "meal.php"){ echo "active";} ?>">
            <img id="home" class="" src="icons/home.svg" alt="home-button">
            <p class="nav-title">home</p>
        </div>
    </a>
    <a href="profile.php">
        <div class="nav-item <?php if(basename($_SERVER['PHP_SELF']) === "profile.php" || basename($_SERVER['PHP_SELF']) === "uploadMeal.php"){echo "active";} ?>">
            <img id="profile" class="<?php echo "active" ?>" src="icons/profile.svg" alt="profile-button">
            <p class="nav-title">profiel</p>
        </div>
    </a>
</nav>