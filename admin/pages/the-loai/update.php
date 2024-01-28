<?php
require_once '../../../model/TheLoaiModel.php';
$theLoai = new TheLoaiModel();
$the_loai_id = $_POST['the_loai_id'];
$theLoai__Get_By_Id = $theLoai->TheLoai__Get_By_Id($the_loai_id);
?>

<div class="main-update">
    <h3 class="section-title">Cập nhật thể loại</h3>
    <form class="form-group" action="pages/the-loai/action.php?req=update" method="post">
        <input type="hidden" class="form-control" id="the_loai_id" name="the_loai_id" required value="<?= $theLoai__Get_By_Id->the_loai_id ?>" readonly>
        <div class="col">
            <label for="the_loai_ten" class="form-label">Tên thể loại</label>
            <input type="text" class="form-control" id="the_loai_ten" name="the_loai_ten" required value="<?= $theLoai__Get_By_Id->the_loai_ten ?>">
        </div>
        <div class="col">
            <label for="the_loai_mo_ta" class="form-label">Mô tả</label>
            <textarea class="form-control" id="the_loai_mo_ta" name="the_loai_mo_ta" required ><?= $theLoai__Get_By_Id->the_loai_mo_ta ?></textarea>
        </div>
        <br />
        <div class="col text-center">
            <button type="submit" class="btn btn-danger">Cập nhật</button>
            <button type="button" onclick="return location.reload()" class="btn btn-secondary">Hủy</button>
        </div>
    </form>
</div>