<!-- header.php -->
<ul class="nav-buttons">
  <li><a href="home.php" class="btn">Home</a></li>
  <li><a href="menu.php" class="btn">Menu</a></li>
  <li><a href="contact.php" class="btn">Contact</a></li>
</ul>

<style>
.nav-buttons {
    list-style: none;
    display: flex;
    gap: 10px;
    padding: 0;
}

.nav-buttons li {
    display: inline-block;
}

.nav-buttons a.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #6b4f34;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.nav-buttons a.btn:hover {
    background-color: #543a25;
}
</style>
