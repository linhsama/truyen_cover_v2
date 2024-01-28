<?php
require_once '../../../model/TaiKhoanModel.php';
$taiKhoan = new TaiKhoanModel();

if (isset($_GET['req'])) {
    switch ($_GET['req']) {
        case "add":
            $res = 0;
            $ten_hien_thi = $_POST['ten_hien_thi'];
            $ten_tai_khoan = $_POST['ten_tai_khoan'];
            $mat_khau = $taiKhoan->TaiKhoan__Ma_Hoa_Mat_Khau(trim($_POST['mat_khau']));
            $phan_quyen = $_POST['phan_quyen'];
            $trang_thai = $_POST['trang_thai'];
            $res += $taiKhoan->TaiKhoan__Add($ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai);
            if ($res != 0) {
                header('location: ../../index.php?pages=tai-khoan&msg=success');
            } else {
                header('location: ../../index.php?pages=tai-khoan&msg=error');
            }
            break;

        case "update":
            $res = 0;
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $ten_hien_thi = $_POST['ten_hien_thi'];
            $ten_tai_khoan = $_POST['ten_tai_khoan'];
            $mat_khau_cu = $_POST['mat_khau_cu'];
            $mat_khau_moi = $taiKhoan->TaiKhoan__Ma_Hoa_Mat_Khau(trim($_POST['mat_khau']));
            $mat_khau = $mat_khau_cu;

            if($mat_khau_moi != $mat_khau_cu && strlen($mat_khau_moi) > 0){
                $mat_khau = $mat_khau_moi;
            }

            $phan_quyen = $_POST['phan_quyen'];
            $trang_thai = $_POST['trang_thai'];
            $res += $taiKhoan->TaiKhoan__Update($tai_khoan_id, $ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai);
            if ($res != 0) {
                header('location: ../../index.php?pages=tai-khoan&msg=success');
            } else {
                header('location: ../../index.php?pages=tai-khoan&msg=error');
            }
            break;

        case "delete":
            $res = 0;
            $tai_khoan_id = $_GET['tai_khoan_id'];
            $res += $taiKhoan->TaiKhoan__Delete($tai_khoan_id);
            if ($res != 0) {
                header('location: ../../index.php?pages=tai-khoan&msg=success');
            } else {
                header('location: ../../index.php?pages=tai-khoan&msg=error');
            }
            break;
        default:
            break;
    }
}
