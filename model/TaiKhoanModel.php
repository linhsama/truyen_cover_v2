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

class TaiKhoanModel extends Database
{

    public function TaiKhoan__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM tai_khoan WHERE phan_quyen != ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array(0));
        return $obj->fetchAll();
    }
    public function TaiKhoan__Add($ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai)
    {
        $obj = $this->connect->prepare("INSERT INTO tai_khoan(ten_hien_thi, ten_tai_khoan, mat_khau, phan_quyen, trang_thai) VALUES (?,?,?,?,?)");
        $obj->execute(array($ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai));
        return $obj->rowCount();
    }

    public function TaiKhoan__Update($tai_khoan_id, $ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai)
    {
        $obj = $this->connect->prepare("UPDATE tai_khoan SET ten_hien_thi=?, ten_tai_khoan=?, mat_khau=?, phan_quyen=?, trang_thai=? WHERE tai_khoan_id=?");
        $obj->execute(array($ten_hien_thi, $ten_tai_khoan, $mat_khau, $phan_quyen, $trang_thai, $tai_khoan_id));
        return $obj->rowCount();
    }
    
    public function TaiKhoan__Delete($tai_khoan_id)
    {
        $obj = $this->connect->prepare("DELETE FROM tai_khoan WHERE tai_khoan_id = ?");
        $obj->execute(array($tai_khoan_id));
        return $obj->rowCount();
    }

    public function TaiKhoan__Get_By_Id($tai_khoan_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM tai_khoan WHERE tai_khoan_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($tai_khoan_id));
        return $obj->fetch();
    }

    public function TaiKhoan__Get_By_Phan_Quyen($phan_quyen, $trang_thai)
    {
        $obj = $this->connect->prepare("SELECT * FROM tai_khoan WHERE phan_quyen = ? AND trang_thai = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($phan_quyen, $trang_thai));
        return $obj->fetch();
    }

    public function TaiKhoan__Dang_Nhap($ten_tai_khoan, $mat_khau)
    {
        $obj = $this->connect->prepare("SELECT * FROM tai_khoan WHERE ten_tai_khoan = ? AND mat_khau = ? AND trang_thai = 1");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($ten_tai_khoan, $mat_khau));
        if ($obj->rowCount() > 0) {
            return $obj->fetch();
        } else {
            return 0;
        }
    }

    public function TaiKhoan__Ma_Hoa_Mat_Khau($mat_khau)
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = "W3docs";
        $encryption = openssl_encrypt($mat_khau, $ciphering, $encryption_key, $options, $encryption_iv);
        return $encryption;
    }

    public function TaiKhoan__Giai_Ma_Mat_Khau($mat_khau_ma_hoa)
    {
        $ciphering = "AES-128-CTR";
        $options = 0;
        $decryption_iv = '1234567891011121';
        $decryption_key = "W3docs";
        $decryption = openssl_decrypt($mat_khau_ma_hoa, $ciphering, $decryption_key, $options, $decryption_iv);
        return $decryption;
    }
}
