<?php
session_start();
require_once '../../model/TaiKhoanModel.php';
$taiKhoan = new TaiKhoanModel();

if (isset($_GET['req'])) {
    switch ($_GET['req']) {
        case "dang-ky":
            $res = 0;
            $ten_hien_thi = $_POST['ten_hien_thi'];
            $ten_tai_khoan = $_POST['ten_tai_khoan'];
            $mat_khau = $taiKhoan->TaiKhoan__Ma_Hoa_Mat_Khau(trim($_POST['mat_khau']));
            $phan_quyen = 2;
            $trang_thai = 1;
            $res += $taiKhoan->TaiKhoan__Add($ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai);
            if ($res != 0) {
                header('location: ../index.php?pages=dang-nhap&msg=success');
            } else {
                header('location: ../index.php?pages=dang-nhap&msg=error');
            }
            break;

        case "chinh-sua":
            $res = 0;
            $tai_khoan_id = $_POST['tai_khoan_id'];
            $ten_hien_thi = $_POST['ten_hien_thi'];
            $ten_tai_khoan = $_POST['ten_tai_khoan'];
            $mat_khau_cu = $_POST['mat_khau_cu'];
            $mat_khau_moi = $taiKhoan->TaiKhoan__Ma_Hoa_Mat_Khau(trim($_POST['mat_khau_moi']));
            $mat_khau = $mat_khau_cu;

            if ($mat_khau_moi != $mat_khau_cu && strlen($mat_khau_moi) > 0) {
                $mat_khau = $mat_khau_moi;
            }

            $phan_quyen = 2;
            $trang_thai = 1;
            $res = $taiKhoan->TaiKhoan__Update($tai_khoan_id, $ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai);
            if ($res != 0) {
                unset($_SESSION['user']);
                header('location: ../index.php?pages=dang-nhap&msg=update-success');
            } else {
                header('location: ../index.php?pages=dang-nhap&msg=update-error');
            }
            break;

        case "dang-nhap":
            $ten_tai_khoan = $_POST['ten_tai_khoan'];
            $url = $_POST['url'] ?? $_SERVER["HTTP_REFERER"];
            $mat_khau = $taiKhoan->TaiKhoan__Ma_Hoa_Mat_Khau(trim($_POST['mat_khau']));
            $res = $taiKhoan->TaiKhoan__Dang_Nhap($ten_tai_khoan, $mat_khau);
            if ($res == '0') {
                header('location: ../index.php?pages=dang-nhap&msg=warning');
            } else {
                if ($res->phan_quyen == 0) {
                    $_SESSION['admin'] = $res;
                    header('location: ../../admin/');
                }
                elseif ($res->phan_quyen == 1) {
                    $_SESSION['manager'] = $res;
                    header('location: ../../admin/');
                }
                else{
                    $_SESSION['user'] = $res;
                    header('location:'. $url);
                }
            }
            break;

        case "dang-xuat":
            if (isset($_SESSION['manager'])) {
                unset($_SESSION['manager']);
            }
            if (isset($_SESSION['admin'])) {
                unset($_SESSION['admin']);
            }
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            header('location:'.$_SERVER["HTTP_REFERER"]);
            break;
        default:
            break;
    }
}
