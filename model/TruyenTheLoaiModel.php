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

class TruyenTheLoaiModel extends Database
{

    public function TruyenTheLoai__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM truyen_the_loai");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
    public function TruyenTheLoai__Add($truyen_id, $the_loai_id)
    {
        $obj = $this->connect->prepare("INSERT INTO truyen_the_loai(truyen_id, the_loai_id) VALUES (?,?)");
        $obj->execute(array($truyen_id, $the_loai_id));
        return $obj->rowCount();
    }

    public function TruyenTheLoai__Delete($truyen_id)
    {
        $obj = $this->connect->prepare("DELETE FROM truyen_the_loai WHERE truyen_id = ?");
        $obj->execute(array($truyen_id));
        return $obj->rowCount();
    }

    public function TruyenTheLoai__Get_By_Truyen_Id($truyen_id)
    {
        $obj = $this->connect->prepare("SELECT tl.the_loai_id, tl.the_loai_ten, ttl.truyen_id FROM  the_loai tl LEFT JOIN truyen_the_loai ttl ON tl.the_loai_id = ttl.the_loai_id WHERE truyen_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id));
        return $obj->fetchAll();
    }
}