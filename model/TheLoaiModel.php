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

class TheLoaiModel extends Database
{

    public function TheLoai__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM the_loai");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
    public function TheLoai__Add($the_loai_ten, $the_loai_mo_ta)
    {
        $obj = $this->connect->prepare("INSERT INTO the_loai(the_loai_ten, the_loai_mo_ta) VALUES (?,?)");
        $obj->execute(array($the_loai_ten, $the_loai_mo_ta));
        return $obj->rowCount();
    }

    public function TheLoai__Update($the_loai_id, $the_loai_ten, $the_loai_mo_ta)
    {
        $obj = $this->connect->prepare("UPDATE the_loai SET the_loai_ten=?, the_loai_mo_ta=? WHERE the_loai_id=?");
        $obj->execute(array($the_loai_ten, $the_loai_mo_ta, $the_loai_id));
        return $obj->rowCount();
    }
    public function TheLoai__Delete($the_loai_id)
    {
        $obj = $this->connect->prepare("DELETE FROM the_loai WHERE the_loai_id = ?");
        $obj->execute(array($the_loai_id));
        return $obj->rowCount();
    }

    public function TheLoai__Get_By_Id($the_loai_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM the_loai WHERE the_loai_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($the_loai_id));
        return $obj->fetch();
    }
    public function Theloai__Get_Top_View_Chart()
    {
        $sql = "
            SELECT
                tl.the_loai_id,
                tl.the_loai_ten,
                SUM(t.truyen_luot_xem) as tong_luot_xem
            FROM
                the_loai tl
            LEFT JOIN
                truyen_the_loai ttl ON tl.the_loai_id = ttl.the_loai_id
            LEFT JOIN
                truyen t ON ttl.truyen_id = t.truyen_id
            GROUP BY
                tl.the_loai_id, tl.the_loai_ten
            ORDER BY
                tong_luot_xem DESC
            LIMIT 5
        ";

        $obj = $this->connect->prepare($sql);
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();

        return $obj->fetchAll();
    }
}
