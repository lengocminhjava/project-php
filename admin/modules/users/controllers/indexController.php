<?php
function construct()
{
    //echo "DÙng chung, load đầu tiên";
    load('helper', 'login');
    load('lib', 'email');
    load_model('index');
}
function indexAction()
{
    $list_users = get_list_users();
    //    show_array($list_users);
    $data['list_users'] = $list_users;
    load_view('index', $data);
}
function loginAction()
{
    // echo time();
    global $username, $password, $error, $success;
    if (isset($_POST['btn-login'])) {
        $error = array();
        #Kiem tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Bạn cần nhập thông tin";
        } else {
            if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
                $error['username'] = "Bạn nhập chưa đúng ";
            } else {
                $partten = "/^()[A-Za-z0-9_\.]{6,32}$/";
                if (!preg_match($partten, $_POST['username'], $matchs)) {
                    $error['username'] = "Bạn nhập sai định dạng";
                } else
                    $username = $_POST['username'];
            }
        }
        if (empty($_POST['password'])) {

            $error['password'] = "Không được để trống mật khẩu";
        } else {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "Bạn nhập chưa đúng ";
            } else {
                $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if (!preg_match($partten, $_POST['password'], $matchs)) {
                    $error['password'] = "Bạn nhập sai định dạng";
                } else
                    $password = md5($_POST['password']);
            }
        }
        # kết luận 
        if (empty($error)) {

            if (check_username($username, $password)) {
                $check = check_is_active($username, $password);
                // show_array($check);
                if ($check['is_active'] ==  1) {
                    $_SESSION['is_login'] = true;
                    $_SESSION['user_login'] = $username;
                    redirect();
                } else {
                    $error['account'] = "Chưa kích hoạt tài khoản vui lòng check email để kích hoạt";
                }
            } else
                $error['account'] = "Tên đăng nhập và mật khẩu không tồn tại";
            // show_array($is_active);
        }
    }
    load_view('login');
}
function resetAction()
{
    global $error, $email, $success;
    if (isset($_POST['btn-reset'])) {
        $error = array();
        //email
        if (empty($_POST['email'])) {
            $error['email'] = "Bạn cần nhập thông tin";
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "Bạn nhập sai định dạng";
            } else
                $email = $_POST['email'];
        }
        #Kiem tra username
        # kết luận 
        if (empty($error)) {
            if (check_new_email($email)) {
                $reset_token = md5($email . time());
                $data = array(
                    'reset_token' => $reset_token
                );
                update_token($data, $email);
                $link_back = base_url("?mod=users&&controllers=index&&action=newpass&&reset_token={$reset_token}");
                $content = "if registered account then you come back home <a href = '$link_back'> Home page </a> ";
                send_mail($email, 'change password', 'Iam Minh , I am from Thanh Hóa province', $content);
                $success['email'] = "Đã gửi email thành công vui lòng check email để lấy lại mật khẩu";
            } else {
                $error['account'] = "Email không tồn tại trên hệ thống";
            }
        }
    }
    load_view('reset');
}
function newpassAction()
{

    global $error, $password;
    if (isset($_POST['btn-newpass'])) {
        $error = array();
        //email
        if (empty($_POST['password'])) {
            $error['password'] = "Bạn cần nhập thông tin";
        } else {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "Bạn nhập chưa đúng ";
            } else {
                $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if (!preg_match($partten, $_POST['password'], $matchs)) {
                    $error['password'] = "Bạn nhập sai định dạng";
                } else
                    $password = md5($_POST['password']);
            }
        }
        #Kiem tra username
        # kết luận 
        if (empty($error)) {
            $reset_token = $_GET['reset_token'];
            if (check_new_reset_token($reset_token)) {
                $data = array(
                    'password' => $password
                );
                update_new_pass($data, $reset_token);
                redirect("?mod=users&&controllers=index&action=resetyes");
            } else {
                $error['account'] = "Không tồn tại trang này";
            }
        }
    }

    load_view('newpass');
}
function resetyesAction()
{

    load_view('resetyes');
}

