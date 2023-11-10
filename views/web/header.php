<header>
    <?php session_start() ?>
    <div class="header__logo">
        <a href="/book/index.php">
            <img class="header__logo-img" src="/book/image/logo.jpg" alt="LOGO">
        </a>
    </div>
    <div class="search">
        <form action="/book/controllers/ProductController.php?action=productSearch" method="post">
            <input type="text" class="search__input" name="datasearch" placeholder="Tìm kiếm sản phẩm mong muốn...">
            <button title="submit-form" type="submit" class="search__btn">
                <i class="fa-solid fa-magnifying-glass search__icon"></i>
            </button>
        </form>
    </div>
    <div class="header__action-user">
        <div class="cart">
            <a href="/book/views/user/cart.php" class="cart__link">
                <i class="fa-solid fa-cart-shopping cart__icon"></i>
            </a>
        </div>
        <div class="user">
            <?php
            if (isset($_SESSION['user']['username'])) {
                ?>
                <div class="header__user">
                    <img src="/book/image/avt.png" alt="" class="header__user-avt">
                    <div class="header__menu-user">
                        <ul class="header__list-action-user">
                            <li class="header__action-user">
                                <a href="/book/views/user/infor.php" class="header__action-user-link">Thông tin cá nhân</a>
                            </li>
                            <li class="header__action-user">
                                <a href="/book/views/user/changepassword.php?username=<?php echo $_SESSION['user']['username']; ?>" class="header__action-user-link">Đổi mật khẩu</a>
                            </li>
                            <li class="header__action-user">
                                <a href="/book/views/user/logout.php" class="header__action-user-link">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <a href="/book/views/user/login.php" class="user__link">
                    <i class="fa-regular fa-user user__icon"></i>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</header>