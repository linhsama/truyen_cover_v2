<?php if (isset($_GET['pages'])) : ?>
    <div id="sidebar">
        <div class="sidebar-logo">
            <div class="col-logo">
                <img src="../assets/images/logo.png" alt="logo">
            </div>
            <div class="col-menu" id="menu-bar">
                <i class='bx bx-menu'></i>
            </div>
        </div>
        <ul class="side-menu top">
            <li class="<?= $_GET['pages'] == 'trang-chu' ? "active" : "" ?>">
                <a href="index.php?pages=trang-chu">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Trang chủ</span>
                </a>
            </li>

            <li class="<?= $_GET['pages'] == 'truyen' || $_GET['pages'] == 'chapter' || $_GET['pages'] == 'chapter-noi-dung' ? "active" : "" ?>">
                <a href="index.php?pages=truyen">
                    <i class='bx bx-book-add'></i>
                    <span class="text">Quản lý truyện</span>
                </a>
            </li>
            <li class="<?= $_GET['pages'] == 'the-loai' ? "active" : "" ?>">
                <a href="index.php?pages=the-loai">
                    <i class='bx bx-category-alt'></i>
                    <span class="text">Quản lý thể loại</span>
                </a>
            </li>
            <li class="<?= $_GET['pages'] == 'nhom-truyen' ? "active" : "" ?>">
                <a href="index.php?pages=nhom-truyen">
                    <i class='bx bx-category-alt'></i>
                    <span class="text">Quản lý nhóm truyện</span>
                </a>
            </li>
            <?php if (isset($_SESSION['admin'])) : ?>
                <li class="<?= $_GET['pages'] == 'tai-khoan' ? "active" : "" ?>">
                    <a href="index.php?pages=tai-khoan">
                        <i class='bx bx-group'></i>
                        <span class="text">Quản lý tài khoản</span>
                    </a>
                </li>
            <?php endif ?>
            <li>
                <a href="../user/">
                    <i class='bx bx-desktop'></i>
                    <span class="text">Trang người dùng</span>
                </a>
            </li>
            <li>
                <a href="../auth/pages/action.php?req=dang-xuat" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
<?php endif ?>