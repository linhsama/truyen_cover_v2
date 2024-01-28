<?php
require_once '../../../model/TaiKhoanModel.php';
$taiKhoan = new TaiKhoanModel();
$tai_khoan_id = $_POST['tai_khoan_id'];
$taiKhoan__Get_By_Id = $taiKhoan->TaiKhoan__Get_By_Id($tai_khoan_id);
?>

<div class="main-update">
    <h3 class="section-title">Cập nhật tài khoản</h3>
    <form class="form-group" action="pages/tai-khoan/action.php?req=update" method="post">
        <input type="hidden" class="form-control" id="tai_khoan_id" name="tai_khoan_id" required value="<?= $taiKhoan__Get_By_Id->tai_khoan_id ?>" readonly>
        <input type="hidden" class="form-control" id="mat_khau_cu" name="mat_khau_cu" required value="<?= $taiKhoan__Get_By_Id->mat_khau?>" readonly>
        <div class="col">
            <label for="ten_hien_thi" class="form-label">Tên hiển thị</label>
            <input type="text" class="form-control" id="ten_hien_thi" name="ten_hien_thi" required value="<?= $taiKhoan__Get_By_Id->ten_hien_thi ?>">
        </div>
        <div class="col">
            <label for="ten_tai_khoan" class="form-label">Tên tài khoản</label>
            <input type="text" class="form-control" id="ten_tai_khoan" name="ten_tai_khoan" required value="<?= $taiKhoan__Get_By_Id->ten_tai_khoan ?>">
        </div>
        <div class="col">
            <label for="mat_khau" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="mat_khau" name="mat_khau" value="" placeholder="Bỏ qua nếu không đổi mật khẩu">
        </div>
        <div class="col">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <select class="form-select " aria-label=". trang_thai" id="trang_thai" name="trang_thai">
                <option value="1" <?=$taiKhoan__Get_By_Id->trang_thai == 1 ? "selected" : ""?> >Hoạt động</option>
                <option value="0" <?=$taiKhoan__Get_By_Id->trang_thai == 0 ? "selected" : ""?> >Khóa</option>
            </select>
        </div>
        <div class="col">
            <label for="phan_quyen" class="form-label">Phân quyền</label>
            <select class="form-select " aria-label=". phan_quyen" id="phan_quyen" name="phan_quyen">
                <option value="1" <?=$taiKhoan__Get_By_Id->phan_quyen == 1 ? "selected" : ""?>>Manager</option>
                <option value="2" <?=$taiKhoan__Get_By_Id->phan_quyen == 2 ? "selected" : ""?>>User</option>
            </select>
        </div>
        <br />
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            <button type="button" onclick="return location.reload()" class="btn btn-secondary">Hủy</button>
        </div>
    </form>
</div>