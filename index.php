<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- reset css -->
    <link rel="stylesheet" href="./coffeeshopdestop-master/assets/css/reset.css" />
    <!-- font awe -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="./coffeeshopdestop-master/assets/css/style.css" />
    <!-- Nhúng font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sen:wght@400..800&display=swap"
      rel="stylesheet"
    />
    <!-- rps -->
     <link rel="stylesheet" href="./coffeeshopdestop-master/assets/css/responsive.css">
    <title>22COFFEE - Nơi khơi nguồn cảm hứng!</title>
  </head>
  <body>
    <header class="header fixed">
      <div class="main-content">
        <div class="body headerrps">
          <!-- Logo website -->
          <a href="" class="Logo header__Logo">22COFFEE</a>
          <!-- <img src="./assets/img/Lg.svg" alt="22COFFEE" class="Logo" /> -->
          <!-- Thanh điều hướng nav -->
     <div class="navbar">
  <div class="logo"></div>
  <ul class="nav-buttons">
    <li><a href="#products" class="btn">Home</a></li>
    <li><a href="#products" class="btn">Menu</a></li>
    <li><a href="contact.php" class="btn">Contact</a></li>
    <li>
      <a href="cart.php" class="btn cart-btn">
        <i class="fas fa-shopping-cart"></i>
      </a>
    </li>
  </ul>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


          <!-- Nút bấm Sign-up -->
          <?php
session_start(); // Nếu ở đầu file đã có rồi thì không cần thêm nữa
?>
<!-- Nút bấm Sign-up -->
<div class="action rps1" style="position: relative;">
    <?php if (isset($_SESSION['DisplayName'])): ?>
        <div class="user-menu" style="cursor: pointer; position: relative;">
            <span id="userName">Hi, <?= htmlspecialchars($_SESSION['DisplayName']) ?></span>
            <div id="dropdownMenu" style="display: none; position: absolute; top: 25px; right: 0; background: white; border: 1px solid #ccc; border-radius: 5px; min-width: 150px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                <a href="profile.php" style="display: block; padding: 8px 12px; text-decoration: none; color: black;">Thông tin cá nhân</a>
                <a href="logout.php" style="display: block; padding: 8px 12px; text-decoration: none; color: black;">Đăng xuất</a>
            </div>
        </div>
    <?php else: ?>
        <a href="sign.php" class="btn btn-sign-up">Tài Khoản</a>
    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userName = document.getElementById("userName");
        const menu = document.getElementById("dropdownMenu");

        if (userName) {
            userName.addEventListener("click", function() {
                menu.style.display = (menu.style.display === "block") ? "none" : "block";
            });

            document.addEventListener("click", function(e) {
                if (!userName.contains(e.target) && !menu.contains(e.target)) {
                    menu.style.display = "none";
                }
            });
        }
    });
</script>

</div>

          </div>
        </div>
      </div>
    </header>
    <!-- Nhúng font awesome -->
    <!-- <div class="mobile-header">
      <!- menu -->
       <!-- <input type="checkbox" name="menu-checkbox" id="menu-checkbox" class="menu-checkbox" hidden>
       <lable for="menu-checkbox">
        <i class="fa-solid fa-bars menu-header__icon"></i>
         <! <svg class=menu-header__icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.<path d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z"/></svg> -->
      <!-- </lable> -->
      <!-- overlay -->
       <!-- <label for="menu-checkbox" class="menu-overlay"></label>
    </div> -->
    <main>
      <!-- hero -->
      <div class="hero">
        <div class="main-content">
          <div class="body">
            <!-- hero left -->
            <div class="media-block">
              <img src="./coffeeshopdestop-master/assets/img/quancf.jpg" alt="img" class="img" />
            </div>

            <!-- hero right -->
            <div class="content-block">
              <h1 class="heading">
                Chào mừng đến với 22Coffee – nơi khơi nguồn cảm hứng mỗi ngày!
              </h1>
              <p class="desc">
                Tọa lạc giữa lòng thành phố nhộn nhịp, 22Coffee là không gian lý
                tưởng để bạn thưởng thức hương vị cà phê nguyên chất, thả mình
                vào giai điệu nhẹ nhàng và tận hưởng khoảnh khắc thư giãn. Từ
                những ly espresso đậm đà đến các món đá xay mát lạnh, mỗi thức
                uống tại quán đều được chăm chút tỉ mỉ để mang đến trải nghiệm
                trọn vẹn nhất. Hãy ghé 22Coffee – nơi ly cà phê không chỉ là
                thức uống, mà là cả một câu chuyện!
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- popular -->
      <div class="popular">
        <div class="main-content">
          <div class="popular-top">
            <div class="info">
              <h2 class="heading-lv2">
                "Cà Phê – Hương Vị Kết Nối và Năng Lượng Cuộc Sống"
              </h2>
              <p class="desc">
               <pre class="over">
      Uống cà phê không chỉ giúp tinh thần tỉnh táo và tăng khả năng tập trung, mà còn mang lại những phút giây thư giãn quý giá bên
      người thân. Một tách cà phê vào buổi sáng hay chiều muộn có thể trở thành dịp để trò chuyện, chia sẻ và gắn kết tình cảm. Trong
      nhịp sống bận rộn, việc cùng nhau thưởng thức cà phê giúp ta chậm lại một chút để cảm nhận niềm vui giản dị và sự ấm áp từ
      những mối quan hệ thân thương.
               </pre>
              </p>
            </div>
          </div>
     
