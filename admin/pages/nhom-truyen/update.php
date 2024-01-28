<?php
require_once '../../../model/NhomTruyenModel.php';
$nhomTruyen = new NhomTruyenModel();
$nhom_truyen_id = $_POST['nhom_truyen_id'];
$nhomTruyen__Get_By_Id = $nhomTruyen->NhomTruyen__Get_By_Id($nhom_truyen_id);
?>

<div class="main-update">
    <h3 class="section-title">Cập nhật nhóm truyện</h3>
    <form class="form-group" action="pages/nhom-truyen/action.php?req=update" method="post">
        <input type="hidden" class="form-control" id="nhom_truyen_id" name="nhom_truyen_id" required value="<?= $nhomTruyen__Get_By_Id->nhom_truyen_id ?>" readonly>
        <div class="col">
            <label for="nhom_truyen_ten" class="form-label">Tên nhóm truyện</label>
            <input type="text" class="form-control" id="nhom_truyen_ten" name="nhom_truyen_ten" required value="<?= $nhomTruyen__Get_By_Id->nhom_truyen_ten ?>">
        </div>
        <div class="col">
            <label for="nhom_truyen_mo_ta" class="form-label">Mô tả</label>
            <textarea class="form-control" id="nhom_truyen_mo_ta" name="nhom_truyen_mo_ta" required ><?= $nhomTruyen__Get_By_Id->nhom_truyen_mo_ta ?></textarea>
        </div>
        <br />
        <div class="col text-center">
            <button type="submit" class="btn btn-danger">Cập nhật</button>
            <button type="button" onclick="return location.reload()" class="btn btn-secondary">Hủy</button>
        </div>
    </form>
</div>