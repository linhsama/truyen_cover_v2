<?php
require_once '../model/ChapterModel.php';
require_once '../model/TruyenModel.php';
require_once '../model/TheLoaiModel.php';
require_once '../model/TruyenTheLoaiModel.php';
require_once '../model/CommonModel.php';
$chapter = new ChapterModel();
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
$truyen_id = $_GET['truyen_id'];

$truyen__Get_By_Id = $truyen->Truyen__Get_By_Id($truyen_id);
$chapter__Get_By_Id_Truyen = $chapter->Chapter__Get_By_Truyen_Id($truyen_id);
$chapter__Get_Latest_By_Truyen_Id = $chapter->Chapter__Get_Latest_By_Truyen_Id($truyen_id);
$truyen__Get_Top_Viewed = $truyen->Truyen__Get_Top_Viewed();
$truyenTheLoai__Get_By_Truyen_Id = $truyenTheLoai->TruyenTheLoai__Get_By_Truyen_Id($truyen_id);
$truyen__Get_Top_Random_Same = $truyen->Truyen__Get_Top_Random_Same($truyen_id);
$chapter_id = $chapter->Chapter__Get_First_By_Truyen_Id($truyen_id)->chapter_id;
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
                        <img src="../assets/<?= $truyen__Get_By_Id->truyen_anh_bia ?>">
                        <span class="manga-note background-2"><?= $cm->getTimeAgo($truyen__Get_By_Id->truyen_ngay_dang); ?> <i class="bx bxs-star"></i></span>
                    </div>
                </a>
                <div class="manga-truyen-container__chitiet__left">
                    <div class="manga-title color-2"><?= $truyen__Get_By_Id->truyen_ten ?></div>
                    <div class="truyen-container__top">
                        <?php if (isset($chapter__Get_Latest_By_Truyen_Id->truyen_id)) : ?>
                            <a href="index.php?pages=truyen-xem&truyen_id=<?= $chapter__Get_Latest_By_Truyen_Id->truyen_id ?>&chapter_id=<?= $chapter__Get_Latest_By_Truyen_Id->chapter_id ?>&chapter_so=<?= $chapter__Get_Latest_By_Truyen_Id->chapter_so ?>">
                                <span class="truyen-note background-4">
                                    Đọc từ đầu
                                </span>
                            </a>
                        <?php else : ?>
                            <a href="#">
                                <span class="truyen-note background-4">
                                    Đang cập nhật...
                                </span>
                            </a>
                        <?php endif ?>

                        <div class="truyen-item-container__chitiet__left">
                            <div class="tab-group-1">
                                <div class="truyen-author">Tác giả:</div>
                                <div class="truyen-status">Tình trạng:</div>
                                <div class="truyen-views">Lượt xem:</div>
                                <div class="truyen-new">Mới nhất:</div>
                            </div>
                            <div class="tab-group-2">
                                <div class="truyen-author"> <?= $truyen__Get_By_Id->truyen_tac_gia ?></div>
                                <div class="truyen-status"> <?= $truyen__Get_By_Id->truyen_tinh_trang == 1 ? 'Đang tiến hành' : ($truyen__Get_By_Id->truyen_tinh_trang == 2 ? 'Đã hoàn thành' : 'Tạm ngừng...') ?></div>
                                <div class="truyen-views"> <?= number_format($truyen__Get_By_Id->truyen_luot_xem) ?></div>
                                <?php if (isset($chapter__Get_Latest_By_Truyen_Id->truyen_id)) : ?>

                                    <div class="truyen-new color-1">Chap <?= $chapter__Get_Latest_By_Truyen_Id->chapter_so ?></div>

                                <?php else : ?>
                                    <div class="truyen-new color-1">Đang cập nhật...</div>

                                <?php endif ?>
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

                    </div>
                </div>
            </div>
            <div class="manga-container__chitiet__bottom">
                <div class="manga-truyen-container__chitiet__bottom">
                    <div class="manga-title color-7">NỘI DUNG</div>
                    <div class="chapter-container__chitiet__bottom__noi_dung">
                        <?php if ($truyen__Get_By_Id->truyen_mo_ta != "") : ?>
                            <?= $truyen__Get_By_Id->truyen_mo_ta ?>
                        <?php else : ?>
                            <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $item->truyen_id ?>">
                                <span class="chapter-name"></span>Đang cập nhật...</span>
                            </a>
                        <?php endif ?>
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
            <div class="manga-container__chitiet__bottom">
                <div class="manga-truyen-container__chitiet__bottom">
                    <div class="manga-title color-7">DANH SÁCH CHAP</div>
                    <div class="chapter-container__chitiet__bottom">
                        <?php if (count($chapter__Get_By_Id_Truyen) > 0) : ?>
                            <div class="chapter-item-container__chitiet__bottom">
                                <div class="chapter-name text-title">Tên chap</div>
                                <div class="chapter-time text-title">Cập nhật</div>
                            </div>
                            <div class="chapter-item-container__chitiet__bottom chapter-list">
                                <?php foreach ($chapter__Get_By_Id_Truyen as $item) : ?>
                                    <span class="hr"></span>
                                    <a href="index.php?pages=truyen-xem&truyen_id=<?= $item->truyen_id ?>&chapter_id=<?= $item->chapter_id ?>&chapter_so=<?= $item->chapter_so ?>">
                                        <div class="chapter-item-container__chitiet__bottom">
                                            <div class="chapter-name">Chap <?= $item->chapter_so ?></div>
                                            <div class="chapter-time"><?= $cm->getTimeAgo($item->chapter_ngay_cap_nhat) ?></div>
                                        </div>
                                    </a>
                                <?php endforeach ?>
                                <span class="hr"></span>
                            </div>
                        <?php else : ?>
                            <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $item->truyen_id ?>">
                                <div class="chapter-item-container">
                                    <span class="chapter-name"></span>Đang cập nhật...</span>
                                </div>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container__right">
            <div class="main-title-container__right">
                <a href="">
                    <div class="item-title color-7"><i class='bx bx-star bx-tada'></i>TOP VIEW</div>
                </a>
            </div>
            <div class="main-item-container__right">
                <?php foreach ($truyen__Get_Top_Viewed as $truyen__Get_By_Id) : ?>
                    <?php if (count($truyen__Get_Top_Viewed) > 0) : ?>
                        <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $truyen__Get_By_Id->truyen_id ?>">
                            <div class="manga-container__right" id="top_<?= $top++ ?>">
                                <div class="manga-thumbnail">
                                    <img src="../assets/<?= $truyen__Get_By_Id->truyen_anh_bia ?>">
                                    <span class="manga-note background-7"> <b>Top <?= $top ?></b> | <?= $cm->formatThousand($truyen__Get_By_Id->truyen_luot_xem) ?> views</span>
                                </div>
                                <div class="blur"></div>
                                <div class="manga-title color-3"><?= $truyen__Get_By_Id->truyen_ten ?></div>
                            </div>
                        </a>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="main-title-container">
            <a href="">
                <div class="item-title color-8"><i class='bx bx-book-reader'></i>TRUYỆN CÙNG THỂ LOẠI!</div>
            </a>
        </div>
        <div class="main-item-container">
            <?php foreach ($truyen__Get_Top_Random_Same as $item) : ?>
                <?php if (count($truyen__Get_Top_Random_Same) > 0) : ?>
                    <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $item->truyen_id ?>">
                        <div class="manga-container">
                            <div class="manga-thumbnail">
                                <img src="../assets/<?= $item->truyen_anh_bia ?>">
                                <span class="manga-note background-8"><?= $cm->formatThousand($item->truyen_luot_xem) ?> lượt xem</i></span>
                            </div>
                            <div class="manga-title color-8"><?= $item->truyen_ten ?></div>
                        </div>
                    </a>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
</main>