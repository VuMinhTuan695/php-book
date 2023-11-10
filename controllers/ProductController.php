<?php
require_once('../models/model.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET["action"])) {
        $action = $_GET['action'];
        switch ($action) {
            //......thêm sản phẩm
            case 'insertDataProduct':
                //isset là kiểm tra biến tồn tại hay không
                //$_post là 1 biến khi 1 form có phương thức post
                if (isset($_POST['name']) && $_POST['name'] != "" &&
                    isset($_POST['description']) && $_POST['description'] != "" &&
                    isset($_POST['price']) && $_POST['price'] != "" &&
                    isset($_POST['author']) && $_POST['author'] != "" &&
                    isset($_POST['pagenumber']) && $_POST['pagenumber'] != "" &&
                    isset($_POST['publisher']) && $_POST['publisher'] != "" &&
                    isset($_POST['supplier']) && $_POST['supplier'] != "" &&

                    isset($_POST['qtt']) && $_POST['qtt'] != "" &&

                    isset($_POST['weight']) && $_POST['weight'] != "" ) {
//$product là mảng chứa các trường thông tin của sản phẩm
                    $product['name'] = $_POST['name'];
                    $product['description'] = $_POST['description'];
                    $product['price'] = ($_POST['price']) ?? 0;
                    $product['author'] = $_POST['author'];
                    $product['pagenumber'] = ($_POST['pagenumber']) ?? 0;
                    $product['publisher'] = $_POST['publisher'];
                    $product['supplier'] = $_POST['supplier'];

                    $product['qtt'] = $_POST['qtt'];


                    $product['weight'] = ($_POST['weight']) ?? 0;

                    $uploadDir = '../image/product/';
                    $product['image'] = "";
    //..........              
                    if (!empty($_FILES['image']['name'])) {
                        $file = $_FILES['image'];
                        $newname =  $file['name'];
                        $uploadPath = $uploadDir . $newname;
//..
                        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                            $product['image'] = $newname;
                        }
                        //..
                    } else {
                        echo "<script> alert('Bạn chưa chọn hình ảnh'); </script>";
                        header("Refresh: 0.01; /book/views/admin/addProduct.php", true, 303);
                        break;
                        //...........
                    }
                    if (insert('product', $product)) {
                        echo "<script> alert('Thêm sản phẩm mới thành công'); </script>";
                    } else {
                        echo "<script> alert('Thêm sản phẩm mới thất bại'); </script>";
                    }
                    header("Refresh: 0.01; /book/views/admin/index.php", true, 303);
                } else {
                    echo "<script> alert('Các trường thông tin sản phẩm không được để trống'); </script>";
                    header("Refresh: 0.01; /book/views/admin/addProduct.php", true, 303);
                }
                break;
            case 'updateDataProduct':
                if (isset($_POST['name']) && $_POST['name'] != "" &&
                    isset($_POST['description']) && $_POST['description'] != "" &&
                    isset($_POST['price']) && $_POST['price'] != "" &&
                    isset($_POST['author']) && $_POST['author'] != "" &&
                    isset($_POST['pagenumber']) && $_POST['pagenumber'] != "" &&
                    isset($_POST['publisher']) && $_POST['publisher'] != "" &&
                    isset($_POST['supplier']) && $_POST['supplier'] != "" &&
                    isset($_POST['weight']) && $_POST['weight'] != "" ) {
                    
                    $product['id'] = $_POST['id'];
                    $product['name'] = $_POST['name'];
                    
                    $product['description'] = $_POST['description'];
                    $product['price'] = ($_POST['price']) ?? 0;
                    $product['author'] = $_POST['author'];
                    $product['pagenumber'] = ($_POST['pagenumber']) ?? 0;
                    $product['publisher'] = $_POST['publisher'];
                    $product['supplier'] = $_POST['supplier'];
                    $product['weight'] = ($_POST['weight']) ?? 0;
                    $product['qtt'] = ($_POST['qtt']) ?? 0;
                    
                    $uploadDir = '../image/product/';
                    $product['image'] = "";
                    if (!empty($_FILES['image']['name'])) {
                        $file = $_FILES['image'];
                        $newname =  $file['name'];
                        $uploadPath = $uploadDir . $newname;
                        
                        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                            $product['image'] = $newname;
                        }
                    } else {
                        $product['image'] = $_POST['old_image'];
                    }
                    if (update('product', $product)) {
                        echo "<script> alert('Chỉnh sửa thông tin sản phẩm thành công'); </script>";
                    } else {
                        echo "<script> alert('Chỉnh sửa thông tin sản phẩm thất bại'); </script>";
                    }
                    header("Refresh: 0.01; /book/views/admin/index.php", true, 303);
                } else {
                    echo "<script> alert('Các trường thông tin sản phẩm không được để trống'); </script>";
                    header("Refresh: 0.01; /book/views/admin/updateProduct.php", true, 303);
                }
                break;
           
            case 'productSearch':
                if (isset($_POST['datasearch'])) {
                    $dataSearch = $_POST['datasearch'];
                    if (getProductByParam('product', $dataSearch)) {
                        $products = getProductByParam('product', $dataSearch);
                        $_SESSION['list-product-search'] = $products;
                    } else {
                        $_SESSION['list-product-search'] = null;
                    }
                    header("Refresh: 0.01; /book/index.php", true, 303);
                }
                break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["action"])) {
        $action = $_GET['action'];
        switch($action) {
            case 'deleteProduct':
                if (!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    if (delete('product', $id)) {
                        echo "<script> alert('Xóa thông tin sản phẩm thành công'); </script>";
                        header("Refresh: 0.01; /book/views/admin/index.php", true, 303);
                    } else {
                        echo "<script> alert('Xóa thông tin sản phẩm thất bại'); </script>";
                        header("Refresh: 0.01; /book/views/admin/index.php", true, 303);
                    }
                } else {
                    echo "<script> alert('Bạn chưa truyền id sản phẩm để xóa'); </script>";
                    header("Refresh: 0.01; /book/views/admin/index.php", true, 303);
                }
                break;

            case 'productDetail':
                if (!empty($_GET['id'])) {
                    $id = $_GET['id'];
                    if (getById('product', $id)) {
                        $_SESSION['productDetail'] = getById('product', $id);
                        header("Refresh: 0.01; /book/views/product/index.php", true, 303);
                    } else {
                        echo "<script> alert('Thông tin sản phẩm không tồn tại'); </script>";
                        header("Refresh: 0.01; /book/index.php", true, 303);
                    }
                } else {
                    echo "<script> alert('Bạn chưa truyền id sản phẩm để xem thông tin chi tiết sản phẩm'); </script>";
                    header("Refresh: 0.01; /book/index.php", true, 303);
                }
                break;
        }
    }
}
?>