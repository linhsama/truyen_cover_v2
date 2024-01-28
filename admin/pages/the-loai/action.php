<?php
require_once '../../../model/TheLoaiModel.php';
$theLoai = new TheLoaiModel();

if (isset($_GET['req'])) {
    switch ($_GET['req']) {
        case "add":
            $res = 0;
            $the_loai_ten = $_POST['the_loai_ten'];
            $the_loai_mo_ta = $_POST['the_loai_mo_ta'] != "" ? $_POST['the_loai_mo_ta'] : 'Đang cập nhật';
            $res += $theLoai->TheLoai__Add($the_loai_ten, $the_loai_mo_ta);
            if ($res != 0) {
                header('location: ../../index.php?pages=the-loai&msg=success');
            } else {
                header('location: ../../index.php?pages=the-loai&msg=error');
            }
            break;

        case "update":
            $res = 0;
            $the_loai_id = $_POST['the_loai_id'];
            $the_loai_ten = $_POST['the_loai_ten'];
            $the_loai_mo_ta = $_POST['the_loai_mo_ta'];
            $res += $theLoai->TheLoai__Update($the_loai_id, $the_loai_ten, $the_loai_mo_ta);
            if ($res != 0) {
                header('location: ../../index.php?pages=the-loai&msg=success');
            } else {
                header('location: ../../index.php?pages=the-loai&msg=error');
            }
            break;

        case "delete":
            $res = 0;
            $the_loai_id = $_GET['the_loai_id'];
            $res += $theLoai->TheLoai__Delete($the_loai_id);
            if ($res != 0) {
                header('location: ../../index.php?pages=the-loai&msg=success');
            } else {
                header('location: ../../index.php?pages=the-loai&msg=error');
            }
            break;
        default:
            break;
    }
}
