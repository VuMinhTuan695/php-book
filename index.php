<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="/book/css/web/header.css">
    <link rel="stylesheet" href="/book/css/web/footer.css">
    <link rel="stylesheet" href="/book/css/web/base.css">
    <link rel="stylesheet" href="/book/css/web/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="app">
        <?php
        require_once('views/web/header.php');
        require_once('config/db.php');

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        
        $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
        if ($conn->connect_error) {
            echo "Lỗi kết nối đến cơ sở dữ liệu! <br>";
            die("Connection database failed: " . $conn->connect_error);
            return;
        }

        $sql = "SELECT * FROM product ORDER BY id DESC";
        $rs = mysqli_query($conn, $sql);

        function showListProduct($products) {
            foreach($products as $product) {
                ?>
                <div class="product-list__product">
                    <a class="product-list__product-link" href="/book/controllers/ProductController.php?action=productDetail&id=<?php echo $product['id']; ?>">
                        <img class="product-list__product-img" src="/book/image/product/<?php echo $product['image'] ?>" alt="<?php echo $product['image'] ?>">
                        <p class="product-list__product-name"><?php echo $product['name'] ?></p>
                    </a>
                    <div class="product-list__product-price">
                        <span><?php echo $product['price'] ?> đ</span>
                    </div>
                    <div class="product-list__user-action">
                        <form action="/book/controllers/UserController.php?action=addToCart" method="post">
                            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                            <input type="hidden" name="name" value="<?php echo $product['name'] ?>">
                            <input type="hidden" name="image" value="<?php echo $product['image'] ?>">
                            <input type="hidden" name="qtt" value="1">
                            <input type="hidden" name="price" value="<?php echo $product['price'] ?>">
                            <button type="submit" class="product-list__btn-add-to-cart">
                                <span>Thêm giỏ hàng</span>
                            </button>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="container">
            <div class="product-list">
                <?php
                if ($rs->num_rows <= 0) {
                ?>
                <div class="product-list__empty">
                    <span class="product-list__empty-heading">Không có sản phẩm nào để hiển thị!</span>
                </div>
                <?php
                } else {
                    if (isset($_SESSION['list-product-search'])) {
                        showListProduct($_SESSION['list-product-search']);
                        unset($_SESSION['list-product-search']);
                    } else {
                        showListProduct($rs);
                    }
                }
                ?>
            </div>
        </div>

        <?php require_once('views/web/footer.php') ?>
    </div>
</body>

</html>