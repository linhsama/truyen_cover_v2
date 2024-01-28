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

class TruyenModel extends Database
{

    public function Truyen__Get_All()
    {
        $obj = $this->connect->prepare("SELECT * FROM truyen");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
    public function Truyen__Add($truyen_ten, $truyen_tac_gia, $truyen_mo_ta, $truyen_anh_bia, $truyen_tinh_trang, $truyen_luot_xem, $truyen_luot_thich, $truyen_luot_theo_doi, $truyen_ngay_dang, $truyen_trang_thai, $nhom_truyen_id)
    {
        $obj = $this->connect->prepare("INSERT INTO truyen(truyen_ten, truyen_tac_gia, truyen_mo_ta, truyen_anh_bia, truyen_tinh_trang, truyen_luot_xem, truyen_luot_thich, truyen_luot_theo_doi, truyen_ngay_dang, truyen_trang_thai, nhom_truyen_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $obj->execute(array($truyen_ten, $truyen_tac_gia, $truyen_mo_ta, $truyen_anh_bia, $truyen_tinh_trang, $truyen_luot_xem, $truyen_luot_thich, $truyen_luot_theo_doi, $truyen_ngay_dang, $truyen_trang_thai, $nhom_truyen_id));
        return $this->connect->lastInsertId();
    }

    public function Truyen__Update($truyen_id, $truyen_ten, $truyen_tac_gia, $truyen_mo_ta, $truyen_anh_bia, $truyen_tinh_trang, $truyen_trang_thai, $nhom_truyen_id)
    {
        $obj = $this->connect->prepare("UPDATE truyen SET truyen_ten=?, truyen_tac_gia=?, truyen_mo_ta=?, truyen_anh_bia=?, truyen_tinh_trang=?, truyen_trang_thai=?, nhom_truyen_id=? WHERE truyen.truyen_trang_thai = 1 AND truyen_id=?");
        $obj->execute(array($truyen_ten, $truyen_tac_gia, $truyen_mo_ta, $truyen_anh_bia, $truyen_tinh_trang, $truyen_trang_thai, $nhom_truyen_id, $truyen_id));
        return $obj->rowCount();
    }

    public function Truyen__Update_Anh_Bia($truyen_id, $truyen_anh_bia)
    {
        $obj = $this->connect->prepare("UPDATE truyen SET truyen_anh_bia=? WHERE truyen_id=?");
        $obj->execute(array($truyen_anh_bia, $truyen_id));
        return $obj->rowCount();
    }

    public function Truyen__Delete($truyen_id)
    {
               // Xóa dữ liệu truyện từ cơ sở dữ liệu
        $obj = $this->connect->prepare("DELETE FROM truyen WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?");
        $obj->execute(array($truyen_id));

        return $obj->rowCount();
    }

    // Hàm để lấy đường dẫn ảnh từ cơ sở dữ liệu
    public function getImagePath($truyen_id)
    {
        $obj = $this->connect->prepare("SELECT truyen_anh_bia FROM truyen WHERE truyen_id = ?");
        $obj->execute(array($truyen_id));
        $result = $obj->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra xem có đường dẫn ảnh hay không
        if ($result && isset($result['truyen_anh_bia'])) {
            return $result['truyen_anh_bia'];
        }

        return null;
    }

    public function Truyen__Get_By_Id($truyen_id)
    {
        $obj = $this->connect->prepare("SELECT * FROM truyen WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?");
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id));
        return $obj->fetch();
    }


    public function Truyen__Get_Top_View_Chart()
    {
        $truyen__Get_All = $this->Truyen__Get_All();
        usort($truyen__Get_All, function ($a, $b) {
            return $b->truyen_luot_xem - $a->truyen_luot_xem;
        });
        return array_slice($truyen__Get_All, 0, 5);
    }

    public function Truyen__Get_Top_Viewed()
    {
        $sql = "SELECT * FROM truyen ORDER BY truyen_luot_xem DESC  LIMIT 3";
        $obj = $this->connect->prepare($sql);
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }

