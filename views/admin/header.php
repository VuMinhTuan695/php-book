<header>
    <?php session_start() ?>
    <div class="header__logo">
        <a href="<?php if (isset($_SESSION['admin']['username'])) echo "/book/views/admin/index.php"; else echo "/book/views/admin/login.php"; ?>">
            <img class="header__logo-img" src="/book/image/logo.jpg" alt="LOGO">
        </a>
    </div>
    <div class="header__action-user">
        <div class="user">
            <?php
            if (isset($_SESSION['admin']['username'])) {
                ?>
                <div class="header__user">
                    <img src="/book/image/avt.png" alt="" class="header__user-avt">
                    <div class="header__menu-user">
                        <ul class="header__list-action-user">
                            <li class="header__action-user">
                                <a href="/book/index.php" class="header__action-user-link" target="_blank" rel="noopener noreferrer">Mở trang chủ</a>
                            </li>
                            <li class="header__action-user">
                                <a href="/book/views/admin/changepassword.php?username=<?php echo $_SESSION['admin']['username']; ?>" class="header__action-user-link">Đổi mật khẩu</a>
                            </li>
                            <li class="header__action-user">
                                <a href="/book/views/admin/logout.php" class="header__action-user-link">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <a href="/book/views/admin/login.php" class="user__link">
                    <i class="fa-regular fa-user user__icon"></i>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</header>