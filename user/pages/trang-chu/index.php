<?php
require_once '../model/ChapterModel.php';
require_once '../model/TruyenModel.php';
require_once '../model/CommonModel.php';
$chapter = new ChapterModel();
$truyen = new TruyenModel();
$cm = new CommonModel();
$truyen__Get_Top_Updated_6 = $truyen->Truyen__Get_Top_Updated(6);
$truyen__Get_Top_Updated_8 = $truyen->Truyen__Get_Top_Updated(8);
$Truyen__Get_Top_Viewed = $truyen->Truyen__Get_Top_Viewed();
$truyen__Get_Top_Random = $truyen->Truyen__Get_Top_Random();

$top = 0;
?>
<main class="main">

    <div class="main-container">
        <div class="main-title-container">
            <a href="index.php?pages=truyen-moi&page=1">
                <div class="item-title color-1"><i class='bx bx-star bx-tada'></i>MỚI CẬP NHẬT</div>
            </a>
        </div>
        <div class="main-item-container">
            <?php foreach ($truyen__Get_Top_Updated_6 as $item) : ?>
                <?php if (count($truyen__Get_Top_Updated_6) > 0) : ?>
                    <?php $chapter__Get_Latest_By_Truyen_Id = $chapter->Chapter__Get_Latest_By_Truyen_Id($item->truyen_id); ?>
                    <?php if (isset($chapter__Get_Latest_By_Truyen_Id->truyen_id)) : ?>
                        <a href="index.php?pages=truyen-xem&truyen_id=<?= $chapter__Get_Latest_By_Truyen_Id->truyen_id ?>&chapter_id=<?= $chapter__Get_Latest_By_Truyen_Id->chapter_id ?>&chapter_so=<?= $chapter__Get_Latest_By_Truyen_Id->chapter_so ?>">
                            <div class="manga-container">
                                <div class="manga-thumbnail">
                                    <img src="../assets/<?= $item->truyen_anh_bia ?>">
                                    <span class="manga-note background-1">Chap <?= $item->chapter_so ?> <i class="bx bxs-star"></i></span>
                                </div>
                                <div class="manga-title color-1"><?= $item->truyen_ten ?></div>
                            </div>
                        </a>
                    <?php else : ?>
                        <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $item->truyen_id ?>">
                            <div class="manga-container">
                                <div class="manga-thumbnail">
                                    <img src="../assets/<?= $item->truyen_anh_bia ?>">
                                    <span class="manga-note background-1">Đang cập nhật... <i class="bx bxs-star"></i></span>
                                </div>
                                <div class="manga-title color-1"><?= $item->truyen_ten ?></div>
                            </div>
                        </a>
                    <?php endif ?>
                <?php endif ?>
            <?php endforeach ?>


        </div>
    </div>

    <div class="main-container">
        <div class="main-container__left">
            <div class="main-title-container__left">
                <a href="index.php?pages=truyen-manga">
                    <div class="item-title color-2"><i class='bx bx-star bx-tada'></i>TRUYỆN HAY MỖI NGÀY</div>
                </a>
            </div>
            <div class="main-item-container__left">
                <?php foreach ($truyen__Get_Top_Updated_8 as $item) : ?>
                    <?php if (count($truyen__Get_Top_Updated_8) > 0) : ?>
                        <div class="manga-container__left">
                            <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $item->truyen_id ?>">
                                <div class="manga-thumbnail">
                                    <img src="../assets/<?= $item->truyen_anh_bia ?>">
                                    <span class="manga-note background-2"><?= $cm->getTimeAgo($item->truyen_ngay_dang); ?> <i class="bx bxs-star"></i></span>
                                </div>
                            </a>
                            <div class="manga-chapter-container__left">
                                <div class="manga-title color-2"><?= $item->truyen_ten ?></div>
                                <span class="chapter-views"><?= $cm->formatThousand($item->truyen_luot_xem) ?> lượt xem</span>
                                <div class="chapter-container__left">
                                    <span class="chapter-note">Chap mới nhất</span>
                                    <?php $chapter__Get_By_Truyen_Id_Limit_5 = $chapter->Chapter__Get_By_Truyen_Id_Limit_5($item->truyen_id); ?>
                                    <?php if (count($chapter__Get_By_Truyen_Id_Limit_5) > 0) : ?>
                                        <?php foreach ($chapter__Get_By_Truyen_Id_Limit_5 as $item_chap_moi) : ?>
                                            <span class="hr"></span>
                                            <a href="index.php?pages=truyen-xem&truyen_id=<?= $item_chap_moi->truyen_id ?>&chapter_id=<?= $item_chap_moi->chapter_id ?>&chapter_so=<?= $item_chap_moi->chapter_so ?>">
                                                <div class="chapter-item-container__left">
                                                    <div class="chapter-name">Chap <?= $item_chap_moi->chapter_so ?></div>
                                                    <div class="chapter-time">
                                                        <?= $cm->getTimeAgo($item_chap_moi->chapter_ngay_cap_nhat) ?></div>
                                                </div>
                                            </a>
                                        <?php endforeach ?>
                                        <span class="hr"></span>
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
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </div>

        <div class="main-container__right">
            <div class="main-title-container__right">
                <a href="index.php?pages=truyen-top">
                    <div class="item-title color-3"><i class='bx bx-star bx-tada'></i>TOP VIEW</div>
                </a>
            </div>
            <div class="main-item-container__right">
                <?php foreach ($Truyen__Get_Top_Viewed as $truyen__Get_By_Id) : ?>
                    <?php if (count($Truyen__Get_Top_Viewed) > 0) : ?>
                        <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $truyen__Get_By_Id->truyen_id ?>">
                            <div class="manga-container__right" id="top_<?= $top++ ?>">
                                <div class="manga-thumbnail">
                                    <img src="../assets/<?= $truyen__Get_By_Id->truyen_anh_bia ?>">
                                    <span class="manga-note background-7"> <b>Top <?= $top ?></b> |
                                        <?= $cm->formatThousand($truyen__Get_By_Id->truyen_luot_xem) ?> views</span>
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
            <a href="index.php?pages=truyen-ngau-nhien">
                <div class="item-title color-8"><i class='bx bx-book-reader'></i>HÔM NAY XEM GÌ!</div>
            </a>
        </div>
        <div class="main-item-container">
            <?php foreach ($truyen__Get_Top_Random as $item) : ?>
                <?php if (count($truyen__Get_Top_Random) > 0) : ?>
                    <a href="index.php?pages=truyen-chi-tiet&truyen_id=<?= $item->truyen_id ?>">
                        <div class="manga-container">
                            <div class="manga-thumbnail">
                                <img src="../assets/<?= $item->truyen_anh_bia ?>">
                                <span class="manga-note background-8"><?= $cm->formatThousand($item->truyen_luot_xem) ?> lượt
                                    xem</i></span>
                            </div>
                            <div class="manga-title color-8"><?= $item->truyen_ten ?></div>
                        </div>
                    </a>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    </div>
</main>