    public function Truyen__Increase_View_Count($truyen_id)
    {
        $sql = "UPDATE truyen SET truyen_luot_xem = truyen_luot_xem + 1 WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?";
        $obj = $this->connect->prepare($sql);
        $obj->execute(array($truyen_id));

        $newViewCount = $this->Truyen__Get_View_Count($truyen_id);
        return ($obj->rowCount() > 0) ? $newViewCount : false;
    }

    public function Truyen__Get_View_Count($truyen_id)
    {
        $sql = "SELECT truyen_luot_xem FROM truyen WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?";
        $obj = $this->connect->prepare($sql);
        $obj->execute(array($truyen_id));
        $result = $obj->fetch(PDO::FETCH_OBJ);

        return ($result) ? $result->truyen_luot_xem : 0;
    }


    public function Truyen__Increase_Liked_Count($truyen_id)
    {
        $sql = "UPDATE truyen SET truyen_luot_thich = truyen_luot_thich + 1 WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?";
        $obj = $this->connect->prepare($sql);
        $obj->execute(array($truyen_id));

        // Lấy giá trị mới của truyen_luot_thich
        $newLikeCount = $this->Truyen__Get_Liked_Count($truyen_id);

        // Kiểm tra xem có lỗi không và trả về giá trị mới nếu thành công, ngược lại là false
        return ($obj->rowCount() > 0) ? $newLikeCount : false;
    }

    // Hàm lấy giá trị mới của truyen_luot_thich
    public function Truyen__Get_Liked_Count($truyen_id)
    {
        $sql = "SELECT truyen_luot_thich FROM truyen WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?";
        $obj = $this->connect->prepare($sql);
        $obj->execute(array($truyen_id));
        $result = $obj->fetch(PDO::FETCH_OBJ);

        // Trả về giá trị mới của truyen_luot_thich hoặc 0 nếu có lỗi
        return ($result) ? $result->truyen_luot_thich : 0;
    }


    public function Truyen__Increase_Followed_Count($truyen_id)
    {
        $sql = "UPDATE truyen SET truyen_luot_theo_doi = truyen_luot_theo_doi + 1 WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?";
        $obj = $this->connect->prepare($sql);
        $obj->execute(array($truyen_id));

        // Lấy giá trị mới của truyen_luot_theo_doi
        $newFollowCount = $this->Truyen__Get_Followed_Count($truyen_id);

        // Kiểm tra xem có lỗi không và trả về giá trị mới nếu thành công, ngược lại là false
        return ($obj->rowCount() > 0) ? $newFollowCount : false;
    }

    // Hàm lấy giá trị mới của truyen_luot_theo_doi
    public function Truyen__Get_Followed_Count($truyen_id)
    {
        $sql = "SELECT truyen_luot_theo_doi FROM truyen WHERE truyen.truyen_trang_thai = 1 AND truyen_id = ?";
        $obj = $this->connect->prepare($sql);
        $obj->execute(array($truyen_id));
        $result = $obj->fetch(PDO::FETCH_OBJ);

        // Trả về giá trị mới của truyen_luot_theo_doi hoặc 0 nếu có lỗi
        return ($result) ? $result->truyen_luot_theo_doi : 0;
    }

    public function Truyen__Get_Per_Paged_Nhom_Truyen($page_number, $nhom_truyen_id)
    {
        // Số lượng truyện trên mỗi trang
        $items_per_page = 12;

        // Tính toán giá trị bắt đầu và kết thúc cho phân trang
        $page_start = ($page_number - 1) * $items_per_page;
        $page_end = $items_per_page;

        // Chuẩn bị và thực hiện truy vấn
        $obj = $this->connect->prepare(
            "SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(chapter.chapter_ngay_cap_nhat) as max_ngay_cap_nhat, MAX(chapter.chapter_so) as chapter_so
            FROM (truyen
            LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id)
            LEFT JOIN nhom_truyen ON truyen.nhom_truyen_id = nhom_truyen.nhom_truyen_id
            WHERE nhom_truyen.nhom_truyen_id = :nhom_truyen_id
            GROUP BY truyen.truyen_id
            ORDER BY max_ngay_cap_nhat DESC
            LIMIT :page_start, :page_end"
        );

        $obj->bindParam(':page_start', $page_start, PDO::PARAM_INT);
        $obj->bindParam(':page_end', $page_end, PDO::PARAM_INT);
        $obj->bindParam(':nhom_truyen_id', $nhom_truyen_id, PDO::PARAM_INT);

        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }

