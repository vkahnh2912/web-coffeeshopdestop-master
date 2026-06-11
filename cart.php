<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Giỏ hàng</title>
<style>
    body { background:#0F0F1A; color:white; font-family:sans-serif; padding:20px; }
    table { width:100%; border-collapse:collapse; background:#1D1B31; border-radius:8px; overflow:hidden; }
    th, td { padding:12px; border-bottom:1px solid #333; text-align:center; }
    th { background:#242238; color:#FFA726; }
    tr:hover { background:#2c2b3a; }
    .btn { padding:6px 12px; border:none; cursor:pointer; border-radius:4px; }
    .btn-delete { background:#e74c3c; color:white; }
    .btn-checkout { background:#27ae60; color:white; }
</style>
</head>
<body>
    <h2>Giỏ hàng của bạn</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Hành động</th>
            </tr>
            <?php 
            $tong = 0;
            foreach ($_SESSION['cart'] as $id => $item): 
                $thanhtien = $item['price'] * $item['quantity'];
                $tong += $thanhtien;
            ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= number_format($item['price'],0,',','.') ?> VND</td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($thanhtien,0,',','.') ?> VND</td>
                <td>
                    <a href="cart.php?remove=<?= $id ?>" onclick="return confirm('Xóa sản phẩm này?');">
                        <button class="btn btn-delete">Xóa</button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><b>Tổng cộng</b></td>
                <td colspan="2"><?= number_format($tong,0,',','.') ?> VND</td>
            </tr>
        </table>
        <br>
        <a href="checkout.php"><button class="btn btn-checkout">Thanh toán</button></a>
    <?php else: ?>
        <p>Giỏ hàng trống.</p>
    <?php endif; ?>

</body>
</html>

<?php
// Xử lý xóa sản phẩm
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header("Location: cart.php");
    exit();
}
?>
<div style="margin-top: 20px;">
    <a href="index.php" 
       style="display: inline-block; 
              padding: 10px 20px; 
              background-color: #b87333; 
              color: white; 
              border-radius: 5px; 
              text-decoration: none; 
              font-weight: bold;">
        ⬅️ Quay lại mua hàng
    </a>
     <h2>Thanh toán đơn hàng</h2>
    <form action="checkout.php" method="POST" enctype="multipart/form-data">
        <label>Mã chuyển khoản:</label>
        <input type="text" name="ma_chuyen_khoan" required><br><br>

        <label>Ảnh xác nhận chuyển khoản:</label>
        <input type="file" name="img_chuyen_khoan" accept="image/*" required><br><br>

        <button type="submit">Thanh toán</button>
    </form>
</body>
</div>
