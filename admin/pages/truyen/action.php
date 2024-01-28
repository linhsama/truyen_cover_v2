<?php
require_once '../../../model/TruyenModel.php';
require_once '../../../model/TruyenTheLoaiModel.php';
require_once '../../../model/CommonModel.php';
$truyen = new TruyenModel();
$truyenTheLoai = new TruyenTheLoaiModel();
$cm = new CommonModel();

// Đường dẫn tệp ảnh mặc định
$defaultImagePath = "../../../assets/images/cover.png";

$min = 10000;
$max = 100000;
$step = 1000;

$randomNumber = 0;
// $randomNumber = floor(rand($min / $step, $max / $step)) * $step;

// Xử lý yêu cầu
if (isset($_GET['req'])) {
    switch ($_GET['req']) {
        case "add":
            $res = 0;
            $truyen_ten = $_POST['truyen_ten'];
            $truyen_tac_gia = $_POST['truyen_tac_gia'];
            $truyen_mo_ta = $_POST['truyen_mo_ta'];
            $truyen_tinh_trang = 1;
            $truyen_luot_xem = $randomNumber;
            $truyen_luot_thich = $randomNumber;
            $truyen_luot_theo_doi = $randomNumber;
            $truyen_ngay_dang = date('Y-m-d H:i:s');
            $truyen_trang_thai = $_POST['truyen_trang_thai'];
            $nhom_truyen_id = $_POST['nhom_truyen_id'];


            $res += $truyen->Truyen__Add($truyen_ten, $truyen_tac_gia, $truyen_mo_ta, 2, $truyen_tinh_trang, $truyen_luot_xem, $truyen_luot_thich, $truyen_luot_theo_doi, $truyen_ngay_dang, $truyen_trang_thai, $nhom_truyen_id);
            if ($res != 0) {
                $truyen_id = $res;
                $the_loai_id = isset($_POST['the_loai_id']) ? $_POST['the_loai_id'] : [];

                if (!empty($the_loai_id)) {
                    foreach ($the_loai_id as $item) {
                        $result_the_loai = $truyenTheLoai->TruyenTheLoai__Add($res, $item);

                        if (!$result_the_loai) {
                            header('location: ../../index.php?pages=truyen&msg=error');
                            break;
                        }
                    }
                }
                // Kiểm tra xem có tệp ảnh đã tải lên không
                if (!empty($_FILES["truyen_anh_bia"]["name"])) {
                    // Kiểm tra và xử lý tệp
                    $processedImageFilePath = $cm->processAndValidateUploadedFile($_FILES["truyen_anh_bia"], $truyen_id);

                    if ($processedImageFilePath) {
                        // Sử dụng đường dẫn tệp để hiển thị hoặc lưu vào cơ sở dữ liệu
                        echo  $truyen_anh_bia = $processedImageFilePath;
                    } else {
                        // Sử dụng hình ảnh mặc định nếu xử lý thất bại
                        $truyen_anh_bia = $defaultImagePath;
                    }
                } else {
                    // Sử dụng hình ảnh mặc định nếu không có tệp ảnh được tải lên
                    $truyen_anh_bia = $defaultImagePath;
                }
                $truyen->Truyen__Update_Anh_Bia($truyen_id, $truyen_anh_bia);
                header('location: ../../index.php?pages=truyen&msg=success');
            } else {
                header('location: ../../index.php?pages=truyen&msg=error');
            }
            break;

        case "update":
            $res = 0;
            $truyen_id = $_POST['truyen_id'];
            $truyen_ten = $_POST['truyen_ten'];
            $truyen_tac_gia = $_POST['truyen_tac_gia'];
            $truyen_mo_ta = $_POST['truyen_mo_ta'];
            $truyen_tinh_trang = $_POST['truyen_tinh_trang'];
            $truyen_luot_xem = $_POST['truyen_luot_xem'];
            $truyen_ngay_dang = $_POST['truyen_ngay_dang'];
            $truyen_trang_thai = $_POST['truyen_trang_thai'];
            $nhom_truyen_id = $_POST['nhom_truyen_id'];
            $truyen_anh_bia_cu = $_POST['truyen_anh_bia_cu'];

            // Kiểm tra xem có tệp ảnh đã tải lên không
            if (!empty($_FILES["truyen_anh_bia"]["name"])) {
                // Kiểm tra và xử lý tệp
                $processedImageFilePath = $cm->processAndValidateUploadedFile($_FILES["truyen_anh_bia"], $truyen_id);

                if ($processedImageFilePath) {
                    // Sử dụng đường dẫn tệp để hiển thị hoặc lưu vào cơ sở dữ liệu
                    $truyen_anh_bia = $processedImageFilePath;
                } else {
                    // Sử dụng hình ảnh cũ nếu không có tệp ảnh được tải lên
                    $truyen_anh_bia = $_POST['truyen_anh_bia_cu'];
                }
            } else {
                // Sử dụng hình ảnh cũ nếu không có tệp ảnh được tải lên
                $truyen_anh_bia = $_POST['truyen_anh_bia_cu'];
            }

            $the_loai_id = isset($_POST['the_loai_id']) ? $_POST['the_loai_id'] : [];

            if (!empty($the_loai_id)) {
                $res += $truyenTheLoai->TruyenTheLoai__Delete($truyen_id);

                foreach ($the_loai_id as $item) {
                    $res += $truyenTheLoai->TruyenTheLoai__Add($truyen_id, $item);
                }
            }
            if (file_exists("../../../assets/$truyen_anh_bia_cu")) {
                unlink("../../../assets/$truyen_anh_bia_cu");
            }
            $res += $truyen->Truyen__Update($truyen_id, $truyen_ten, $truyen_tac_gia, $truyen_mo_ta, $truyen_anh_bia, $truyen_tinh_trang, $truyen_trang_thai, $nhom_truyen_id);
            if ($res != 0) {
                header('location: ../../index.php?pages=truyen&msg=success');
            } else {
                header('location: ../../index.php?pages=truyen&msg=error');
            }
            break;

        case "delete":
            $res = 0;
            $truyen_id = $_GET['truyen_id'];
            // Lấy đường dẫn ảnh từ cơ sở dữ liệu
            echo $imagePath = $truyen->getImagePath($truyen_id);
            // Xóa ảnh nếu đường dẫn tồn tại
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $res += $truyen->Truyen__Delete($truyen_id);
            if ($res != 0) {
                header('location: ../../index.php?pages=truyen&msg=success');
            } else {
                header('location: ../../index.php?pages=truyen&msg=error');
            }
            break;

        default:
            break;
    }
}
