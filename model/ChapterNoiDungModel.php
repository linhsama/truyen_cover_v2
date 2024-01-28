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

class ChapterNoiDungModel extends Database
{

    public function ChapterNoiDung__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter_noi_dung");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
    public function ChapterNoiDung__Add($chapter_noi_dung_image, $chapter_id)
    {
        $obj = $this->connect->prepare("INSERT INTO chapter_noi_dung(chapter_noi_dung_image, chapter_id) VALUES (?,?)");
        $obj->execute(array($chapter_noi_dung_image, $chapter_id));
        return $obj->rowCount();
    }

    public function ChapterNoiDung__Update($chapter_noi_dung_id, $chapter_noi_dung_image, $chapter_id)
    {
        $obj = $this->connect->prepare("UPDATE chapter_noi_dung SET chapter_noi_dung_image=?, chapter_id=? WHERE chapter_noi_dung_id=?");
        $obj->execute(array($chapter_noi_dung_image, $chapter_id, $chapter_noi_dung_id));
        return $obj->rowCount();
    }
    public function ChapterNoiDung__Delete($chapter_noi_dung_id)
    {
        // Xóa dữ liệu truyện từ cơ sở dữ liệu
        $obj = $this->connect->prepare("DELETE FROM chapter_noi_dung WHERE chapter_noi_dung_id = ?");
        $obj->execute(array($chapter_noi_dung_id));

        return $obj->rowCount();
    }

    // Hàm để lấy đường dẫn ảnh từ cơ sở dữ liệu
    private function getImagePath($chapter_noi_dung_id)
    {
        $obj = $this->connect->prepare("SELECT chapter_noi_dung FROM chapter_noi_dung_image WHERE chapter_noi_dung_id = ?");
        $obj->execute(array($chapter_noi_dung_id));
        $result = $obj->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra xem có đường dẫn ảnh hay không
        if ($result && isset($result['chapter_noi_dung_image'])) {
            return $result['chapter_noi_dung_image'];
        }

        return null;
    }

    public function ChapterNoiDung__Get_By_Id($chapter_noi_dung_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter_noi_dung WHERE chapter_noi_dung_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($chapter_noi_dung_id));
        return $obj->fetch();
    }

    public function ChapterNoiDung__Get_By_Chapter_Id($chapter_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter_noi_dung WHERE chapter_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($chapter_id));
        return $obj->fetchAll();
    }
}