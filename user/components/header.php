<?php
// Import TheLoaiModel class
require_once "../model/TheLoaiModel.php";
require_once "../model/NhomTruyenModel.php";
$theLoai = new TheLoaiModel();
$nhomTruyen = new NhomTruyenModel();
// Lấy danh sách thể loại
$theLoai__Get_All = $theLoai->theLoai__Get_All();
$nhomTruyen__Get_All = $nhomTruyen->nhomTruyen__Get_All();
?>

<!-- Thẻ chứa thanh điều hướng -->
<nav class="navbar">
    <!-- Thẻ chứa nội dung thanh điều hướng -->
    <div class="navbar-container">
        <!-- Phần bên trái thanh điều hướng -->
        <div class="navbar-logo-menu">
            <!-- Logo -->
            <a class="navbar-logo" href="./index.php">
                <img alt="logo" src="../assets/images/logo.png">
            </a>
            <!-- Nút điều hướng trên điện thoại -->
            <div class="navbar-toggle"><i class="bx bx-menu"></i></div>
            <!-- Menu điều hướng -->
            <div class="navbar-menu">
                <!-- Ô tìm kiếm -->
                <div class="navbar-search">
                    <input id="search-box" type="text" name="search" autocomplete="off">
                    <div class="icon">
                        <i class="bx bx-search"></i>
                    </div>
                </div>
                <!-- Danh sách -->
                <div class="navbar-item has-sub">
                    <a href="index.php?pages=nhom-truyen"><i class='bx bx-category-alt'></i>Danh sách</a>
                    <ul class="navbar-item-sub">
                        <div class="menu-country">
                            <?php foreach ($nhomTruyen__Get_All as $item) : ?>
                                <li><a href="index.php?pages=nhom-truyen&nhom_truyen_id=<?= $item->nhom_truyen_id?>"><?= $item->nhom_truyen_ten ?></a></li>
                            <?php endforeach ?>
                        </div>
                        <div class="menu-genre">
                            <?php foreach ($theLoai__Get_All as $item) : ?>
                                <li>
                                    <a href="index.php?pages=truyen-the-loai&the_loai_id=<?= $item->the_loai_id ?>">
                                        <?= $item->the_loai_ten ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </div>
                    </ul>
                </div>
                <!-- Truyện hot -->
                <div class="navbar-item"><a href="index.php?pages=truyen-top"><i class='bx bxs-hot bx-burst' style='color:#ff0004'></i>Truyện
                        Hot</a></div>

                <!-- Nút đóng menu -->
                <div class="navbar-close">
                    <i class="bx bx-x"></i>
                </div>
            </div>
        </div>
        <!-- Phần bên phải thanh điều hướng -->
        <div class="navbar-display-user-action">
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- display-user người dùng đã đăng nhập -->
                <div class="navbar-display-user">
                    <i class='bx bxs-user-detail'></i>
                </div>
                <!-- Menu hành động của người dùng -->
                <div class="navbar-display-action hidden">
                    <a href="#">
                        <li><b><i class='bx bx-user-check'></i><?= $_SESSION['user']->ten_hien_thi ?></b></li>
                    </a>
                    <a href="index.php?pages=truyen-da-xem">
                        <li> <i class='bx bx-book-reader'></i> Truyện đã xem</li>
                    </a>
                    <a href="index.php?pages=truyen-da-thich">
                        <li> <i class='bx bx-book-heart'></i> Truyện đã thích</li>
                    </a>
                    <a href="index.php?pages=truyen-theo-doi">
                        <li><i class='bx bx-book-bookmark'></i> Đang theo dõi</li>
                    </a>
                    <hr>
                    <a href="../auth/pages/chinh-sua.php">
                        <li> <i class='bx bx-cog'></i> Chỉnh sửa</li>
                    </a>
                    <hr>
                    <a href="../auth/pages/action.php?req=dang-xuat">
                        <li><i class='bx bx-log-out'></i> Đăng xuất</li>
                    </a>
                </div>
            <?php else : ?>
                <!-- display-user người dùng chưa đăng nhập -->
                <div class="navbar-display-user">
                    <i class="bx bx-user"></i>
                </div>
                <!-- Menu hành động khi chưa đăng nhập -->
                <div class="navbar-display-action hidden">
                    <li><i class='bx bx-log-in'></i> <a href="../auth?pages=dang-nhap">Đăng nhập</a></li>
                </div>
            <?php endif ?>
        </div>
    </div>
</nav>

<!-- Nút hành động nổi -->
<div class="floating-action">
    <!-- Nút chuyển đổi tìm kiếm -->
    <div class="action-item action-toggle"><i class="bx bx-target-lock"></i></div>
    <!-- Nút trang chủ -->
    <div class="action-item action-home"><i class="bx bx-home"></i></div>
    <!-- Nút menu -->
    <div class="action-item action-menu"><i class="bx bx-menu"></i></div>
    <!-- Nút người dùng -->
    <div class="action-item action-user"><i class="bx bx-user"></i></div>
    <!-- Nút lên đầu trang -->
    <div class="action-item action-top"><i class="bx bx-chevron-up"></i></div>
</div>