<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/book/css/web/header.css">
    <link rel="stylesheet" href="/book/css/web/footer.css">
    <link rel="stylesheet" href="/book/css/web/base.css">
    <link rel="stylesheet" href="/book/css/product/detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="app">
        <?php
        require_once('../../config/db.php');
        $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
        if ($conn->connect_error) {
            die("Connection database failed: " . $conn->connect_error);
            return;
        }
        require_once('../web/header.php');
            $id = $_SESSION['productDetail']['id'];
            $sql = "SELECT * FROM product WHERE id = $id";
            $rs = mysqli_query($conn, $sql);
            if ($rs->num_rows > 0) {
            $product = $rs->fetch_assoc();
            ?>
            <div class="product">
                <img class="product__image" src="/book/image/product/<?php echo $product['image']; ?>" alt="<?php echo $product['price']; ?>">
                <div class="product__content">
                    <div class="product__name">
                        <p><?php echo $product['name']; ?></p>
                    </div>
                    <div class="product__infor">
                        <div class="product__infor-item">
                            <span class="product__infor-title">Nhà cung cấp:</span>
                            <span class="product__supplier-name"><?php echo $product['supplier']; ?></span>
                        </div>
                        <div class="product__infor-item">
                            <span class="product__infor-title">Nhà xuất bản:</span>
                            <span class="product__publisher-name"><?php echo $product['publisher']; ?></span>
                        </div>
                        <div class="product__infor-item">
                            <span class="product__infor-title">Tác giả:</span>
                            <span class="product__author-name"><?php echo $product['author']; ?></span>
                        </div>
                    </div>
                    <div class="product__price">
                        <span><?php echo $product['price']; ?> đ</span>
                    </div>
                    <div class="product__order-number">
                        <span class="product__order-number-title">Số lượng:</span>
                        <div class="product__order-number-box">
                            <button class="product__btn-decrease-qtt" id="btnDecrease">
                                <i class="fa-sharp fa-solid fa-minus"></i>
                            </button>
                            <input class="product__input-qtt" id="inputQtt" type="text" name="quantity" id="quantity" align="center" value="1" maxvalue="999" minvalue="1" placeholder="quantity">
                            <button class="product__btn-increase-qtt" id="btnIncrease">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product__action-user">
                        <form action="/book/controllers/UserController.php?action=addToCart" method="post" id="formHiddenSubmit">
                            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                            <input type="hidden" name="name" value="<?php echo $product['name'] ?>">
                            <input type="hidden" name="image" value="<?php echo $product['image'] ?>">
                            <input type="hidden" name="qtt" value="1" id="inputQttSubmit">
                            <input type="hidden" name="price" value="<?php echo $product['price'] ?>">
                            <?php
                            if ($product['qtt'] == 0) {
                                ?>
                                <span>Sold Out</span>
                                <?php
                                return;
                            }
                            ?>
                            <button class="product__add-cart" id="btn-submit">
                                <span>Thêm vào giỏ hàng</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="product-detail">
                <h3 class="product-detail__heading">Thông tin sản phẩm</h3>
                <table class="product-detail__content">
                    <tbody>
                        <tr>
                            <td class="product-detail__title">Tên nhà cung cấp</td>
                            <td class="product-detail__content-product"><?php echo $product['supplier'] ?></td>
                        </tr>
                        <tr>
                            <td class="product-detail__title">Tác giả</td>
                            <td class="product-detail__content-product"><?php echo $product['author'] ?></td>
                        </tr>
                        <tr>
                            <td class="product-detail__title">Nhà xuất bản</td>
                            <td class="product-detail__content-product"><?php echo $product['publisher'] ?></td>
                        </tr>
                        <tr>
                            <td class="product-detail__title">Trọng lượng</td>
                            <td class="product-detail__content-product"><?php echo $product['weight'] ?></td>
                        </tr>
                        <tr>
                            <td class="product-detail__title">Số trang</td>
                            <td class="product-detail__content-product"><?php echo $product['pagenumber'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <p class="product-detaill__description"><?php echo $product['description'] ?></p>
            </div>
            <?php
        }
        ?>
        <?php
        require_once('../web/footer.php');
        ?>
    </div>
    <script>
        var btnDecrease = document.getElementById('btnDecrease');
        var btnIncrease = document.getElementById('btnIncrease');
        var inputQtt = document.getElementById('inputQtt');
        var btnSubmit = document.getElementById('btn-submit');
        var inputQttSubmit = document.getElementById('inputQttSubmit');

        btnDecrease.onclick = function() {
            var numberInputQtt = parseInt(inputQtt.value);
            if (numberInputQtt - 1 <= 0) {
                numberInputQtt = 1;
            } else {
                numberInputQtt = numberInputQtt - 1;
            }
            inputQtt.value = numberInputQtt;
        }

        btnIncrease.onclick = function() {
            var numberInputQtt = parseInt(inputQtt.value);
            numberInputQtt = numberInputQtt + 1;
            inputQtt.value = numberInputQtt;
        }

        inputQtt.onchange = function() {
            if (parseInt(inputQtt.value) <= 0) {
                inputQtt.value = 1;
            }
            if (isNaN(inputQtt.value)) {
                inputQtt.value = 1;
            }
        }

        btnSubmit.onclick = function() {
            $valueInput = parseInt(inputQtt.value);
            inputQttSubmit.value = $valueInput;
            document.getElementById("formHiddenSubmit").submit();
        }
    </script>
    unset($_SESSION['productDetail']);
</body>

</html>