    public function Truyen__Get_Per_Paged($page_number)
    {
        // Số lượng truyện trên mỗi trang
        $items_per_page = 12;

        // Tính toán giá trị bắt đầu và kết thúc cho phân trang
        $page_start = ($page_number - 1) * $items_per_page;
        $page_end = $items_per_page;

        // Chuẩn bị và thực hiện truy vấn
        $obj = $this->connect->prepare(
            "SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(chapter.chapter_ngay_cap_nhat) as max_ngay_cap_nhat, MAX(chapter.chapter_so) as chapter_so
            FROM truyen
            LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id
            GROUP BY truyen.truyen_id
            ORDER BY max_ngay_cap_nhat DESC
            LIMIT :page_start, :page_end"
        );

        $obj->bindParam(':page_start', $page_start, PDO::PARAM_INT);
        $obj->bindParam(':page_end', $page_end, PDO::PARAM_INT);

        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();

        return $obj->fetchAll();
    }

    public function Truyen__Get_Random_Paged($page_number)
    {
        // Số lượng truyện trên mỗi trang
        $items_per_page = 12;

        // Tính toán giá trị bắt đầu và kết thúc cho phân trang
        $page_start = ($page_number - 1) * $items_per_page;
        $page_end = $items_per_page;

        // Chuẩn bị và thực hiện truy vấn
        $obj = $this->connect->prepare(
            $sql = "SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(chapter.chapter_ngay_cap_nhat) as max_ngay_cap_nhat, MAX(chapter.chapter_so) as chapter_so
            FROM truyen
            LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id
            GROUP BY truyen.truyen_id
            ORDER BY RAND()
            LIMIT :page_start, :page_end"
        );

        $obj->bindParam(':page_start', $page_start, PDO::PARAM_INT);
        $obj->bindParam(':page_end', $page_end, PDO::PARAM_INT);

        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }

    public function Truyen__Get_The_Loai_Paged($page_number, $the_loai_id)
    {
        // Số lượng truyện trên mỗi trang
        $items_per_page = 12;

        // Tính toán giá trị bắt đầu và kết thúc cho phân trang
        $page_start = ($page_number - 1) * $items_per_page;
        $page_end = $items_per_page;

        // Chuẩn bị và thực hiện truy vấn
        $obj = $this->connect->prepare(
            $sql = "SELECT truyen.truyen_id, truyen.truyen_ten, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang
            FROM truyen
            LEFT JOIN truyen_the_loai ON truyen.truyen_id = truyen_the_loai.truyen_id
            WHERE truyen.truyen_trang_thai = 1 AND truyen_the_loai.the_loai_id = :the_loai_id
            GROUP BY truyen.truyen_id
            LIMIT :page_start, :page_end"
        );

        $obj->bindParam(':page_start', $page_start, PDO::PARAM_INT);
        $obj->bindParam(':page_end', $page_end, PDO::PARAM_INT);
        $obj->bindParam(':the_loai_id', $the_loai_id, PDO::PARAM_INT);

        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }


    public function Truyen__Get_Ten_Truyen_Paged($page_number, $truyen_ten)
    {
        // Số lượng truyện trên mỗi trang
        $items_per_page = 12;

        // Tính toán giá trị bắt đầu và kết thúc cho phân trang
        $page_start = ($page_number - 1) * $items_per_page;
        $page_end = $items_per_page;

        // Chuẩn bị và thực hiện truy vấn
        $obj = $this->connect->prepare(
            "SELECT truyen.truyen_id, truyen.truyen_ten, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang
            FROM truyen
            WHERE truyen.truyen_trang_thai = 1 AND truyen.truyen_ten LIKE '%$truyen_ten%'
            GROUP BY truyen.truyen_id
            LIMIT :page_start, :page_end"
        );

        $obj->bindParam(':page_start', $page_start, PDO::PARAM_INT);
        $obj->bindParam(':page_end', $page_end, PDO::PARAM_INT);

        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }


