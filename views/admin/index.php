<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="/book/css/admin/header.css">
        <link rel="stylesheet" href="/book/css/admin/base.css">
        <link rel="stylesheet" href="/book/css/admin/index.css">
    </head>
    <body>
        <div class="app">
            <?php
            require_once('header.php');
            require_once('../../config/db.php');
            $conn = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
            if ($conn->connect_error) {
                echo "Lỗi kết nối đến cơ sở dữ liệu! <br>";
                die("Connection database failed: " . $conn->connect_error);
                return;
            }

            $sql = "SELECT * FROM product ORDER BY id DESC";
            $rs = mysqli_query($conn, $sql);

            if (empty($_SESSION['admin']['username'])) {
                echo "<script> alert('Quý khách vui lòng đăng nhập vào hệ thống'); </script>";
                header("Refresh: 0.01; /book/views/admin/login.php", true, 303);
            }
            ?>
            <div class="product-manager">
                <div class="product-manager__heading">
                    <h1>Quản lý sản phẩm</h1>
                </div>
                <?php
                if ($rs->num_rows <= 0) {
                    ?>
                    <div class="list-product__empty">
                        <span class="list-product__empty-heading">Danh sách sản phẩm rỗng.</span>
                        <a href="/book/views/admin/addProduct.php" class="list-product__addproduct-link">Tạo sản phẩm</a>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="list-product__addproduct">
                        <a href="/book/views/admin/addProduct.php" class="list-product__addproduct-link">Tạo mới sản phẩm</a>
                    </div>
                    <table class="table-list-product">
                        <tr class="table-list-product__header">
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Tác giả</th>
                            <th>Số trang</th>
                            <th>Nhà xuất bản</th>
                            <th>Nhà cung cấp</th>

                            <th>Số lượng</th>

                            <th>Hành động</th>
                        </tr>
                        <?php
                        $STT = 1;
                        while($product = $rs->fetch_assoc()) {
                            ?>
                            <tr>
                                <td class="list-product__stt">
                                    <?php echo $STT; ?>
                                </td>
                                <td class="list-product__name">
                                    <?php echo $product['name']; ?>
                                </td>
                                <td class="list-product__image">
                                    <img src="/book/image/product/<?php echo $product['image']; ?>" alt="Ảnh sản phẩm">
                                </td>
                                <td class="list-product__price">
                                    <?php echo $product['price']; ?>
                                </td>
                                <td class="list-product__author">
                                    <?php echo $product['author']; ?>
                                </td>
                                <td class="list-product__pagenumber">
                                    <?php echo $product['pagenumber']; ?>
                                </td>
                                <td class="list-product__publisher">
                                    <?php echo $product['publisher']; ?>
                                </td>
                                <td class="list-product__supplier">
                                    <?php echo $product['supplier']; ?>
                                </td>

                                <td class="list-product__supplier">
                                    <?php echo $product['qtt']; ?>
                                </td>
                            
                                <td class="list-product__list-action">
                                    <div class="list-product__action">
                                        <a href="/book/views/admin/updateProduct.php?id=<?php echo $product['id']; ?>" class="list-product__update-product">Sửa</a>
                                        <button class="btn" type="button" onclick="confirmDeleteProduct(<?php echo $product['id']; ?>)">Xóa</button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $STT++;
                        }
                        ?>
                    </table>
                    <?php
                }
                ?>
            </div>
        </div>
        <script>
            function confirmDeleteProduct(id){
                if(confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")){
                    window.location= "/book/controllers/ProductController.php?action=deleteProduct&id=" + id;
                }
            }
        </script>
    </body>
</html>