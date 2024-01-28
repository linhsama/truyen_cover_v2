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

class ChapterModel extends Database
{

    public function Chapter__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
 
    public function Chapter__Add($chapter_ten, $chapter_ngay_cap_nhat, $chapter_trang_thai, $truyen_id)
    {
        // Cập nhật lại thứ tự của chapter_so sau mỗi lần thêm
        $stmtUpdate = $this->connect->prepare("SET @row_number = 0");
        $stmtUpdate->execute();

        $stmtUpdate = $this->connect->prepare("UPDATE chapter SET chapter_so = (@row_number:=@row_number + 1) WHERE truyen_id = ? ORDER BY chapter_so");
        $stmtUpdate->execute(array($truyen_id));

        // Tìm giá trị lớn nhất của chapter_so cho truyen_id
        $stmt = $this->connect->prepare("SELECT MAX(chapter_so) FROM chapter WHERE truyen_id = ?");
        $stmt->execute(array($truyen_id));
        $maxChapterSo = $stmt->fetchColumn();

        // Nếu không có chapter nào cho truyen_id này, đặt chapter_so = 1, ngược lại tăng giá trị lớn nhất lên 1
        $chapterSo = ($maxChapterSo === false) ? 1 : $maxChapterSo + 1;

        // Chèn dữ liệu mới với giá trị chapter_so đã tìm được
        $obj = $this->connect->prepare("INSERT INTO chapter(chapter_so, chapter_ten, chapter_ngay_cap_nhat, chapter_trang_thai, truyen_id) VALUES (?,?,?,?,?)");
        $obj->execute(array($chapterSo, $chapter_ten, $chapter_ngay_cap_nhat, $chapter_trang_thai, $truyen_id));

        return $this->connect->lastInsertId();
    }


    public function Chapter__Update($chapter_id, $chapter_ten, $chapter_ngay_cap_nhat, $chapter_trang_thai, $truyen_id)
    {
        $obj = $this->connect->prepare("UPDATE chapter SET chapter_ten=?, chapter_ngay_cap_nhat=?, chapter_trang_thai=?, truyen_id=? WHERE chapter.chapter_trang_thai = 1 AND chapter_id=?");
        $obj->execute(array($chapter_ten, $chapter_ngay_cap_nhat, $chapter_trang_thai, $truyen_id, $chapter_id));
        return $obj->rowCount();
    }
 
    public function Chapter__Delete($chapter_id)
    {
        // Lấy thông tin về truyen_id và chapter_so trước khi xóa
        $selectStatement = $this->connect->prepare("SELECT truyen_id, chapter_so FROM chapter WHERE chapter.chapter_trang_thai = 1 AND chapter_id = ?");
        $selectStatement->execute(array($chapter_id));
        $chapterInfo = $selectStatement->fetch(PDO::FETCH_ASSOC);

        // Xóa chương
        $deleteStatement = $this->connect->prepare("DELETE FROM chapter WHERE chapter.chapter_trang_thai = 1 AND chapter_id = ?");
        $deleteStatement->execute(array($chapter_id));

        // Cập nhật lại chapter_so cho các chương còn lại
        $updateStatement = $this->connect->prepare("UPDATE chapter SET chapter_so = chapter_so - 1 WHERE chapter.chapter_trang_thai = 1 AND truyen_id = ? AND chapter_so > ?");
        $updateStatement->execute(array($chapterInfo['truyen_id'], $chapterInfo['chapter_so']));

        // Trả về số hàng bị ảnh hưởng (số chương đã bị xóa)
        return $deleteStatement->rowCount();
    }


    public function Chapter__Get_By_Id($chapter_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter WHERE chapter.chapter_trang_thai = 1 AND chapter_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($chapter_id));
        return $obj->fetch();
    }
    public function Chapter__Get_By_Chap_So($truyen_id, $chapter_so)
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter WHERE chapter.chapter_trang_thai = 1 AND truyen_id = ? AND chapter_so = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id, $chapter_so));
        return $obj->fetch();
    }


    public function Chapter__Get_By_Truyen_Id($truyen_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter WHERE chapter.chapter_trang_thai = 1 AND truyen_id = ? ORDER BY chapter_so DESC");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id));
        return $obj->fetchAll();
    }


    public function Chapter__Get_By_Truyen_Id_Limit_5($truyen_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM chapter WHERE chapter.chapter_trang_thai = 1 AND truyen_id = ? ORDER BY chapter_so DESC LIMIT 5");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id));
        return $obj->fetchAll();
    }

    public function Chapter__Get_Latest_By_Truyen_Id($truyen_id)
    {
        $sql = "SELECT *
            FROM chapter
            WHERE chapter.chapter_trang_thai = 1 AND truyen_id = ?
            ORDER BY chapter_so DESC
            LIMIT 1";

        $obj = $this->connect->prepare($sql);
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id));
        return $obj->fetch();
    }

    public function Chapter__Get_First_By_Truyen_Id($truyen_id)
    {
        $sql = "SELECT *
            FROM chapter
            WHERE chapter.chapter_trang_thai = 1 AND truyen_id = ?
            ORDER BY chapter_so ASC
            LIMIT 1";

        $obj = $this->connect->prepare($sql);
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id));
        return $obj->fetch();
    }
}