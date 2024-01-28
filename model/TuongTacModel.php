<?php

$a = "./config/connect.php";
$b = "../config/connect.php";
$c = "../../config/connect.php";
$d = "../../../config/connect.php";
$e = "../../../../config/connect.php";
$f = "../../../../../config/connect.php";

if (file_exists($a)) {
    $des = $a;
}
if (file_exists($b)) {
    $des = $b;
}
if (file_exists($c)) {
    $des = $c;
}
if (file_exists($d)) {
    $des = $d;
}

if (file_exists($e)) {
    $des = $e;
}

if (file_exists($f)) {
    $des = $f;
}
include_once($des);

class TuongTacModel extends Database
{

    public function TuongTac__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM tuong_tac");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
    // Hàm kiểm tra sự tồn tại của tài khoản và truyện
    function TuongTac__Check_Exist($tai_khoan_id, $tuong_tac_loai, $chapter_id)
    {
        $sql = "SELECT COUNT(*) as count FROM tuong_tac WHERE tai_khoan_id = ? AND tuong_tac_loai = ? AND chapter_id = ?";
        $obj = $this->connect->prepare($sql);
        $obj->execute([$tai_khoan_id, $tuong_tac_loai, $chapter_id]);
        $result = $obj->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }

    // Hàm thêm mới hoặc cập nhật thông tin
    function TuongTac__AddOrUpdate($tuong_tac_noi_dung, $tuong_tac_loai, $chapter_id, $tai_khoan_id)
    {
        // Kiểm tra xem thông tin đã tồn tại chưa
        $kiemTraTuongTac = $this->TuongTac__Check_Exist($tai_khoan_id, $tuong_tac_loai, $chapter_id);

        if (!$kiemTraTuongTac) {
            // Nếu chưa tồn tại, thêm mới thông tin
            $obj = $this->connect->prepare("INSERT INTO tuong_tac(tuong_tac_noi_dung, tuong_tac_loai, chapter_id, tai_khoan_id) VALUES (?, ?, ?, ?)");
            $obj->execute([$tuong_tac_noi_dung, $tuong_tac_loai, $chapter_id, $tai_khoan_id]);
            return $obj->rowCount();
        } else {
            // Nếu đã tồn tại, cập nhật thông tin
            $obj = $this->connect->prepare("UPDATE tuong_tac SET tuong_tac_noi_dung=?, chapter_id=? WHERE tai_khoan_id=? AND tuong_tac_loai=?");
            $obj->execute([$tuong_tac_noi_dung, $chapter_id, $tai_khoan_id, $tuong_tac_loai]);
            return $obj->rowCount();
        }
    }
}
