<?php
require_once '../model/ChapterModel.php';
require_once '../model/ChapterNoiDungModel.php';
require_once '../model/TruyenModel.php';
require_once '../model/TheLoaiModel.php';
require_once '../model/TruyenTheLoaiModel.php';
require_once '../model/CommonModel.php';
$chapter = new ChapterModel();
$chapterNoiDung = new ChapterNoiDungModel();
$truyen = new TruyenModel();
$truyenTheLoai = new TruyenTheLoaiModel();
$theLoai = new TheLoaiModel();
$cm = new CommonModel();

function getRandomColor()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

$itemColors = [];

if (!isset($_GET['truyen_id'])) {

    return;
}
if (!isset($_GET['chapter_id'])) {
    return;
}
if (!isset($_GET['chapter_so'])) {
    return;
}
$truyen_id = $_GET['truyen_id'];
$chapter_id = $_GET['chapter_id'];
$chapter_so = $_GET['chapter_so'];

$chapterNoiDung__Get_By_Chapter_Id = $chapterNoiDung->ChapterNoiDung__Get_By_Chapter_Id($chapter_id);

$truyen__Get_By_Id = $truyen->Truyen__Get_By_Id($truyen_id);
$chapter__Get_By_Id_Truyen = $chapter->Chapter__Get_By_Truyen_Id($truyen_id);
$chapter__Get_Latest_By_Truyen_Id = $chapter->Chapter__Get_Latest_By_Truyen_Id($truyen_id);
$chapter__Get_Firsr_By_Truyen_Id = $chapter->Chapter__Get_First_By_Truyen_Id($truyen_id);
$truyen__Get_Top_Viewed = $truyen->Truyen__Get_Top_Viewed();
$truyenTheLoai__Get_By_Truyen_Id = $truyenTheLoai->TruyenTheLoai__Get_By_Truyen_Id($truyen_id);
$truyen__Get_Top_Random_Same = $truyen->Truyen__Get_Top_Random_Same($truyen_id);
$top = 0;

