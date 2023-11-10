<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/book/css/web/header.css">
    <link rel="stylesheet" href="/book/css/web/footer.css">
    <link rel="stylesheet" href="/book/css/web/base.css">
    <link rel="stylesheet" href="/book/css/user/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="app">
        <?php
        require_once('../web/header.php');
        
        if (isset($_SESSION['user']['username'])) {
            header("Location: /book/index.php", true, 303);
        } else {
            ?>
            <div class="container">
                <div class="auth-form">
                    <div class="auth-form__header">
                        <p>Đăng nhập</p>
                    </div>
                    <div class="auth-form__form">
                        <form method="post" action="/book/controllers/UserController.php?action=getuser" class="auth-form__form-login">
                            <div class="auth-form__group">
                                <label>Tên tài khoản</label>
                                <input type="text" class="auth-form__input" placeholder="Nhập tên tài khoản" name="username-login">
                            </div>
                            <div class="auth-form__group">
                                <label>Mật khẩu</label>
                                <input type="password" class="auth-form__input" placeholder="Nhập mật khẩu" name="password-login">
                            </div>
                            <div class="auth-form__btn-login">
                                <button class="btn" type="submit">Đăng Nhập</button>
                            </div>
                        </form>
                    </div>
                    <div class="auth-form__register">
                        <label>Bạn chưa có tài khoản?</label>
                        <a class="auth-form__register-link" href="register.php">Đăng ký</a>
                    </div>
                </div>
            </div>
            <?php
            }
        ?>
        <?php require_once('../web/footer.php') ?>
    </div>

</body>

</html>