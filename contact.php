<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Liên hệ - 22Coffee</title>
  <link rel="stylesheet" href="./coffeeshopdestop-master/assets/css/style.css">
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #fffcf4;
    }
    .contact-container {
      width: 600px;
      margin: 100px auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .contact-container h2 {
      text-align: center;
      font-size: 2.8rem;
      margin-bottom: 20px;
      color: #2e2100;
    }
    form label {
      font-weight: 600;
      display: block;
      margin-top: 12px;
      margin-bottom: 5px;
      color: #2e2100;
    }
    form input, form textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1.6rem;
    }
    form textarea {
      height: 120px;
      resize: vertical;
    }
    .contact-container button {
      display: block;
      width: 100%;
      padding: 14px;
      background: #b87333;
      color: #fff;
      font-size: 1.6rem;
      border: none;
      border-radius: 8px;
      margin-top: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    .contact-container button:hover {
      background: #8b4513;
      transform: scale(1.03);
    }
    .back-btn {
      display: inline-block;
      margin-top: 20px;
      text-align: center;
      background: #2e2100;
      color: #fff;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
    }
    .back-btn:hover {
      background: #4b3610;
    }
  </style>
</head>
<body>

<div class="contact-container">
  <h2>📩 Liên hệ với chúng tôi</h2>
  <form action="contact_submit.php" method="POST">
    <label for="name">Họ và tên</label>
    <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Nhập email" required>

    <label for="phone">Số điện thoại</label>
    <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại">

    <label for="message">Nội dung</label>
    <textarea id="message" name="message" placeholder="Bạn muốn nhắn gì cho chúng tôi..." required></textarea>

    <button type="submit">📨 Gửi liên hệ</button>
  </form>

  <a href="index.php" class="back-btn">⬅ Quay lại trang chủ</a>
</div>

</body>
</html>
