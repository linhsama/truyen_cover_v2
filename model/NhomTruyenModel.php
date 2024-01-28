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

class NhomTruyenModel extends Database
{

    public function NhomTruyen__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM nhom_truyen");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
    public function NhomTruyen__Add($nhom_truyen_ten, $nhom_truyen_mo_ta)
    {
        $obj = $this->connect->prepare("INSERT INTO nhom_truyen(nhom_truyen_ten, nhom_truyen_mo_ta) VALUES (?,?)");
        $obj->execute(array($nhom_truyen_ten, $nhom_truyen_mo_ta));
        return $obj->rowCount();
    }

    public function NhomTruyen__Update($nhom_truyen_id, $nhom_truyen_ten, $nhom_truyen_mo_ta)
    {
        $obj = $this->connect->prepare("UPDATE nhom_truyen SET nhom_truyen_ten=?, nhom_truyen_mo_ta=? WHERE nhom_truyen_id=?");
        $obj->execute(array($nhom_truyen_ten, $nhom_truyen_mo_ta, $nhom_truyen_id));
        return $obj->rowCount();
    }
    public function NhomTruyen__Delete($nhom_truyen_id)
    {
        $obj = $this->connect->prepare("DELETE FROM nhom_truyen WHERE nhom_truyen_id = ?");
        $obj->execute(array($nhom_truyen_id));
        return $obj->rowCount();
    }

    public function NhomTruyen__Get_By_Id($nhom_truyen_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM nhom_truyen WHERE nhom_truyen_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($nhom_truyen_id));
        return $obj->fetch();
    }

}