function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect('?mod=users&controller=index&action=login');
}
function accountAction()
{
    $info_user = get_user_by_username(user_login());
    $id = (int) $info_user['id'];
    load('helper', 'upload_image');
    global $error, $fullname, $email, $phone_number, $thumbnail, $position, $address, $success, $thumbnail, $type, $size;
    if (isset($_POST['btn_account'])) {
        $error = array();
        $success = array();
        // echo 'hello';
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không bỏ trống trường này";
        } else {
            $fullname = $_POST['fullname'];
        }
        // if (empty($POST['username'])) {
        //     $error['username'] = "Không được bỏ trống tên đăng nhập";
        // } else {
        // if (!is_username($POST['username'])) {

        //         $username = $POST['username'];
        //     } else {
        //         $error['username'] = "Cần nhập đúng định dạng yêu cầu nhập từ 6 đến 32 kí tự không chứa kí tự đặc biệt";
        //     }
        // }
        if (empty($_POST['email'])) {
            $error['email'] = "Không được bỏ trống trường này";
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "Nhập sai địng dạng vui lòng nhập lại";
            } else
                $email = $_POST['email'];
        }
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được bỏ trống tên đăng nhập";
        } else {
            if (!is_phone($_POST['phone_number'])) {
                $error['phone_number'] = "Số điện thoại không đúng";
            } else {
                $phone_number = $_POST['phone_number'];
            }
        }
        if (($_POST['position'] == 1)) {
            $error['position'] = "Vui lòng chọn";
        } else {
            $position =  $_POST['position'];
            echo $position;
        }
        if (empty($_POST['address'])) {
            $error['address'] = "Không bỏ trống trường này";
        } else {
            $address = $_POST['address'];
        }
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            if ($_FILES["file"]["name"] != NULL) {

                if (
                    $_FILES["file"]["type"] == "image/jpeg"
                    || $_FILES["file"]["type"] == "image/png"
                    || $_FILES["file"]["type"] == "image/gif"
                    || $_FILES["file"]["type"] == "image/jpg"
                ) {
                    if ($_FILES["file"]["size"] > 21000000) {
                        // echo "file quá nang";
                        $error['image'] = "file quá nang";
                    }
                    // kiem tra su ton tai cua file
                    elseif (file_exists("" . $_FILES["file"]["name"])) {
                        $error['image'] = $_FILES["file"]["name"] . " file đã tồn tại ";
                    } else {
                        $post_thumb = "";
                        $path = "public/uploads/users/"; // file luu vào thu muc chua file upload
                        $tmp_name = $_FILES['file']['tmp_name'];
                        $name = $_FILES['file']['name'];
                        $type = $_FILES['file']['type'];
                        $size = $_FILES['file']['size'];
                        // Upload file
                        move_uploaded_file($tmp_name, $path . $name);
                        $post_thumb  = $path . $name;
                    }
                } else {
                    $error['image'] =  "file được chọn không hợp lệ";
                }
            }
        } else {
            $post_thumb = get_info_post('thumbnail', $id);
        }
        if (empty($error)) {
            $control = md5($email . time());
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'position' => $position,
                'address' => $address,
                'thumbnail' => $post_thumb,
                'created_at' => time(),
                'active_token' => $control
            );
            // $link_next = base_url("?mod=users&&controllers=index&action=action_users&active_token={$control}");
            update_users($data, user_login());
            // $content = "<p> I want to change self to make more progress </p>
            //     <p> Click here
            //     <a href ='{$link_next}'> Kích hoạt tài khoản </a> to verify </p>
            //     ";
            // send_mail($email, 'Fail', 'check', $content);
            // redirect("?mod=users&controller=index&action=login");
            $success['account'] = 'Cập nhật tài khoản thành công';
        }
    }
    $info_user = get_user_by_username(user_login());
    $data = array(
        'info_user' => $info_user
    );
    load_view('account', $data);
}
function action_usersAction()
{
    global $success, $error;
    $active_token = $_GET['active_token'];
    $link_back = "?mod=users&controller=index&action=login";
    if (check_new_active_token($active_token)) {
        is_active($active_token);
        $success['success'] = "Bạn đã kích hoạt tài khoản thành công vui lòng <a href = '{$link_back}'>Click</a>";
    } else {
        $error['error'] = "Yêu cầu không hợp lệ vui lòng trở về <a href ='{$link_back}'>Trang chủ</a>";
    }
    load_view('login');
}
function update_passAction()
{
    load_view('update_pass');
}
function teamAction()
{
    load_view('team');
}
function addAction()
{
    load('helper', 'upload_image');
    global $error, $fullname, $email, $username, $password, $success, $phone_number, $position, $address;
    if (isset($_POST['btn-reg'])) {
        $error = array();
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống trường này";
        } else {
            $address = $_POST['address'];
        }
        if (!is_phone($_POST['phone_number'])) {
            $error['phone_number'] = "Số điện thoại không đúng";
        } else {
            $phone_number = $_POST['phone_number'];
        }
        if (($_POST['position'] == 1)) {
            $error['position'] = "Vui lòng chọn";
        } else {
            $position =  $_POST['position'];
            // echo $position;
        }
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Bạn cần nhập thông tin";
        } else {
            $fullname = $_POST['fullname'];
        }
        //email
        if (empty($_POST['email'])) {
            $error['email'] = "Bạn cần nhập thông tin";
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $error['email'] = "Bạn nhập sai định dạng";
            } else
                $email = $_POST['email'];
        }

        #Kiem tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được bỏ trống trường này";
        } else {
            if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
                $error['username'] = "Các kí tự trong khoảng 6->12 chữ và số";
            } else {
                $partten = "/^()[A-Za-z0-9_\.]{6,32}$/";
                if (!preg_match($partten, $_POST['username'], $matchs)) {
                    $error['username'] = "Sai định dạng không được phép nhập kí tự đặc biệt và dấu cách";
                } else
                    $username = $_POST['username'];
            }
        }
        if (empty($_POST['password'])) {

            $error['password'] = "Không được bỏ trống trường này";
        } else {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "Các kí tự trong khoảng 6->12 chữ và số";
            } else {
                $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
                if (!preg_match($partten, $_POST['password'], $matchs)) {
                    $error['password'] = "Cần 1 chữ cái in hoa và không chứa khoảng trắng";
                } else
                    $password = md5($_POST['password']);
            }
        }
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "Bạn chưa upload tệp";
        }
        # kết luận 
        if (empty($error)) {
            # Xử lí login
            # Kiểm tra xem tên có thuộc vào data ko
            //Lưu trữ phiên đăng nhậpư
            if (!check_username_email($username, $email)) {
                $thumbnail = upload_image("public/uploads/users/", $type);
                $control = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'phone_number' => $phone_number,
                    'address' => $address,
                    'position' => $position,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $control,
                    'created_at' => time(),
                    'thumbnail' => $thumbnail
                );
                $link_next = base_url("?mod=users&&controllers=index&&action=action&active_token={$control}");
                add_data($data);
                $content = "<p> I want to change self to make more progress </p>
                <p> Click here
                <a href ='{$link_next}'> Kích hoạt tài khoản </a> to verify </p>
                ";
                send_mail($email, 'Fail', 'check', $content);
                $success['account'] = 'Đăng kí thành công xin mời kiểm tra email để xác thực';
            } else {
                $error['account'] = "Email hoặc username đã tồn tại, Vui lòng nhập lại hoặc kiểm tra email để kích hoạt email hết hiệu lực sau 2 ngày";
            }
            // show_array($error);
        }
    }
    time_active_0();

    load_view('add');
}
function actionAction()
{
    global $success, $error;
    $active_token = $_GET['active_token'];
    $link_back = "?mod=users&controllers=index&action=login";
    $item = get_user_by_active_token($active_token);
    if (check_new_active_token($active_token)) {
        if ($item['is_active'] == '0') {
            is_active($active_token);
            $success['success'] = "Bạn đã kích hoạt tài khoản thành công vui lòng trờ về <a href ='{$link_back}' class ='class'>Trang chủ</a>";
        } else {
            $error['error'] = "Tài khoản trước đó đã được kích hoạt vui lòng click <a href ='{$link_back}' class ='class'>vào đây</a> để đăng nhập ";
        }
    } else {
        $error['error'] = "Yêu cầu không hợp lệ vui lòng trở về <a href ='?'>Trang chủ</a>";
    }
    load_view('add');
}