?>
<main class="main">
    <div class="main-container">
        <div class="main-container__chitiet__left">
            <div class="main-title-container">
                <a href="">
                </a>
            </div>
            <div class="manga-container__chitiet__left">
                <a href="#" onclick="return false">
                    <div class="manga-thumbnail">
                        <img src="../assets/<?=$truyen__Get_By_Id->truyen_anh_bia ?>">
                        <span class="manga-note background-2"><?= $cm->getTimeAgo($truyen__Get_By_Id->truyen_ngay_dang); ?>
                            <i class="bx bxs-star"></i></span>
                    </div>
                </a>
                <div class="manga-truyen-container__chitiet__left">
                    <div class="manga-title color-2"><?= $truyen__Get_By_Id->truyen_ten ?></div>
                    <div class="truyen-container__top">
                        <a href="index.php?pages=truyen-xem&truyen_id=<?= $chapter__Get_Firsr_By_Truyen_Id->truyen_id ?>&chapter_id=<?= $chapter__Get_Firsr_By_Truyen_Id->chapter_id ?>&chapter_so=<?= $chapter__Get_Firsr_By_Truyen_Id->chapter_so ?>">
                            <span class="truyen-note background-4">
                                Đọc từ đầu
                            </span>
                        </a>
                        <div class="truyen-item-container__chitiet__left">
                            <div class="tab-group-1">
                                <div class="truyen-author">Tác giả:</div>
                                <div class="truyen-status">Tình trạng:</div>
                                <div class="truyen-views">Lượt xem:</div>
                                <div class="truyen-new">Mới nhất:</div>
                            </div>
                            <div class="tab-group-2">
                                <div class="truyen-author"> <?= $truyen__Get_By_Id->truyen_tac_gia ?></div>
                                <div class="truyen-status">
                                    <?= $truyen__Get_By_Id->truyen_tinh_trang == 1 ? 'Đang tiến hành' : ($truyen__Get_By_Id->truyen_tinh_trang == 2 ? 'Đã hoàn thành' : 'Tạm ngừng...') ?>
                                </div>
                                <div class="truyen-views" id="view-count">
                                    <?= number_format($truyen__Get_By_Id->truyen_luot_xem) ?></div>
                                <div class="truyen-new color-1">Chap
                                    <?= $chapter__Get_Latest_By_Truyen_Id->chapter_so ?></div>
                            </div>
                        </div>
                        <div class="truyen-item-container__chitiet__left">
                            <div class="tab-group-1">
                                <div class="truyen-thich">
                                    <div class="btn btn-sm color-0 background-7" onclick="likeTruyen('<?= $truyen_id ?>', '<?= $chapter_id ?>')">
                                        <i class="bx bx bx-book-heart"></i> Thích (<small id="thich-count"><?= number_format($truyen__Get_By_Id->truyen_luot_thich) ?></small>)
                                    </div>
                                </div>
                            </div>
                            <div class="tab-group-2">
                                <div class="truyen-theo-doi">
                                    <div class="btn btn-sm color-0 background-6" onclick="followTruyen('<?= $truyen_id ?>', '<?= $chapter_id ?>')">
                                        <i class="bx bx-book-bookmark"></i> Theo dõi (<small id="theo-doi-count"><?= number_format($truyen__Get_By_Id->truyen_luot_theo_doi) ?></small>)
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="truyen-item-container__chitiet__bottom">
                            <?php
                            foreach ($truyenTheLoai__Get_By_Truyen_Id as $item) {
                                $itemName = $item->the_loai_ten;
                                $itemColors[$itemName] = getRandomColor();
                            }
                            ?>

                            <?php if (count($truyenTheLoai__Get_By_Truyen_Id) > 0) : ?>
                                <?php foreach ($truyenTheLoai__Get_By_Truyen_Id as $item) : ?>
                                    <?php
                                    $itemName = $item->the_loai_ten;
                                    $badgeColor = isset($itemColors[$itemName]) ? $itemColors[$itemName] : 'secondary';
                                    ?>
                                    <span class="badge" style="background-color: <?= $badgeColor ?>;"><?= $itemName ?></span>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <span class="badge bg-secondary">Không có thể loại</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container__right">
            <br>
            <div class="main-item-container__right__text">
                <?= $truyen__Get_By_Id->truyen_mo_ta ?>
            </div>
        </div>
    </div>



    <div class="chapter-selection-container">
        <div class="chapter-selection-blur"></div>

        <div class="chapter-selection">
            <?php
            $previousChapter = $chapter_so - 1;
            $nextChapter = $chapter_so + 1;

            $previousChapterInfo = $chapter->Chapter__Get_By_Chap_So($truyen_id, $previousChapter);
            $nextChapterInfo = $chapter->Chapter__Get_By_Chap_So($truyen_id, $nextChapter);
            ?>

            <?php if ($previousChapterInfo) : ?>
                <a href="index.php?pages=truyen-xem&truyen_id=<?= $truyen_id ?>&chapter_id=<?= $previousChapterInfo->chapter_id ?>&chapter_so=<?= $previousChapter ?>" class="btn btn-sm background-3">
                    <i class="bx bx-left-arrow color-0"></i>
                </a>
            <?php endif; ?>

            <select id="chapterSelect" class="form-select" onchange="location.href = this.value">
                <?php foreach ($chapter__Get_By_Id_Truyen as $item) : ?>
                    <option value="index.php?pages=truyen-xem&truyen_id=<?= $truyen_id ?>&chapter_id=<?= $item->chapter_id ?>&chapter_so=<?= $item->chapter_so ?>" <?= $item->chapter_so == $chapter_so ? 'selected' : '' ?>>
                        Chap <?= $item->chapter_so ?>
                    </option>
                <?php endforeach ?>
            </select>

            <?php if ($nextChapterInfo) : ?>
                <a href="index.php?pages=truyen-xem&truyen_id=<?= $truyen_id ?>&chapter_id=<?= $nextChapterInfo->chapter_id ?>&chapter_so=<?= $nextChapter ?>" class="btn btn-sm background-3">
                    <i class="bx bx-right-arrow color-0"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <div class="main-container-images">
        <div class="main-content-images">
            <?php if (count($chapterNoiDung__Get_By_Chapter_Id) > 0) : ?>
                <?php foreach ($chapterNoiDung__Get_By_Chapter_Id as $item) : ?>
                    <img src="../assets/<?= $item->chapter_noi_dung_image ?>">
                <?php endforeach ?>
            <?php else : ?>
                <div class="manga-container__comming_soon">
                    <div class="manga-thumbnail">
                        <img src="../assets/<?=$truyen__Get_By_Id->truyen_anh_bia ?>">
                        <span class="manga-note background-10">
                            Coming Soon!
                    </div>
                    <div class="blur"></div>
                    <div class="manga-title color-3">Coming Soon!</div>
                </div>
            <?php endif ?>
        </div>
    </div>

</main>



<script>
    window.addEventListener('load', function() {
        viewTruyen('<?= $truyen_id ?>', '<?= $chapter_id ?>');
    });
</script>