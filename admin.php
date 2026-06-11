<?php
session_start();
$servername = "localhost";
$username = "root";    // tài khoản MySQL
$password = "";        // mật khẩu MySQL (nếu có)
$dbname = "coffee_db"; 

// --- Simple admin check ---
// Bạn có thể thay điều kiện này bằng cơ chế auth của bạn.
// Ví dụ: $_SESSION['is_admin'] = true khi login admin.
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // nếu bạn muốn dùng user_id 1 làm admin: uncomment:
    // if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) { ... }
    header('Location: sign.php'); // chuyển tới trang đăng nhập
    exit();
}

// --- Actions: delete contact, delete order, update status, export ---
if (isset($_GET['delete_contact'])) {
    $id = intval($_GET['delete_contact']);
    $conn->query("DELETE FROM lienhe WHERE id = $id");
    header('Location: admin.php?tab=contacts');
    exit();
}

if (isset($_GET['delete_order'])) {
    $id = intval($_GET['delete_order']);
    // donhang_chitiet có ràng buộc cascade nếu tạo như trên; nếu không có thì xóa thủ công:
    $conn->query("DELETE FROM donhang_chitiet WHERE donhang_id = $id");
    $conn->query("DELETE FROM donhang WHERE id = $id");
    header('Location: admin.php?tab=orders');
    exit();
}

if (isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $status = $conn->real_escape_string($_POST['status']);
    $conn->query("UPDATE donhang SET trang_thai = '$status' WHERE id = $order_id");
    header('Location: admin.php?tab=orders');
    exit();
}

// Export CSV for contacts or orders
if (isset($_GET['export']) && $_GET['export'] === 'contacts') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=contacts.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['id','name','email','phone','message','created_at']);
    $res = $conn->query("SELECT id,name,email,phone,message,created_at FROM lienhe ORDER BY created_at DESC");
    while ($row = $res->fetch_assoc()) {
        fputcsv($out, $row);
    }
    fclose($out);
    exit();
}
if (isset($_GET['export']) && $_GET['export'] === 'orders') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=orders.csv');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['order_id','user_id','ngay_mua','tong_tien','trang_thai']);
    $res = $conn->query("SELECT id as order_id,user_id,ngay_mua,tong_tien,trang_thai FROM donhang ORDER BY ngay_mua DESC");
    while ($row = $res->fetch_assoc()) {
        fputcsv($out, $row);
    }
    fclose($out);
    exit();
}

