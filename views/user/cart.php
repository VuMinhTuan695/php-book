<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/book/css/web/header.css">
        <link rel="stylesheet" href="/book/css/web/footer.css">
        <link rel="stylesheet" href="/book/css/web/base.css">
        <link rel="stylesheet" href="/book/css/user/cart.css">
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

            $account;
            if (isset($_SESSION['user']['username'])) {
                $sql = "SELECT * FROM user WHERE username = '{$_SESSION['user']['username']}'";
                $rs = mysqli_query($conn, $sql);
                if ($rs->num_rows <= 0) {
                    echo "<script> alert('Không tồn tại '{$_SESSION['user']['username']}' để cập nhật thông tin'); </script>";
                    header("Refresh: 0.01; /book/index.php", true, 303);
                    return;
                }
    
                $account = mysqli_fetch_array($rs);
            }

            ?>
            <div class="container">
                <h1 class="cart-product__heading">Giỏ hàng</h1>
                <?php
                if (empty($_SESSION['cart'])) {
                    ?>
                    <div class="cart__empty">
                        <img src="/book/image/ico_emptycart.png" alt="ico_emptycart" class="cart__img-empty">
                        <p class="cart__empty-description">Chưa có sản phẩm trong giỏ hàng của bạn.</p>
                        <button class="btn" id="cart-empty-btn" onclick="backToIndex()">MUA SẮM NGAY</button>
                    </div>
                    <script>
                        function backToIndex() {
                            window.location.href = '/book/index.php';
                        }
                    </script>
                    <?php
                    return;
                }
                $listProduct = $_SESSION['cart'];
                ?>
                <div class="cart-product">
                    <table class="cart__table-products">
                        <thead>
                            <tr class="cart__heading">
                                <th class="cart__heading-product">Sản phẩm</th>
                                <th class="cart__heading-qtt">Số lượng</th>
                                <th class="cart__heading-points-to-money">Thành tiền</th>
                                <th class="cart__heading-action">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            function searchIndex($array, $key, $value) {
                                foreach($array as $index => $subarrray) {
                                    if (isset($subarrray[$key]) && $subarrray[$key] === $value) {
                                        return $index;
                                    }
                                }
                            }
                            
                            $totalMoney = 0;
                            foreach($listProduct as $product) {
                                $key = 'id';
                                $value = $product[$key];
                                $index = searchIndex($listProduct, $key, $value);
                                ?>
                                <tr class="cart__product-item">
                                    <input type="hidden" value="<?php echo $index; ?>" id="getIndex">
                                    <td class="cart__product-infor">
                                        <div class="cart__product-image">
                                            <img src="/book/image/product/<?php echo $product['image'] ?>" alt="" class="cart__product-img">
                                        </div>
                                        <div class="cart__product-content">
                                            <p class="cart__product-name"><?php echo $product['name'] ?></p>
                                            <p class="cart__product-price" id="product-price"><?php echo $product['price'] ?></p>
                                            <span> đ</span>
                                        </div>
                                    </td>
                                    <td class="cart__product-qtt">
                                        <div class="cart__order-number">
                                            <button class="cart__btn-decrease-qtt">
                                                <i class="fa-sharp fa-solid fa-minus"></i>
                                            </button>
                                            <input class="cart__input-qtt" type="text" name="quantity" id="quantity" value="<?php echo $product['qtt'] ?>" maxvalue="999" minvalue="1" placeholder="Số lượng">
                                            <button class="cart__btn-increase-qtt">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="cart__points-to-money">
                                        <span class="points-to-money"><?php echo ($product['price'] * $product['qtt']); ?></span>
                                        <span> đ</span>
                                    </td>
                                    <td class="cart__action-user">
                                        <button class="cart__btn-delete">
                                            <i class="fa-solid fa-trash cart__action-icon"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php
                                $totalMoney = $totalMoney + ($product['price'] * $product['qtt']);
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="cart__infor-user">
                        <h1 class="cart__header">Thông tin giao hàng</h1>
                        <form action="/book/controllers/UserController.php?action=pay" method="post" class="cart__form" id="form-infor-user">
                            <div class="cart__group">
                                <label for="" class="cart__title">Họ và Tên</label>
                                <input type="text" name="fullname" class="input" value="<?php echo (isset($_SESSION['user']['username'])) ? $account['fullname'] : '' ?>" placeholder="Nhập họ và tên">
                            </div>
                            <div class="cart__group">
                                <label for="" class="cart__title">Số điện thoại</label>
                                <input type="text" name="phonenumber" class="input" value="<?php echo (isset($_SESSION['user']['username'])) ? $account['phonenumber'] : '' ?>" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="cart__group">
                                <label for="" class="cart__title">Địa chỉ</label>
                                <input type="text" name="address" class="input" value="<?php echo (isset($_SESSION['user']['username'])) ? $account['address'] : '' ?>" placeholder="Nhập địa chỉ nhận hàng">
                            </div>
                        </form>
                    </div>
                    <div class="cart__pay">
                        <div class="cart__content-pay">
                            <p class="cart__title-pay">Tổng số tiền: </p>
                            <p class="cart__money-total" id="money-total"><?php echo $totalMoney; ?></p>
                            <span class="cart__money-total-span"> đ</span>
                        </div>
                        <button class="btn cart__pay-btn" id="pay-btn">THANH TOÁN</button>
                    </div>
                </div>
            </div>
            <?php
            require_once('../web/footer.php');
            ?>
        </div>
        <script>
            var productItem = document.querySelectorAll('.cart__product-item');
            var moneyTotal = document.getElementById('money-total');
            function updateTotalMoney() {
                var totalMoney = 0;
                productItem.forEach(function(product) {
                    let productPrice = parseInt(product.children[1].children[1].children[1].innerHTML);
                    let numberInputQtt = parseInt(product.children[2].children[0].children[1].value);
                    totalMoney = totalMoney + (productPrice * numberInputQtt);
                })
                moneyTotal.innerHTML = totalMoney;
            }
            
            productItem.forEach(function(product) {
                var index = parseInt(product.children[0].value);
                var productPrice = parseInt(product.children[1].children[1].children[1].innerHTML);
                var btnDecrease = product.children[2].children[0].children[0];
                var inputQtt = product.children[2].children[0].children[1];
                var btnIncrease = product.children[2].children[0].children[2];
                var pointsToMoney = product.children[3].children[0];
                var btnDelete = product.children[4].children[0];

                btnDecrease.onclick = function() {
                    var numberInputQtt = parseInt(inputQtt.value);
                    if (numberInputQtt - 1 <= 0) {
                        numberInputQtt = 1;
                    } else {
                        numberInputQtt = numberInputQtt - 1;
                    }
                    inputQtt.value = numberInputQtt;
                    pointsToMoney.innerHTML = numberInputQtt * productPrice;
                    updateTotalMoney();
                }

                btnIncrease.onclick = function() {
                    var numberInputQtt = parseInt(inputQtt.value);
                    numberInputQtt = numberInputQtt + 1;
                    inputQtt.value = numberInputQtt;
                    pointsToMoney.innerHTML = numberInputQtt * productPrice;
                    updateTotalMoney();
                }

                inputQtt.onchange = function() {
                    if (parseInt(inputQtt.value) <= 0) {
                        inputQtt.value = 1;
                    }
                    if (isNaN(inputQtt.value)) {
                        inputQtt.value = 1;
                    }
                    pointsToMoney.innerHTML = parseInt(inputQtt.value) * productPrice;
                    updateTotalMoney();
                }

                btnDelete.onclick = function() {
                    window.location.href = `/book/controllers/UserController.php?action=removeProductCart&index=${index}`;
                }
            })

            var formInforUser = document.getElementById('form-infor-user');
            var payBtn = document.getElementById('pay-btn');
            payBtn.onclick = function() {
                formInforUser.submit();
            }
        </script>
    </body>
</html>