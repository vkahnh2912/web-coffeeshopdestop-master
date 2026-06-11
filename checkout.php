<?php
session_start();

// Thông tin kết nối
$servername = "localhost";
$username = "root";    
$password = "";        
$dbname = "coffee_db"; 

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (!empty($_SESSION['cart'])) {
    $user_id = 1; // ví dụ user đăng nhập
    $tong = 0;
    foreach ($_SESSION['cart'] as $item) {
        $tong += $item['price'] * $item['quantity'];
    }

    // Lấy mã chuyển khoản từ form
    $ma_chuyen_khoan = $_POST['ma_chuyen_khoan'] ?? 'Chưa có';

    // Xử lý upload ảnh
    $img_path = '';
    if(isset($_FILES['img_chuyen_khoan']) && $_FILES['img_chuyen_khoan']['error'] == 0) {
        $upload_dir = 'uploads/';
        if(!is_dir($upload_dir)) mkdir($upload_dir);
        $img_path = $upload_dir . time() . '_' . basename($_FILES['img_chuyen_khoan']['name']);
        move_uploaded_file($_FILES['img_chuyen_khoan']['tmp_name'], $img_path);
    }

    // Lưu đơn hàng (kèm mã chuyển khoản + ảnh)
    $sql = "INSERT INTO donhang(user_id, ngay_mua, tong_tien, trang_thai, ma_chuyen_khoan, img_chuyen_khoan)
            VALUES ($user_id, NOW(), $tong, 'Chờ xác nhận', '$ma_chuyen_khoan', '$img_path')";
    $conn->query($sql);
    $donhang_id = $conn->insert_id;

    // Lưu chi tiết đơn hàng
    foreach ($_SESSION['cart'] as $id => $item) {
        $sql = "INSERT INTO donhang_chitiet(donhang_id, sanpham_id, so_luong, gia)
                VALUES ($donhang_id, $id, {$item['quantity']}, {$item['price']})";
        $conn->query($sql);
    }

    unset($_SESSION['cart']); // xóa giỏ hàng

    echo "<h2 style='color:lime'>Thanh toán thành công!</h2>";
    echo "<p>Mã chuyển khoản: $ma_chuyen_khoan</p>";
    if($img_path != '') {
        echo "<p>Ảnh xác nhận chuyển khoản:</p>";
        echo "<img src='$img_path' alt='Ảnh chuyển khoản' style='width:200px;'>";
    }
    echo "<br><a href='index.php' style='color:#FFA726'>Quay lại trang chủ</a>";
} else {
    echo "<p>Giỏ hàng trống!</p>";
}
?>
