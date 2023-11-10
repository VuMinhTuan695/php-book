<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/book/css/web/header.css">
    <link rel="stylesheet" href="/book/css/web/footer.css">
    <link rel="stylesheet" href="/book/css/web/base.css">
    <link rel="stylesheet" href="/book/css/user/infor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="app">
        <?php
        require_once('../web/header.php');
        require_once('../../config/db.php');

        $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
        if ($conn->connect_error) {
            echo "Lỗi kết nối đến cơ sở dữ liệu! <br>";
            die("Connection database failed: " . $conn->connect_error);
            return;
        }

        $sql = "SELECT * FROM user WHERE username = '{$_SESSION['user']['username']}'";
        $rs = mysqli_query($conn, $sql);
        if ($rs->num_rows <= 0) {
            echo "<script> alert('Không tồn tại '{$_SESSION['user']['username']}' để cập nhật thông tin'); </script>";
            header("Refresh: 0.01; /book/index.php", true, 303);
            return;
        }

        $account = mysqli_fetch_array($rs);
        ?>
        <div class="container">
            <div class="infor">
                <h1 class="infor__header">Thông tin cá nhân</h1>
                <form action="/book/controllers/UserController.php?action=updateInfor" method="post" class="infor__form">
                    <div class="infor__group">
                        <label for="" class="infor__title">Tên tài khoản</label>
                        <input type="text" name="username" class="input infor__input" value="<?php echo $account['username']; ?>" readonly placeholder="Nhập tên tài khoản">
                    </div>
                    <div class="infor__group">
                        <label for="" class="infor__title">Họ và Tên</label>
                        <input type="text" name="fullname" class="input infor__input" value="<?php echo $account['fullname']; ?>" placeholder="Nhập họ và tên">
                    </div>
                    <div class="infor__group">
                        <label for="" class="infor__title">Số điện thoại</label>
                        <input type="text" name="phonenumber" class="input infor__input" value="<?php echo $account['phonenumber']; ?>" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="infor__group">
                        <label for="" class="infor__title">Địa chỉ</label>
                        <input type="text" name="address" class="input infor__input" value="<?php echo $account['address']; ?>" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="infor__button-submit">
                        <button type="submit" class="btn infor__btn">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
        require_once('../web/footer.php');
        ?>
    </div>
</body>
</html>