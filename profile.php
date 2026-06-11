<?php 
include './coffeeshopdestop-master/config/config.php';
include './coffeeshopdestop-master/config/Database.php';
session_start();

// Kiểm tra session
if (!isset($_SESSION['Username'])) {
    header('Location: login.php');
    exit;
}

// Lấy dữ liệu user
$sql = "SELECT * FROM Users 
        INNER JOIN Account_Types ON Users.AccountTypeID = Account_Types.AccountTypeID 
        WHERE Username = '" . $_SESSION['Username'] . "'";
$user = Database::GetData($sql, ['row' => 0]);

// Xử lý update thông tin
if (isset($_POST['submit'])) {
    // Cập nhật ảnh đại diện
    if (!empty($_FILES['avatar']['name'])) {
        $upload_dir = './uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $filename = time() . '_' . basename($_FILES['avatar']['name']);
        $image_path = $upload_dir . $filename;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $image_path);
        $db_path = '/uploads/' . $filename; // Lưu đường dẫn cho DB
        Database::NonQuery("UPDATE Users SET Avatar='$db_path' WHERE Username='" . $_SESSION['Username'] . "'");
        $_SESSION['Avatar'] = $db_path; // cập nhật session
    }

    // Cập nhật thông tin cá nhân
    $fullname = $_POST['fullname'] ?? '';
    $phone    = $_POST['phone'] ?? '';
    $email    = $_POST['email'] ?? '';

    Database::NonQuery("UPDATE Users SET Fullname='" . addslashes($fullname) . "', Phone='" . addslashes($phone) . "', Email='" . addslashes($email) . "' WHERE Username='" . $_SESSION['Username'] . "'");
    $message = '<p style="color:#48CFAD; margin-top:10px;">Cập nhật thông tin thành công!</p>';

    // Lấy lại dữ liệu mới
    $user = Database::GetData($sql, ['row' => 0]);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="./coffeeshopdestop-master/assets/css/bai.css">
</head>
<body>

<div class="profile-container">
    <div class="profile-avatar">
        <img src="<?= isset($_SESSION['Avatar']) ? htmlspecialchars($_SESSION['Avatar']) : './coffeeshopdestop-master/assets/img/default-avatar.png' ?>" alt="Avatar">
    </div>
    <h2>Thông tin cá nhân</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="profile-info">
            <label>Tên đăng nhập:</label>
            <input type="text" value="<?= htmlspecialchars($user['Username'] ?? '') ?>" disabled>
        </div>

        <div class="profile-info">
            <label>Họ tên:</label>
            <input type="text" name="fullname" value="<?= htmlspecialchars($user['Fullname'] ?? '') ?>">
        </div>

        <div class="profile-info">
            <label>Số điện thoại:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($user['Phone'] ?? '') ?>">
        </div>

        <div class="profile-info">
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['Email'] ?? '') ?>">
        </div>

        <div class="profile-info">
            <label>Ảnh đại diện:</label>
            <input type="file" name="avatar">
        </div>

        <div class="profile-info">
            <label>Ngày tạo tài khoản:</label>
            <input type="text" value="<?= isset($user['CreatedAt']) ? date_format(new DateTime($user['CreatedAt']),'d-m-Y') : '' ?>" disabled>
        </div>

        <div class="profile-info">
            <label>Loại tài khoản:</label>
            <input type="text" value="<?= htmlspecialchars($user['AccountTypeName'] ?? '') ?>" disabled>
        </div>

        <div class="profile-actions">
            <button type="submit" name="submit" class="btn">Cập nhật</button>
            <a href="/change-password.php" class="btn">Đổi mật khẩu</a>
            <a href="index.php" class="btn">Trang chủ</a>
        </div>

        <?php if(isset($message)) echo $message; ?>
    </form>
</div>

</body>
</html>