// --- Fetch data for display ---
$contacts = $conn->query("SELECT * FROM lienhe ORDER BY created_at DESC");
$orders = $conn->query("SELECT * FROM donhang ORDER BY ngay_mua DESC");
$users = $conn->query("SELECT id, username, hoten, email FROM users ORDER BY id DESC"); // nếu có bảng users
$products = $conn->query("SELECT id, ten_sanpham, gia FROM taikhoan_game"); // nếu dùng bảng khác sửa lại
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8">
<title>Admin - 22COFFEE</title>
<link rel="stylesheet" href="./coffeeshopdestop-master/assets/css/style.css">
<style>
/* Một số chỉnh nhanh cho admin */
.admin-wrap { max-width:1200px; margin:30px auto; padding:20px; background:#fff; border-radius:8px; box-shadow:0 6px 24px rgba(0,0,0,0.06); }
.admin-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
.tabs { display:flex; gap:8px; }
.tab { padding:8px 12px; background:#f0f0f0; border-radius:6px; text-decoration:none; color:#333; font-weight:600; }
.tab.active { background:#b87333; color:#fff; }
.table { width:100%; border-collapse:collapse; margin-top:12px; }
.table th, .table td { padding:10px; border:1px solid #eee; text-align:left; font-size:1.4rem; }
.small { font-size:1.2rem; color:#666; }
.btn { padding:6px 10px; border-radius:6px; text-decoration:none; background:#2e2100; color:#fff; display:inline-block; }
.btn.warn { background:#e74c3c; }
.form-inline { display:flex; gap:8px; align-items:center; }
.select { padding:6px 8px; border-radius:6px; }
</style>
</head>
<body>
<div class="main-content">
  <div class="admin-wrap">
    <div class="admin-header">
      <h1>Admin Dashboard</h1>
      <div>
        <a href="index.php" class="btn">Xem trang chính</a>
        <a href="admin.php?export=contacts" class="btn">Export Contacts</a>
        <a href="admin.php?export=orders" class="btn">Export Orders</a>
      </div>
    </div>

    <div class="tabs">
      <a class="tab <?= (!isset($_GET['tab']) || $_GET['tab']=='orders') ? 'active':'' ?>" href="admin.php?tab=orders">Đơn hàng</a>
      <a class="tab <?= (isset($_GET['tab']) && $_GET['tab']=='contacts') ? 'active':'' ?>" href="admin.php?tab=contacts">Liên hệ</a>
      <a class="tab <?= (isset($_GET['tab']) && $_GET['tab']=='users') ? 'active':'' ?>" href="admin.php?tab=users">Người dùng</a>
      <a class="tab <?= (isset($_GET['tab']) && $_GET['tab']=='products') ? 'active':'' ?>" href="admin.php?tab=products">Sản phẩm</a>
    </div>

    <!-- ORDERS -->
    <?php if (!isset($_GET['tab']) || $_GET['tab']=='orders'): ?>
      <h2 style="margin-top:18px">Danh sách đơn hàng</h2>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Khách hàng (user_id)</th>
            <th>Ngày mua</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
        <?php while($r = $orders->fetch_assoc()): ?>
          <tr>
            <td><?= $r['id'] ?></td>
            <td><?= htmlspecialchars($r['user_id']) ?></td>
            <td class="small"><?= $r['ngay_mua'] ?></td>
            <td><?= number_format($r['tong_tien'],0,',','.') ?> VND</td>
            <td><?= htmlspecialchars($r['trang_thai']) ?></td>
            <td>
              <a class="btn" href="admin.php?tab=orders&view_order=<?= $r['id'] ?>">Xem</a>
              <a class="btn" href="admin.php?tab=orders&delete_order=<?= $r['id'] ?>" onclick="return confirm('Xóa đơn hàng #<?= $r['id'] ?>?')">Xóa</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>

      <?php
      // View order detail
      if (isset($_GET['view_order'])) {
          $oid = intval($_GET['view_order']);
          $o = $conn->query("SELECT * FROM donhang WHERE id = $oid")->fetch_assoc();
          $items = $conn->query("SELECT dhc.*, tg.ten_game as sanpham_name FROM donhang_chitiet dhc LEFT JOIN taikhoan_game tg ON dhc.sanpham_id = tg.id WHERE dhc.donhang_id = $oid");
      ?>
        <hr>
        <h3>Chi tiết đơn hàng #<?= $oid ?></h3>
        <p><strong>Khách hàng (user_id):</strong> <?= htmlspecialchars($o['user_id']) ?> — <strong>Ngày:</strong> <?= $o['ngay_mua'] ?></p>
        <p><strong>Tổng:</strong> <?= number_format($o['tong_tien'],0,',','.') ?> VND</p>

        <table class="table">
          <thead><tr><th>Sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Thành tiền</th></tr></thead>
          <tbody>
            <?php while($it = $items->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($it['sanpham_name'] ?? $it['sanpham_id']) ?></td>
                <td><?= $it['so_luong'] ?></td>
                <td><?= number_format($it['gia'],0,',','.') ?> VND</td>
                <td><?= number_format($it['gia'] * $it['so_luong'],0,',','.') ?> VND</td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

        <form method="POST" style="margin-top:12px;">
          <input type="hidden" name="order_id" value="<?= $oid ?>">
          <label for="status">Cập nhật trạng thái:</label>
          <select id="status" name="status" class="select">
            <option value="Chờ xác nhận">Chờ xác nhận</option>
            <option value="Đang giao">Đang giao</option>
            <option value="Hoàn thành">Hoàn thành</option>
            <option value="Đã hủy">Đã hủy</option>
          </select>
          <button type="submit" name="update_status" class="btn" style="margin-left:8px;">Cập nhật</button>
        </form>
      <?php } ?>
    <?php endif; ?>

    <!-- CONTACTS -->
    <?php if (isset($_GET['tab']) && $_GET['tab']=='contacts'): ?>
      <h2 style="margin-top:18px">Liên hệ từ khách</h2>
      <table class="table">
        <thead><tr><th>#</th><th>Họ tên</th><th>Email</th><th>Phone</th><th>Nội dung</th><th>Ngày</th><th>Hành động</th></tr></thead>
        <tbody>
        <?php while($c = $contacts->fetch_assoc()): ?>
          <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['phone']) ?></td>
            <td style="max-width:420px; white-space:pre-wrap;"><?= htmlspecialchars($c['message']) ?></td>
            <td class="small"><?= $c['created_at'] ?></td>
            <td>
              <a class="btn" href="mailto:<?= $c['email'] ?>">Trả lời</a>
              <a class="btn warn" href="admin.php?tab=contacts&delete_contact=<?= $c['id'] ?>" onclick="return confirm('Xóa liên hệ #<?= $c['id'] ?>?')">Xóa</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- USERS -->
    <?php if (isset($_GET['tab']) && $_GET['tab']=='users'): ?>
      <h2 style="margin-top:18px">Người dùng</h2>
      <table class="table">
        <thead><tr><th>ID</th><th>Họ tên</th><th>Username</th><th>Email</th></tr></thead>
        <tbody>
        <?php if ($users && $users->num_rows): while($u = $users->fetch_assoc()): ?>
          <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['hoten'] ?? '') ?></td>
            <td><?= htmlspecialchars($u['username'] ?? '') ?></td>
            <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
          </tr>
        <?php endwhile; else: ?>
          <tr><td colspan="4">Không có người dùng</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    <?php endif; ?>

    <!-- PRODUCTS -->
    <?php if (isset($_GET['tab']) && $_GET['tab']=='products'): ?>
      <h2 style="margin-top:18px">Sản phẩm</h2>
      <table class="table">
        <thead><tr><th>ID</th><th>Tên</th><th>Giá</th></tr></thead>
        <tbody>
        <?php if ($products && $products->num_rows): while($p = $products->fetch_assoc()): ?>
          <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['ten_game'] ?? $p['ten_sanpham'] ?? '') ?></td>
            <td><?= number_format($p['gia'] ?? 0,0,',','.') ?></td>
          </tr>
        <?php endwhile; else: ?>
          <tr><td colspan="3">Không có sản phẩm</td></tr>
        <?php endif; ?>
        </tbody>
      </table>
    <?php endif; ?>

  </div>
</div>
</body>
</html>
