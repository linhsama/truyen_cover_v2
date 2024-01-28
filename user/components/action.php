<?php
session_start();
require_once "../../model/TruyenModel.php";
require_once "../../model/TuongTacModel.php";
$truyen = new TruyenModel();
$tuongTac = new TuongTacModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra action
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Lấy truyen_id
        $truyen_id = isset($_POST['truyen_id']) ? intval($_POST['truyen_id']) : 0;
        $chapter_id = isset($_POST['chapter_id']) ? intval($_POST['chapter_id']) : 0;

        // Xử lý dựa trên action
        if ($action === 'like') {
            if (!isset($_SESSION['user'])) {
                echo "login_required";
            } else {
                $tuong_tac_noi_dung = 'Thích truyện';
                $tuong_tac_loai = 2;
                $tai_khoan_id = $_SESSION['user']->tai_khoan_id;
                $res = $tuongTac->TuongTac__AddOrUpdate($tuong_tac_noi_dung, $tuong_tac_loai, $chapter_id, $tai_khoan_id);
                if ($res > 0) {
                    $newLikeCount = $truyen->Truyen__Increase_Liked_Count($truyen_id);
                    echo number_format($newLikeCount);
                } else {
                    $oldLikeCount = $truyen->Truyen__Get_Liked_Count($truyen_id);
                    echo number_format($oldLikeCount);
                }
            }
        } elseif ($action === 'follow') {
            if (!isset($_SESSION['user'])) {
                echo "login_required";
            } else {
                $tuong_tac_noi_dung = 'Theo dõi truyện';
                $tuong_tac_loai = 3;
                $tai_khoan_id = $_SESSION['user']->tai_khoan_id;
                $res = $tuongTac->TuongTac__AddOrUpdate($tuong_tac_noi_dung, $tuong_tac_loai, $chapter_id, $tai_khoan_id);
                if ($res > 0) {
                    $newFollowCount = $truyen->Truyen__Increase_Followed_Count($truyen_id);
                    echo number_format($newFollowCount);
                } else {
                    $oldFollowCount = $truyen->Truyen__Get_Followed_Count($truyen_id);
                    echo number_format($oldFollowCount);
                }
            }
        } else if ($action === 'view') {
            $newViewCount = $truyen->Truyen__Increase_View_Count($truyen_id);
            if (isset($_SESSION['user'])) {
                $tuong_tac_noi_dung = 'Xem truyện';
                $tuong_tac_loai = 1;
                $tai_khoan_id = $_SESSION['user']->tai_khoan_id;
                $res = $tuongTac->TuongTac__AddOrUpdate($tuong_tac_noi_dung, $tuong_tac_loai, $chapter_id, $tai_khoan_id);
            }
            echo number_format($newViewCount);
        }
    }
}