    public function Truyen__Get_Top_Views_Paged($page_number)
    {
        // Số lượng truyện trên mỗi trang
        $items_per_page = 12;

        // Tính toán giá trị bắt đầu và kết thúc cho phân trang
        $page_start = ($page_number - 1) * $items_per_page;
        $page_end = $items_per_page;

        // Chuẩn bị và thực hiện truy vấn
        $obj = $this->connect->prepare(
            "SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(truyen_luot_thich) as truyen_luot_thich
            FROM truyen
            LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id
            GROUP BY truyen.truyen_id
            ORDER BY truyen_luot_thich DESC
            LIMIT :page_start, :page_end"
        );

        $obj->bindParam(':page_start', $page_start, PDO::PARAM_INT);
        $obj->bindParam(':page_end', $page_end, PDO::PARAM_INT);

        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();

        return $obj->fetchAll();
    }

    public function Truyen__Get_User_Paged($page_number, $tai_khoan_id, $tuong_tac_loai)
    {
        // Số lượng truyện trên mỗi trang
        $items_per_page = 12;

        // Tính toán giá trị bắt đầu và kết thúc cho phân trang
        $page_start = ($page_number - 1) * $items_per_page;
        $page_end = $items_per_page;

        // Chuẩn bị và thực hiện truy vấn
        $sql = "
            SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(truyen_luot_thich) as truyen_luot_thich
            FROM truyen
            JOIN chapter ON truyen.truyen_id = chapter.truyen_id
            JOIN tuong_tac ON tuong_tac.chapter_id = chapter.chapter_id
            WHERE truyen.truyen_trang_thai = 1 AND tuong_tac.tai_khoan_id = :tai_khoan_id AND tuong_tac.tuong_tac_loai = :tuong_tac_loai
            GROUP BY truyen.truyen_id
            ORDER BY truyen_luot_thich DESC
            LIMIT :page_start, :page_end
        ";

        // Chuẩn bị và thực hiện truy vấn
        $obj = $this->connect->prepare($sql);
        $obj->bindParam(':page_start', $page_start, PDO::PARAM_INT);
        $obj->bindParam(':page_end', $page_end, PDO::PARAM_INT);
        $obj->bindParam(':tai_khoan_id', $tai_khoan_id, PDO::PARAM_INT);
        $obj->bindParam(':tuong_tac_loai', $tuong_tac_loai, PDO::PARAM_INT);

        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();

        return $obj->fetchAll();
    }


    public function Truyen__Get_Top_Updated($limit = 5)
    {
        $sql = "SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(chapter.chapter_ngay_cap_nhat) as max_ngay_cap_nhat, MAX(chapter.chapter_so) as chapter_so
        FROM truyen
        LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id
        GROUP BY truyen.truyen_id
        ORDER BY max_ngay_cap_nhat DESC
        LIMIT $limit";

        $obj = $this->connect->prepare($sql);
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }
    public function Truyen__Get_Top_Random()
    {
        $sql = "SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(chapter.chapter_ngay_cap_nhat) as max_ngay_cap_nhat
        FROM truyen
        LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id
        GROUP BY truyen.truyen_id
        ORDER BY RAND()
        LIMIT 6;
        ";

        $obj = $this->connect->prepare($sql);
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute();
        return $obj->fetchAll();
    }

    public function Truyen__Get_Top_Random_Same($truyen_id)
    {
        $sql = "SELECT truyen.truyen_id, truyen.truyen_ten, chapter.chapter_so, chapter.chapter_id, truyen.truyen_anh_bia, truyen.truyen_luot_xem, truyen.truyen_ngay_dang, MAX(chapter.chapter_ngay_cap_nhat) as max_ngay_cap_nhat
    FROM truyen
    LEFT JOIN chapter ON truyen.truyen_id = chapter.truyen_id
    WHERE truyen.truyen_trang_thai = 1 AND truyen.truyen_trang_thai = 1 -- Chỉ lấy truyện có trạng thái hiện
    AND truyen.truyen_id != ?
    GROUP BY truyen.truyen_id
    ORDER BY RAND()
    LIMIT 6;";

        $obj = $this->connect->prepare($sql);
        $obj->setFetchMode(PDO::FETCH_OBJ);
        $obj->execute(array($truyen_id));
        return $obj->fetchAll();
    }
}