<!-- Phần sản phẩm -->
<section id="products" class="popular">
  <div class="main-content">
    <h2 class="heading-lv2">Menu Hôm Nay</h2>
    <div class="course-list">
        <!-- Các sản phẩm ở đây -->
    </div>
  </div>
</section>

    <!-- Danh sách sản phẩm: 3-3 -->
    <div class="course-list">

      <!-- Sản phẩm 1 -->
      <div class="course-item">
        <img src="./coffeeshopdestop-master/assets/img/cfden1.jpg" alt="Cà phê đen" class="thumb">
        <div class="info">
          <h3 class="title">Cà phê đen</h3>
          <p class="desc">"Một ly cà phê đen, một khởi đầu mới - đen đá không đường."</p>
          <div class="foot">
            <span class="price">27.000VND</span>
            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="id" value="1">
              <input type="hidden" name="name" value="Cà phê đen">
              <input type="hidden" name="price" value="27000">
              <input type="number" name="quantity" value="1" min="1">
              <button type="submit" name="add_to_cart" class="btn btn-dh">🛒 Đặt mua</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Sản phẩm 2 -->
      <div class="course-item">
        <img src="./coffeeshopdestop-master/assets/img/cfmuoi1.jpg" alt="Cà phê muối" class="thumb">
        <div class="info">
          <h3 class="title">Cà phê muối</h3>
          <p class="desc">"Ngọt thì ai cũng thích còn mặn, phải thử mới hiểu."</p>
          <div class="foot">
            <span class="price">40.000VND</span>
            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="id" value="2">
              <input type="hidden" name="name" value="Cà phê muối">
              <input type="hidden" name="price" value="40000">
              <input type="number" name="quantity" value="1" min="1">
              <button type="submit" name="add_to_cart" class="btn btn-dh">🛒 Đặt mua</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Sản phẩm 3 -->
      <div class="course-item">
        <img src="./coffeeshopdestop-master/assets/img/cfbacxiu1.jpg" alt="Bạc xỉu" class="thumb">
        <div class="info">
          <h3 class="title">Bạc xỉu</h3>
          <p class="desc">"Bạc xỉu ngọt lịm đầu môi, uống xong tỉnh giấc, nhẹ trôi một ngày."</p>
          <div class="foot">
            <span class="price">34.000VND</span>
            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="id" value="3">
              <input type="hidden" name="name" value="Bạc xỉu">
              <input type="hidden" name="price" value="34000">
              <input type="number" name="quantity" value="1" min="1">
              <button type="submit" name="add_to_cart" class="btn btn-dh">🛒 Đặt mua</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Sản phẩm 4 -->
      <div class="course-item">
        <img src="./coffeeshopdestop-master/assets/img/socola3.jpg" alt="Latte socola marou" class="thumb">
        <div class="info">
          <h3 class="title">Latte socola marou</h3>
          <p class="desc">"Latte Marou, ngọt môi cười, cà phê quyện vị - chuyện đời thêm thơ."</p>
          <div class="foot">
            <span class="price">42.000VND</span>
            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="id" value="4">
              <input type="hidden" name="name" value="Latte socola marou">
              <input type="hidden" name="price" value="42000">
              <input type="number" name="quantity" value="1" min="1">
              <button type="submit" name="add_to_cart" class="btn btn-dh">🛒 Đặt mua</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Sản phẩm 5 -->
      <div class="course-item">
        <img src="./coffeeshopdestop-master/assets/img/cfsua2.jpg" alt="Cà phê sữa" class="thumb">
        <div class="info">
          <h3 class="title">Cà phê sữa</h3>
          <p class="desc">"Cà phê sữa, một chút thôi...mà khiến lòng chợt bồi hồi, nhớ ai..."</p>
          <div class="foot">
            <span class="price">29.000VND</span>
            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="id" value="5">
              <input type="hidden" name="name" value="Cà phê sữa">
              <input type="hidden" name="price" value="29000">
              <input type="number" name="quantity" value="1" min="1">
              <button type="submit" name="add_to_cart" class="btn btn-dh">🛒 Đặt mua</button>
            </form>
          </div>
        </div>
      </div>

      <!-- Sản phẩm 6 -->
      <div class="course-item">
        <img src="./coffeeshopdestop-master/assets/img/americano3.jpg" alt="Americano" class="thumb">
        <div class="info">
          <h3 class="title">Americano</h3>
          <p class="desc">"Americano đen đá, tỉnh cả buổi chiều tà. Không đường, không cần ngọt, mặn mà đời vẫn qua."</p>
          <div class="foot">
            <span class="price">32.000VND</span>
            <form method="POST" action="add_to_cart.php">
              <input type="hidden" name="id" value="6">
              <input type="hidden" name="name" value="Americano">
              <input type="hidden" name="price" value="32000">
              <input type="number" name="quantity" value="1" min="1">
              <button type="submit" name="add_to_cart" class="btn btn-dh">🛒 Đặt mua</button>
            </form>
          </div>
        </div>
      </div>
             
    </div>
  </div>
