<?php
require_once '../model/ChapterModel.php';
require_once '../model/TruyenModel.php';
require_once '../model/CommonModel.php';

$chapter = new ChapterModel();
$truyen = new TruyenModel();
$cm = new CommonModel();

// Lấy số trang từ tham số truyền vào hoặc mặc định là 1
$page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
$tai_khoan_id = $_SESSION['user']->tai_khoan_id;
// Lấy danh sách truyện cho trang hiện tại
$truyen__Get_User_Paged = $truyen->Truyen__Get_User_Paged($page_number, $tai_khoan_id, 3);
?>

<main class="main">
    <div class="main-container">
        <div class="main-title-container">
            <a href="index.php?pages=truyen-theo-doi">
                <div class="item-title color-1"><i class='bx bx-star bx-tada'></i>TRUYỆN ĐÃ THEO DÕI <?= count($truyen__Get_User_Paged) ?></div>
            </a>
        </div>
        <div class="main-item-container">
            <?php if (count($truyen__Get_User_Paged) > 0) : ?>
                <?php foreach ($truyen__Get_User_Paged as $item) : ?>
                    <a href="index.php?pages=truyen-xem&truyen_id=<?= $item->truyen_id ?>&chapter_id=<?= $item->chapter_id ?>&chapter_so=<?= $item->chapter_so ?>">
                        <div class="manga-container">
                            <div class="manga-thumbnail">
                                <img src="../assets/<?= $item->truyen_anh_bia ?>">
                                <span class="manga-note background-1">Chap <?= $item->chapter_so ?> <i class="bx bxs-star"></i></span>
                            </div>
                            <div class="manga-title color-1"><?= $item->truyen_ten ?></div>
                        </div>
                    </a>
                <?php endforeach ?>
            <?php else : ?>
                <a href="index.php?pages=trang-chu">
                    <div class="manga-title color-1 m-3">Bạn chưa theo dõi truyện nào
                    </div>
                </a>
            <?php endif ?>
        </div>
    </div>

    <div class="pagination-container">
        <div class="pagination">
            <?php
            $total_pages = ceil(count($truyen__Get_User_Paged) / 10);

            // Hiển thị nút đầu trang
            if ($page_number > 1) {
                echo '<a href="index.php?pages=truyen-theo-doi&page=1" class="pagination-link">Đầu trang</a>';
            }

            // Hiển thị nút trước
            if ($page_number > 1) {
                echo '<a href="index.php?pages=truyen-theo-doi&page=' . ($page_number - 1) . '" class="pagination-link">Trang trước</a>';
            }

            // Hiển thị các trang gần đó
            for ($i = max(1, $page_number - 2); $i <= min($page_number + 2, $total_pages); $i++) {
                echo '<a href="index.php?pages=truyen-theo-doi&page=' . $i . '" class="pagination-link ' . ($page_number == $i ? 'active' : '') . '">' . $i . '</a>';
            }

            // Hiển thị nút sau
            if ($page_number < $total_pages) {
                echo '<a href="index.php?pages=truyen-theo-doi&page=' . ($page_number + 1) . '" class="pagination-link">Trang sau</a>';
            }

            // Hiển thị nút cuối trang
            if ($page_number < $total_pages) {
                echo '<a href="index.php?pages=truyen-theo-doi&page=' . $total_pages . '" class="pagination-link">Cuối trang</a>';
            }
            ?>
        </div>
    </div>

</main>