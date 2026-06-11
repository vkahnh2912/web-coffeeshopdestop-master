<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffee_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}




// ================== Thêm sản phẩm ==================
if (isset($_POST['add_product'])) {
    $name  = $conn->real_escape_string($_POST['name']);
    $desc  = $conn->real_escape_string($_POST['description']);
    $price = intval($_POST['price']);

    // Upload ảnh
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $image = time() . "_" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
    }

    $sql = "INSERT INTO products (ProductName, Description , Price, Image)
            VALUES ('$name','$desc','$price','$image')";
    if (!$conn->query($sql)) {
        die("Lỗi thêm sản phẩm: " . $conn->error);
    }
    header("Location: admin_products.php");
    exit;
}

// ================== Xóa sản phẩm ==================
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Xóa ảnh cũ
    $res = $conn->query("SELECT Image FROM products WHERE ProductID=$id");
    $row = $res->fetch_assoc();
    if ($row && $row['Image'] && file_exists("uploads/".$row['Image'])) {
        unlink("uploads/".$row['Image']);
    }

    $conn->query("DELETE FROM products WHERE ProductID=$id");
    header("Location: admin_products.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Admin - Quản lý sản phẩm</title>
<style>
body { font-family: Arial,sans-serif; background:#f4f4f4; margin:20px; }
h1 { color:#333; }
h2 { margin-top:30px; color:#b87333; }
form { margin-bottom:20px; background:#fff; padding:20px; border-radius:6px; box-shadow:0 2px 6px rgba(0,0,0,0.1);}
input,textarea { width:100%; padding:8px; margin:5px 0; border:1px solid #ccc; border-radius:4px; }
table { width:100%; border-collapse:collapse; margin-top:20px; background:#fff; }
table, th, td { border:1px solid #ddd; }
th { background:#b87333; color:#fff; }
th, td { padding:10px; text-align:center; }
img { width:100px; border-radius:6px; }
.btn { padding:6px 12px; background:#b87333; color:#fff; text-decoration:none; border-radius:4px; }
.btn:hover { background:#8b4513; }
</style>
</head>
<body>

<h1>Trang Quản Trị Sản Phẩm</h1>

<h2>Thêm sản phẩm mới</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Tên sản phẩm</label>
    <input type="text" name="name" required>

    <label>Mô tả</label>
    <textarea name="description" rows="3"></textarea>

    <label>Giá (VNĐ)</label>
    <input type="number" name="price" required>

    <label>Ảnh sản phẩm</label>
    <input type="file" name="image">

    <button type="submit" name="add_product" class="btn">➕ Thêm</button>
</form>

<h2>Danh sách sản phẩm</h2>
<table>
<tr>
    <th>ID</th>
    <th>Tên</th>
    <th>Mô tả</th>
    <th>Giá</th>
    <th>Ảnh</th>
    <th>Hành động</th>
</tr>
<?php
$result = $conn->query("SELECT * FROM products ORDER BY ProductID DESC");
if(!$result) die("Lỗi SQL: ".$conn->error);

while($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['ProductID']}</td>
        <td>{$row['ProductName']}</td>
        <td>{$row['Description']}</td>
        <td>".number_format($row['Price'])." VND</td>
        <td><img src='uploads/{$row['Image']}'></td>
        <td>
            <a href='admin_products.php?delete={$row['ProductID']}' class='btn' onclick='return confirm(\"Xóa sản phẩm này?\")'>🗑 Xóa</a>
        </td>
    </tr>";
}
?>
</table>

<br>
<a href="index.php" class="btn">⬅ Quay lại Trang Chủ</a>

</body>
</html>
