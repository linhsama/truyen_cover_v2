<?php
require_once '../../../model/NhomTruyenModel.php';
$nhomTruyen = new NhomTruyenModel();

if (isset($_GET['req'])) {
    switch ($_GET['req']) {
        case "add":
            $res = 0;
            $nhom_truyen_ten = $_POST['nhom_truyen_ten'];
            $nhom_truyen_mo_ta = $_POST['nhom_truyen_mo_ta'] != "" ? $_POST['nhom_truyen_mo_ta'] : 'Đang cập nhật';
            $res += $nhomTruyen->NhomTruyen__Add($nhom_truyen_ten, $nhom_truyen_mo_ta);
            if ($res != 0) {
                header('location: ../../index.php?pages=nhom-truyen&msg=success');
            } else {
                header('location: ../../index.php?pages=nhom-truyen&msg=error');
            }
            break;

        case "update":
            $res = 0;
            $nhom_truyen_id = $_POST['nhom_truyen_id'];
            $nhom_truyen_ten = $_POST['nhom_truyen_ten'];
            $nhom_truyen_mo_ta = $_POST['nhom_truyen_mo_ta'];
            $res += $nhomTruyen->NhomTruyen__Update($nhom_truyen_id, $nhom_truyen_ten, $nhom_truyen_mo_ta);
            if ($res != 0) {
                header('location: ../../index.php?pages=nhom-truyen&msg=success');
            } else {
                header('location: ../../index.php?pages=nhom-truyen&msg=error');
            }
            break;

        case "delete":
            $res = 0;
            $nhom_truyen_id = $_GET['nhom_truyen_id'];
            $res += $nhomTruyen->NhomTruyen__Delete($nhom_truyen_id);
            if ($res != 0) {
                header('location: ../../index.php?pages=nhom-truyen&msg=success');
            } else {
                header('location: ../../index.php?pages=nhom-truyen&msg=error');
            }
            break;
        default:
            break;
    }
}
