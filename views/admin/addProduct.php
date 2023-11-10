<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/book/css/admin/header.css">
        <link rel="stylesheet" href="/book/css/admin/base.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <div class="app">
            <?php
            require_once('header.php');
            if (!isset($_SESSION['admin']['username'])) {
                echo "<script> alert('Bạn chưa đăng nhập vào hệ thống'); </script>";
                header("Refresh: 0.01; /book/views/admin/login.php", true, 303);
            } else {
                ?>
                <div class="product">
                    <div class="back-to-manager-product">
                        <i class="fa-solid fa-arrow-left back-to-manager-product__icon"></i>
                        <a href="/book/views/admin/index.php" class="back-to-manager-product__link">Trở về trang quản lý</a>
                    </div>
                    <div class="product__heading">
                        <h1>Tạo mới sản phẩm</h1>
                    </div>
                    <div class="product__content">
                        <form action="/book/controllers/ProductController.php?action=inbbsertDataProduct" method="post" class="product__form" enctype="multipart/form-data">
                            <div class="product__group">
                                <label class="product__label" for="name">Tên sản phẩm</label>
                                <input class="product__input" type="text" name="name" id="name" placeholder="Nhập tên sản phẩm">
                            </div>

                            <div class="product__group">
                                <label class="product__label" for="description">Mô tả sản phẩm</label>
                                <textarea class="product__input" name="description" id="description" cols="30" rows="10" placeholder="Nhập mô tả sản phẩm"></textarea>
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="image">Hình ảnh</label>
                                <input class="product__input" type="file" name="image" id="image">
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="price">Giá sản phẩm</label>
                                <input class="product__input" type="text" name="price" id="price" placeholder="Nhập giá sản phẩm">
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="author">Tên tác giả</label>
                                <input class="product__input" type="text" name="author" id="author" placeholder="Nhập tên tác giả">
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="pagenumber">Số trang sách</label>
                                <input class="product__input" type="text" name="pagenumber" id="pagenumber" placeholder="Nhập số trang sách">
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="publisher">Nhà xuất bản</label>
                                <input class="product__input" type="text" name="publisher" id="publisher" placeholder="Nhập tên nhà xuất bản">
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="supplier">Nhà cung cấp</label>
                                <input class="product__input" type="text" name="supplier" id="supplier" placeholder="Nhập tên nhà cung cấp">
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="weight">Trọng lượng</label>
                                <input class="product__input" type="text" name="weight" id="weight" placeholder="Nhập trọng lượng sản phẩm">
                            </div>
                            <div class="product__group">
                                <label class="product__label" for="qtt">Số lượng</label>
                                <input class="product__input" type="text" name="qtt" id="qtt" placeholder="Nhập số lượng sản phẩm">
                            </div>
                            <div class="product__action">
                                <button class="btn" type="submit">Thêm sản phẩm</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
</html>