</section>

<!-- Phần giới thiệu -->
<section class="feature">
  <div class="main-content">
    <div class="body">
      <div class="images">
        <img class="lower" src="./coffeeshopdestop-master/assets/img/ft1.jpg" alt="Ảnh learn">
        <img src="./coffeeshopdestop-master/assets/img/relax.jpg" alt="Ảnh relax">
      </div>
      <div class="content">
        <h2 class="heading-lv2">"Thư Giãn Cùng Cà Phê Sau Giờ Học"</h2>
        <p class="desc desc0">Sau những giờ học căng thẳng, một ly cà phê nhẹ nhàng như món quà nhỏ giúp xoa dịu tâm trí...</p>
      </div>
    </div>
  </div>
</section>
               <div class="feature ft2">
          <div class="main-content">
          <div class="body">
          <div class="images">
          <img src="./coffeeshopdestop-master/assets/img/ft2.jpg" alt="Ảnh bóng đèn sáng tạo">
          </div>
        <div class="content">
          <h2 class="heading-lv2">"Cà phê – Nơi ý tưởng lặng lẽ nảy mầm"</h2>
          <p class="desc desc0">Đôi khi, cảm hứng không đến từ những điều ồn ào, mà khẽ chạm trong khoảnh khắc lặng yên, khi ta ngồi trước ly cà phê còn nóng. Mùi thơm trầm ấm, vị đắng nhẹ nơi đầu lưỡi như nhắc nhở rằng: mọi điều sáng tạo đều bắt đầu từ tĩnh lặng. Cà phê không thúc ép ta phải vội, mà chậm rãi mở ra một không gian – nơi suy nghĩ được buông lơi, ý tưởng được lắng nghe, và cảm xúc được viết nên thành câu chữ. Trong chiếc cốc nhỏ, đôi khi là cả một thế giới đang hình thành.</p>

        </div>
          </div>
          </div>
        </div>
        <!-- main -->
        </div>
      </div>
    </main>
    <!-- footer -->
     <footer class="footer">
    <div class="main-content">
      <div class="row">
        <!-- clum1 -->
        <div class="column">
          <a href="https://www.facebook.com/khanhvu.2912/" target="_blank" class="Logo1">22COFFEE</a>
        </div>
        <!-- clum2 -->
        <div class="column">
          <h3 class="title">Giới thiệu</h3>
          <ul class="list">
            <li><a href="!#" target="_blank">Về chúng tôi</a></li>
            <li><a href="!#" target="_blank">Sản phẩm</a></li>
            <li><a href="!#" target="_blank">Tuyển dụng</a></li>
          </ul>
        </div>
        <!-- clum3 -->
        <div class="column">
          <h3 class="title">Liên hệ</h3>
          <ul class="list">
             <li><a href="!#" target="_blank"><strong>Địa chỉ</strong>: Yên Bái City</a></li>
            <li><a href="mailto:Khanhvu@gmail.com"><strong>Email</strong>: VuKhanh12345.com@gmail.com@gmail.com</a></li>
            <li><a href="tel:0395367117
              "><strong>Phone</strong>: 0395367117</a></li>
          </ul>
        </div>
        <!-- clum4 -->
        <div class="column">
          <h3 class="title">The 22Coffee</h3>
          <div class="social"><a href="https://www.facebook.com/khanhvu.2912/" target="_blank">
            <img src="./coffeeshopdestop-master/assets/img/f.svg" alt="Logo Facebook" class="icon"></a>
            <a href="https://www.instagram.com/___khanhvu/" target="_blank">
              <img src="./coffeeshopdestop-master/assets/img/instagram.svg" alt="Logo Instagram" class="icon">
            </a></div>
        </div>
      </div>  
      <div class="copyright">
        <p>Copyright ©2025 22COFFEE - Design by Vu Trong Khanh</p>
      </div>
    </div>
     </footer>
<img src="./coffeeshopdestop-master/uploads/<?= $row['Image'] ?>" alt="<?= $row['ProductName'] ?>">

  </body>
</html>
