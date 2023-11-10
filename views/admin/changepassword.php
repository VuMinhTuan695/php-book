<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/book/css/admin/header.css">
    <link rel="stylesheet" href="/book/css/admin/base.css">
    <link rel="stylesheet" href="/book/css/admin/changepassword.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="app">
        <?php
        require_once('header.php');
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
        } else {
            echo "<script> alert('Bạn chưa truyền tham số username để đổi mật khẩu'); </script>";
            return;
        }
        ?>
        <div class="back-to-manager-product">
            <i class="fa-solid fa-arrow-left back-to-manager-product__icon"></i>
            <a href="/book/views/admin/index.php" class="back-to-manager-product__link">Trở về trang quản lý</a>
        </div>
        <div class="changepassword">
            <div class="changepassword__header">Thay đổi mật khẩu</div>
            <form action="/book/controllers/UserController.php?action=changepasswordAdmin&username=<?php echo $username; ?>" method="post" class="changepassword__form">
                <div class="changepassword__group">
                    <label for="" class="changepassword__title-element">Tên tài khoản</label>
                    <input name="username" value="<?php echo $username; ?>" readonly type="text" class="input changepassword__input" placeholder="Nhập tên tài khoản">
                </div>
                <div class="changepassword__group">
                    <label for="" class="changepassword__title-element">Mật khẩu cũ</label>
                    <input name="old-password" type="password" class="input changepassword__input" placeholder="Nhập mật khẩu cũ">
                </div>
                <div class="changepassword__group">
                    <label for="" class="changepassword__title-element">Mật khẩu mới</label>
                    <input name="new-password" type="password" class="input changepassword__input" placeholder="Nhập mật khẩu mới">
                </div>
                <button class="btn" type="submit">Lưu thay đổi</button>
            </form>
        </div>
    </div>
</body>

</html>