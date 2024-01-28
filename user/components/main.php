<?php
if (isset($_GET['pages']) && !isset($_GET['req'])) {
    switch ($_GET['pages']) {
        case "trang-chu":
            require_once "pages/trang-chu/index.php";
            break;
        case "nhom-truyen":
            require_once "pages/nhom-truyen/index.php";
            break;
        case "truyen-top":
            require_once "pages/truyen-top/index.php";
            break;
        case "truyen-moi":
            require_once "pages/truyen-moi/index.php";
            break;
        case "truyen-ngau-nhien":
            require_once "pages/truyen-ngau-nhien/index.php";
            break;
        case "truyen-hot":
            require_once "pages/truyen-hot/index.php";
            break;
        case "truyen-the-loai":
            require_once "pages/truyen-the-loai/index.php";
            break;
        case "truyen-tim-kiem":
            require_once "pages/truyen-tim-kiem/index.php";
            break;
        case "truyen-chi-tiet":
            require_once "pages/truyen-chi-tiet/index.php";
            break;
        case "truyen-xem":
            require_once "pages/truyen-xem/index.php";
            break;

        case "truyen-da-xem":
            require_once "pages/truyen-da-xem/index.php";
            break;

        case "truyen-da-thich":
            require_once "pages/truyen-da-thich/index.php";
            break;

        case "truyen-theo-doi":
            require_once "pages/truyen-theo-doi/index.php";
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
