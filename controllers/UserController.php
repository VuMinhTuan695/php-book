<?php
require_once('../models/model.php');
session_start();
$data = array();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action) {
            case 'removeProductCart':
                if (isset($_GET['index'])) {
                    unset($_SESSION['cart'][$_GET['index']]);
                    header("Refresh: 0.01; /book/views/user/cart.php", true, 303);
                }
                break;
            case 'donePay':
                unset($_SESSION['cart']);
                header("Refresh: 0.01; /book/index.php", true, 303);
                break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action) {
            case 'insert':
                    if (empty($_POST['username-register']) || empty($_POST['password-register']) || empty($_POST['re-password-register'])) {
                        echo "<script> alert('Các trường thông tin đăng ký không được để trống'); </script>";
                        header("Refresh: 0.1; /book/views/user/register.php", true, 303);
                        break;
                    }

                    if (isset($_POST['username-register']) && isset($_POST['password-register'])) {
                    $usernameregister = $_POST['username-register'];
                    $passwordregister = $_POST['password-register'];
                    $repasswordregister = $_POST['re-password-register'];

                    if ($passwordregister != $repasswordregister) {
                        echo "<script> alert('Mật khẩu phải trùng với mật khẩu nhập lại'); </script>";
                        header("Refresh: 0.1; /book/views/user/register.php", true, 303);
                    } else {
                        $user['username'] = $usernameregister;
                        $user['password'] = $passwordregister;
        
                        if (getByUsername('user', $usernameregister)) {
                            echo "<script> alert('Tài khoản $usernameregister đã tồn tại trong hệ thống'); </script>";
                            header("Refresh: 0.1; /book/views/user/register.php", true, 303);
                            break;
                        }
        
                        if (insert('user', $user)) {
                            echo "<script> alert('Tạo tài khoản thành công'); </script>";
                            header("Refresh: 0.1; /book/views/user/login.php", true, 303);
                        } else {
                            echo "<script> alert('Tạo tài khoản thất bại'); </script>";
                            header("Refresh: 0.1; /book/views/user/register.php", true, 303);
                        }
                    }
                }
                break;

            case 'adminDataInsert':
                if (empty($_POST['username-register']) || empty($_POST['password-register'])) {
                    echo "<script> alert('Tài khoản hoặc mật khẩu không được để trống'); </script>";
                    header("Refresh: 0.1; /book/views/admin/register.php", true, 303);
                    break;
                }

                if (isset($_POST['username-register']) && isset($_POST['password-register']) && isset($_POST['re-password-register'])) {
                    $usernameregister = $_POST['username-register'];
                    $passwordregister = $_POST['password-register'];
                    $repasswordregister = $_POST['re-password-register'];
                    
                    if ($passwordregister != $repasswordregister) {
                        echo "<script> alert('Mật khẩu phải trùng với mật khẩu nhập lại'); </script>";
                        header("Refresh: 0.1; /book/views/admin/register.php", true, 303);
                    } else {
                        $admin['username'] = $usernameregister;
                        $admin['password'] = $passwordregister;
        
                        if (getByUsername('admin', $usernameregister)) {
                            echo "<script> alert('Tài khoản $usernameregister đã tồn tại trong hệ thống'); </script>";
                            header("Refresh: 0.1; /book/views/admin/register.php", true, 303);
                            break;
                        }
        
                        if (insert('admin', $admin)) {
                            echo "<script> alert('Tạo tài khoản thành công'); </script>";
                            header("Refresh: 0.1; /book/views/admin/login.php", true, 303);
                        } else {
                            echo "<script> alert('Tạo tài khoản thất bại'); </script>";
                            header("Refresh: 0.1; /book/views/admin/register.php", true, 303);
                        }
                    }
                }
                break;

            case 'adminDataGet':
                if (empty($_POST['username-login']) || empty($_POST['password-login'])) {
                    echo "<script> alert('Tài khoản hoặc mật khẩu không được để trống'); </script>";
                    header("Refresh: 0.1; /book/views/admin/login.php", true, 303);
                    break;
                }

                if (isset($_POST['username-login']) && isset($_POST['password-login'])) {
                    $usernamelogin = $_POST['username-login'];
                    $passwordlogin = $_POST['password-login'];
        
                    if (getAccount('admin', $usernamelogin, $passwordlogin)) {
                        $_SESSION['admin']['username'] = $usernamelogin;
                        echo "<script> alert('Đăng nhập thành công'); </script>";
                        header("Refresh: 0.1; /book/views/admin/index.php", true, 303);
                    } else {
                        echo "<script> alert('Tài khoản hoặc mật khẩu nhập chưa đúng'); </script>";
                        header("Refresh: 0.1; /book/views/admin/login.php", true, 303);
                    }
                }
                break;

            case 'getuser':
                if (empty($_POST['username-login']) || empty($_POST['password-login'])) {
                    echo "<script> alert('Tài khoản hoặc mật khẩu không được để trống'); </script>";
                    header("Refresh: 0.1; /book/views/user/login.php", true, 303);
                    break;
                }

                if (isset($_POST['username-login']) && isset($_POST['password-login'])) {
                    $usernameLogin = $_POST['username-login'];
                    $passwordLogin = $_POST['password-login'];

                    if (getAccount('user', $usernameLogin, $passwordLogin)) {
                        $_SESSION['user']['username'] = $usernameLogin;
                        echo "<script> alert('Đăng nhập thành công'); </script>";
                        header("Refresh: 0.1; /book/index.php", true, 303);
                    } else {
                        echo "<script> alert('Tài khoản hoặc mật khẩu nhập chưa đúng'); </script>";
                        header("Refresh: 0.1; /book/views/user/login.php", true, 303);
                    }
                }
                break;
            
            case 'changepassword':
                if (empty($_POST['username'])) {
                    echo "<script> alert('Bạn chưa truyền tham số username để đổi mật khẩu'); </script>";
                    header("Refresh: 0.01; /book/index.php", true, 303);
                } else {
                    if (empty($_POST['old-password']) || empty($_POST['new-password'])) {
                        echo "<script> alert('Mật khẩu cũ hoặc mật khẩu mới không được để trống'); </script>";
                    } else {
                        $username = $_POST['username'];
                        $oldPassword = $_POST['old-password'];
                        $newPassword = $_POST['new-password'];
                        if (!getAccount('user', $username, $oldPassword)) {
                            echo "<script> alert('Mật khẩu cũ nhập chưa đúng'); </script>";
                            header("Refresh: 0.01; /book/views/user/changepassword.php?username=$username", true, 303);
                            return;
                        }
                        if (updateAccount('user', $username, $newPassword)) {
                            echo "<script> alert('Thay đổi mật khẩu thành công'); </script>";
                            header("Refresh: 0.01; /book/index.php", true, 303);
                        } else {
                            echo "<script> alert('Thay đổi mật khẩu thất bại'); </script>";
                            header("Refresh: 0.01; /book/views/user/changepassword.php?username=$username", true, 303);
                        }
                    }
                }
                break;

            case 'changepasswordAdmin':
                if (empty($_POST['username'])) {
                    echo "<script> alert('Bạn chưa truyền tham số username để đổi mật khẩu'); </script>";
                    header("Refresh: 0.01; /book/views/admin/index.php", true, 303);
                } else {
                    if (empty($_POST['old-password']) || empty($_POST['new-password'])) {
                        echo "<script> alert('Mật khẩu cũ hoặc mật khẩu mới không được để trống'); </script>";
                    } else {
                        $username = $_POST['username'];
                        $oldPassword = $_POST['old-password'];
                        $newPassword = $_POST['new-password'];
                        if (!getAccount('admin', $username, $oldPassword)) {
                            echo "<script> alert('Mật khẩu cũ nhập chưa đúng'); </script>";
                            header("Refresh: 0.01; /book/views/admin/changepassword.php?username=$username", true, 303);
                            return;
                        }
                        if (updateAccount('admin', $username, $newPassword)) {
                            echo "<script> alert('Thay đổi mật khẩu thành công'); </script>";
                            header("Refresh: 0.01; /book/views/admin/index.php", true, 303);
                        } else {
                            echo "<script> alert('Thay đổi mật khẩu thất bại'); </script>";
                            header("Refresh: 0.01; /book/views/admin/changepassword.php?username=$username", true, 303);
                        }
                    }
                }
                break;

            case 'addToCart':
                if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['image']) && isset($_POST['qtt']) && isset($_POST['price'])) {
                    $product['id'] = $_POST['id'];
                    $product['name'] = $_POST['name'];
                    $product['image'] = $_POST['image'];
                    $product['qtt'] = $_POST['qtt'];
                    $product['price'] = $_POST['price'];

                    array_push($_SESSION['cart'], $product);
                    header("Refresh: 0.01; /book/views/user/cart.php", true, 303);
                } else {
                    echo "<script> alert('Bạn chưa truyền đủ thông tin sản phẩm để thêm vào giỏ hàng'); </script>";
                    header("Refresh: 0.01; /book/index.php", true, 303);
                }
                break;

            case 'updateInfor':
                if (empty($_POST['username'])) {
                    echo "<script> alert('Bạn chưa truyền tham số username để cập nhật thông tin'); </script>";
                    header("Refresh: 0.01; /book/views/user/infor.php", true, 303);
                    break;
                }

                if (isset($_POST['fullname']) && isset($_POST['phonenumber']) && isset($_POST['address'])) {
                    if (updateUserInfor('user', $_POST['username'], $_POST['fullname'], $_POST['phonenumber'], $_POST['address'])) {
                        echo "<script> alert('Cập nhật thông tin thành công'); </script>";
                        header("Refresh: 0.01; /book/views/user/infor.php", true, 303);
                        break;
                    }
                }

                echo "<script> alert('Cập nhật thông tin thất bại'); </script>";
                header("Refresh: 0.01; /book/views/user/infor.php", true, 303);
                break;
            
            case 'pay':
                if (empty($_POST['fullname']) || empty($_POST['phonenumber']) || empty($_POST['address'])) {
                    echo "<script> alert('Bạn cần nhập đầy đủ thông tin giao hàng'); </script>";
                    header("Refresh: 0.01; /book/views/user/cart.php", true, 303);
                } else {
                    header("Refresh: 0.01; /book/views/user/pay.php", true, 303);
                }
                break;
        }
    }
}
?>