<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/book/css/web/header.css">
    <link rel="stylesheet" href="/book/css/web/footer.css">
    <link rel="stylesheet" href="/book/css/web/base.css">
    <link rel="stylesheet" href="/book/css/user/pay.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="app">
        <?php
        require_once('../web/header.php');
        ?>
        <div class="container">
            <div class="pay">
                <div class="pay__header">
                    <h1>Thanh toán thành công</h1>
                </div>
                <div class="pay__content">
                    <h4>Cảm ơn quý khách đã sử dụng dịch vụ của chúng tôi!</h4>
                </div>
                <button class="btn pay__btn-back" id="btn-back">Trở về trang chủ</button>
            </div>
        </div>
        <?php
        require_once('../web/footer.php');
        ?>
    </div>
    <script>
        var btnBack = document.getElementById('btn-back');
        console.log(btnBack);
        btnBack.onclick = function() {
            window.location.href = '/book/controllers/UserController.php?action=donePay';
        }
    </script>
</body>
</html>