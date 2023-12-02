<header class="header">
    <div class="header-home">
        <img src="/build/img/my_unsplash_logo.svg" alt="logo">
        <div class="header-home-input">
            <img src="/build/img/Vector.svg" alt="search" class="input-search">
            <input type="text" class="search" placeholder="Search by name">
        </div>
    </div>
    <div class="header-action-user-desktop">
        <?php if (isset($_SESSION['login'])) { ?>
            <span>Welcome <?php echo $_SESSION['username'] ?></span>
            <button class="btn">Add a photo</button>
            <a href="/logout">Logout</a>
        <?php } else { ?>
            <a href="/login">Login</a>
        <?php } ?>
    </div>
    <div class="header-action-user">
        <img src="/build/img/hamburger-menu.svg" alt="menu" id="hamburger">
        <div class="action-user-contentList hide">
            <?php if (isset($_SESSION['login'])) { ?>
                <span>Welcome <?php echo $_SESSION['username'] ?></span>
                <a href="/logout">Log Out</a>
                <button class="btn btn-movil">Add a photo</button>
            <?php } else { ?>
                <a href="/login">Login</a>
            <?php } ?>
        </div>
    </div>
</header>