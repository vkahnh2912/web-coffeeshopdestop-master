<?php 
include './coffeeshopdestop-master/config/config.php';
include './coffeeshopdestop-master/config/database.php';

$messageSignIn = '';
$messageSignUp = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Đăng nhập
    if (isset($_POST['SignIn'])) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $sql = "SELECT * FROM users 
                WHERE (Username = '$username' OR Phone = '$username' OR Email = '$username') 
                AND Password = sha1('$password') 
                AND Status = 1";
        $users = Database::GetData($sql);
        if ($users != null) {
            session_start();
            $user = $users[0];
            $_SESSION['Username'] = $user['Username'];
            $_SESSION['DisplayName'] = $user['Fullname'] == '' ? $user['Username'] : $user['Fullname'];
            $_SESSION['Avatar'] = !empty($user['Avatar']) ? $user['Avatar'] : './coffeeshopdestop-master/assets/img/user.png';
            $_SESSION['Role'] = $user['AccountTypeID'];
            header('Location: index.php');
             // Phân quyền: nếu AccountTypeID = 1 thì là admin
      if ($user['AccountTypeID'] == 1) {   // giả sử 1 là admin
    $_SESSION['is_admin'] = 1;
} else {
    $_SESSION['is_admin'] = 0;
}

            exit;
        } else {
            $messageSignIn = "<p style='color: #141010ff'>Tên đăng nhập hoặc mật khẩu không hợp lệ!</p>";
        }
    }

    // Đăng ký
    if (isset($_POST['SignUp'])) {
        $username = $_POST['username'] ?? '';
        $password1 = $_POST['password1'] ?? '';
        $password2 = $_POST['password2'] ?? '';
        $email = $_POST['email'] ?? '';

        if ($password1 == $password2) {
            $sql = "INSERT INTO users 
                    VALUES ('$username', sha1('$password1'), '', '', '$email', '', 0, 1, NOW(3), 3)";
            $check = Database::NonQuery($sql);
            if ($check) {
                $messageSignUp = "<p style='color: #0d6efd'>Đăng ký thành công</p>";
            } else {
                $messageSignUp = "<p style='color: #dc3545'>Đăng ký thất bại</p>";
            }
        } else {
            $messageSignUp = "<p style='color: #dc3545'>Mật khẩu không khớp!</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./coffeeshopdestop-master/assets/css/sign.css"/>
    <title>Đăng ký và đăng nhập</title>
    <link rel="icon" href="./coffeeshopdestop-master/assets/img/favicon.png" />
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Form Đăng nhập -->
                <form action="#" method="POST" class="sign-in-form">
                    <h2 class="title">Đăng nhập</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input name="username" type="text" placeholder="Tài khoản / Email / Điện thoại" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password" placeholder="Mật khẩu" required />
                    </div>
                    <?= $messageSignIn ?>
                    <input name="SignIn" type="submit" value="Đăng nhập" class="btn solid" />
                </form>
                

                <!-- Form Đăng ký -->
                <form action="#" method="POST" class="sign-up-form">
                    <h2 class="title">Đăng ký</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input name="username" type="text" placeholder="Tên đăng nhập" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input name="password1" type="password" placeholder="Mật khẩu" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input name="password2" type="password" placeholder="Nhập lại mật khẩu" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input name="email" type="email" placeholder="yourmail@gmail.com" required />
                    </div>
                    <?= $messageSignUp ?>
                    <input name="SignUp" type="submit" class="btn" value="Đăng ký" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Thành viên mới?</h3>
                    <p>Nếu bạn chưa có tài khoản. Hãy tạo ngay một tài khoản và tham gia cùng chúng tôi nào!</p>
                    <button class="btn transparent" id="sign-up-btn">Đăng ký</button>
                </div>
                <img src="./coffeeshopdestop-master/assets/img/log.svg" class="image" alt="" />
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <h3>Xin chào!</h3>
                    <p>Nếu bạn đã có tài khoản. Hãy đăng nhập vào để bắt đầu mua hàng!</p>
                    <button class="btn transparent" id="sign-in-btn">Đăng nhập</button>
                </div>
                <img src="./coffeeshopdestop-master/assets/img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");

        if (sign_up_btn) {
            sign_up_btn.addEventListener("click", () => {
                container.classList.add("sign-up-mode");
            });
        }
        if (sign_in_btn) {
            sign_in_btn.addEventListener("click", () => {
                container.classList.remove("sign-up-mode");
            });
        }
    });


    </script>
</body>
</html>
