<?php
require_once "../../../model/ChapterModel.php";
require_once "../../../model/TruyenModel.php";
require_once "../../../model/ChapterNoiDungModel.php";
require_once "../../../model/CommonModel.php";
$chapter = new ChapterModel();
$truyen = new TruyenModel();
$chapterNoiDung = new ChapterNoiDungModel();
$cm = new CommonModel();

$defaultImagePath = "../../../assets/images/cover.png";

if (isset($_GET["req"])) {
    switch ($_GET["req"]) {
        case "add":
            $chapter_ten = $_POST["chapter_ten"];
            $chapter_ngay_cap_nhat = date("Y-m-d H:i:s");
            $chapter_trang_thai = $_POST["chapter_trang_thai"];
            $truyen_id = $_POST["truyen_id"];
            $truyen_ten = $truyen->Truyen__Get_By_Id($truyen_id)->truyen_ten;
            $chapter_id = $chapter->Chapter__Add($chapter_ten, $chapter_ngay_cap_nhat, $chapter_trang_thai, $truyen_id);
            $totalRes = 0;
            // Kiểm tra xem có tệp ảnh đã tải lên không
            if (!empty($_FILES["chapter_noi_dung_image"]["name"])) {

                // Tạo một mảng để lưu trữ đường dẫn ảnh cho mỗi chapter
                $chapter_noi_dung_images = [];

                foreach ($_FILES["chapter_noi_dung_image"]["name"] as $key => $filename) {
                    // Xử lý và kiểm tra tệp ảnh
                    $processedImageFilePath = $cm->processAndValidateUploadedFile($_FILES["chapter_noi_dung_image"], $truyen_id, $key);

                    // Kiểm tra xem xử lý tệp ảnh thành công hay không
                    if ($processedImageFilePath) {
                        // Lưu đường dẫn ảnh vào mảng và thêm vào cơ sở dữ liệu
                        $chapter_noi_dung_images[$key] = $processedImageFilePath;
                        $totalRes += $chapterNoiDung->ChapterNoiDung__Add($processedImageFilePath, $chapter_id);
                    } else {
                        // Sử dụng hình ảnh mặc định nếu xử lý thất bại và thêm vào cơ sở dữ liệu
                        $chapter_noi_dung_images[$key] = $defaultImagePath;
                        $totalRes += $chapterNoiDung->ChapterNoiDung__Add($defaultImagePath, $chapter_id);
                    }
                }
            } else {
                // Sử dụng hình ảnh mặc định nếu không có tệp ảnh được tải lên và thêm vào cơ sở dữ liệu
                $totalRes += $chapterNoiDung->ChapterNoiDung__Add($defaultImagePath, $chapter_id);
            }


            if ($totalRes > 0 && $chapter_id > 0) {
                header("location: ../../index.php?pages=chapter&truyen_id=$truyen_id&msg=success");
                exit();
            } else {
                header("location: ../../index.php?pages=chapter&truyen_id=$truyen_id&msg=error");
                exit();
            }
            break;


        case "update":
            $res = 0;
            $chapter_id = $_POST["chapter_id"];
            $chapter_ten = $_POST["chapter_ten"];
            $chapter_ngay_cap_nhat = $_POST["chapter_ngay_cap_nhat"];
            $chapter_trang_thai = $_POST["chapter_trang_thai"];
            $truyen_id = $_POST["truyen_id"];
            $res += $chapter->Chapter__Update($chapter_id, $chapter_ten, $chapter_ngay_cap_nhat, $chapter_trang_thai, $truyen_id);
            if ($res != 0) {
                header("location: ../../index.php?pages=chapter&truyen_id=$truyen_id&msg=success");
            } else {
                header("location: ../../index.php?pages=chapter&truyen_id=$truyen_id&msg=error");
            }
            break;

        case "delete":
            $res = 0;
            $chapter_id = $_GET["chapter_id"];
            $truyen_id = $chapter->Chapter__Get_By_Id($chapter_id)->truyen_id;
            $res += $chapter->Chapter__Delete($chapter_id);
            if ($res != 0) {
                header("location: ../../index.php?pages=chapter&truyen_id=$truyen_id&msg=success");
            } else {
                header("location: ../../index.php?pages=chapter&truyen_id=$truyen_id&msg=error");
            }
            break;

        case "c_add":
            $chapter_id = $_POST["chapter_id"];
            $truyen_id = $chapter->Chapter__Get_By_Id($chapter_id)->truyen_id;
            $truyen_ten = $truyen->Truyen__Get_By_Id($truyen_id)->truyen_ten;
            $totalRes = 0;
            // Kiểm tra xem có tệp ảnh đã tải lên không
            if (!empty($_FILES["chapter_noi_dung_image"]["name"])) {

                // Tạo một mảng để lưu trữ đường dẫn ảnh cho mỗi chapter
                $chapter_noi_dung_images = [];

                foreach ($_FILES["chapter_noi_dung_image"]["name"] as $key => $filename) {
                    // Xử lý và kiểm tra tệp ảnh
                    $processedImageFilePath = $cm->processAndValidateUploadedFile($_FILES["chapter_noi_dung_image"], $truyen_id, $key);

                    // Kiểm tra xem xử lý tệp ảnh thành công hay không
                    if ($processedImageFilePath) {
                        // Lưu đường dẫn ảnh vào mảng và thêm vào cơ sở dữ liệu
                        $chapter_noi_dung_images[$key] = $processedImageFilePath;
                        $totalRes += $chapterNoiDung->ChapterNoiDung__Add($processedImageFilePath, $chapter_id);
                    } else {
                        // Sử dụng hình ảnh mặc định nếu xử lý thất bại và thêm vào cơ sở dữ liệu
                        $chapter_noi_dung_images[$key] = $defaultImagePath;
                        $totalRes += $chapterNoiDung->ChapterNoiDung__Add($defaultImagePath, $chapter_id);
                    }
                }
            } else {
                // Sử dụng hình ảnh mặc định nếu không có tệp ảnh được tải lên và thêm vào cơ sở dữ liệu
                $totalRes += $chapterNoiDung->ChapterNoiDung__Add($defaultImagePath, $chapter_id);
            }


            if ($totalRes > 0) {
                header("Location: ../../index.php?pages=chapter-noi-dung&chapter_id=$chapter_id&msg=success");
                exit();
            } else {
                header("Location: ../../index.php?pages=chapter-noi-dung&chapter_id=$chapter_id&msg=error");
                exit();
            }


        case "c_update":
            $res = 0;
            $chapter_noi_dung_id = $_POST["chapter_noi_dung_id"];
            $chapter_id = $_POST["chapter_id"];
            $truyen_id = $chapter->Chapter__Get_By_Id($chapter_id)->truyen_id;
            $truyen_ten = $truyen->Truyen__Get_By_Id($truyen_id)->truyen_ten;
            $chapter_noi_dung_image_cu = $_POST['chapter_noi_dung_image_cu'];
            // Kiểm tra xem có tệp ảnh đã tải lên không
            if (!empty($_FILES["chapter_noi_dung_image"]["name"])) {
                // Kiểm tra và xử lý tệp
                $processedImageFilePath = $cm->processAndValidateUploadedFile($_FILES["chapter_noi_dung_image"], $truyen_id);

                if ($processedImageFilePath) {
                    // Sử dụng đường dẫn tệp để hiển thị hoặc lưu vào cơ sở dữ liệu
                    $chapter_noi_dung_image = $processedImageFilePath;
                } else {
                    // Sử dụng hình ảnh cũ nếu không có tệp ảnh được tải lên
                    $chapter_noi_dung_image = $_POST['chapter_noi_dung_image_cu'];
                }
            } else {
                // Sử dụng hình ảnh cũ nếu không có tệp ảnh được tải lên
                $chapter_noi_dung_image = $_POST['chapter_noi_dung_image_cu'];
            }
            // Xóa ảnh nếu đường dẫn tồn tại
            if (file_exists("../../../assets/$chapter_noi_dung_image_cu")) {
                unlink("../../../assets/$chapter_noi_dung_image_cu");
            }
            $res += $chapterNoiDung->ChapterNoiDung__Update($chapter_noi_dung_id, $chapter_noi_dung_image, $chapter_id);

            if ($res != 0) {
                header("location: ../../index.php?pages=chapter-noi-dung&chapter_id=$chapter_id&msg=success");
            } else {
                header("location: ../../index.php?pages=chapter-noi-dung&chapter_id=$chapter_id&msg=error");
            }
            break;

        case "c_delete":
            $res = 0;
            $chapter_noi_dung_id = $_GET["chapter_noi_dung_id"];
            $chapter_id = $chapterNoiDung->ChapterNoiDung__Get_By_Id($chapter_noi_dung_id)->chapter_id;
            $chapter_noi_dung_image = $chapterNoiDung->ChapterNoiDung__Get_By_Id($chapter_noi_dung_id)->chapter_noi_dung_image;
            // Xóa ảnh nếu đường dẫn tồn tại
            unlink("./" . $chapter_noi_dung_image);
            $res += $chapterNoiDung->ChapterNoiDung__Delete($chapter_noi_dung_id);
            if ($res != 0) {
                header("location: ../../index.php?pages=chapter-noi-dung&chapter_id=$chapter_id&msg=success");
            } else {
                header("location: ../../index.php?pages=chapter-noi-dung&chapter_id=$chapter_id&msg=error");
            }
            break;

        default:
            break;
    }
}

