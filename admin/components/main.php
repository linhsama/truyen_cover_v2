<?php
if (isset($_GET['pages']) && !isset($_GET['req'])) {
    switch ($_GET['pages']) {
        case "trang-chu":
            require_once "pages/trang-chu/index.php";
            break;
        case "truyen":
            require_once "pages/truyen/index.php";
            break;
        case "chapter":
            require_once "pages/chapter/index.php";
            break;
        case "chapter-noi-dung":
            require_once "pages/chapter/c_index.php";
            break;
        case "the-loai":
            require_once "pages/the-loai/index.php";
            break;
        case "nhom-truyen":
            require_once "pages/nhom-truyen/index.php";
            break;
        case "tai-khoan":
            require_once "pages/tai-khoan/index.php";
            break;
        case "trang-loi":
            require_once "pages/trang-loi/index.php";
            break;
        default:
            echo "<script>location.href='index.php?pages=trang-loi'</script>";
            break;
    }
} else {
    echo "<script>location.href='index.php?pages=trang-chu'</script>";
}
