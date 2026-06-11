<?php
// Kết nối MySQL (chỉnh sửa cho đúng với DB của bạn)
$conn = new mysqli("localhost", "root", "", "coffee_db");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form và chống SQL Injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    // Thêm vào bảng lienhe
    $sql = "INSERT INTO lienhe (name, email, phone, message) 
            VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>✅ Cảm ơn bạn đã liên hệ, $name!</h2>";
        echo "<p>Chúng tôi sẽ phản hồi sớm nhất có thể.</p>";
        echo "<a href='index.php'>← Quay lại trang chủ</a>";
    } else {
        echo "❌ Lỗi: " . $conn->error;
    }
}
$conn->close();
?>
