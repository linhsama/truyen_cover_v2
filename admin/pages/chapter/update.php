<?php
require_once '../../../model/ChapterModel.php';
require_once '../../../model/TruyenModel.php';
$chapter = new ChapterModel();
$truyen = new TruyenModel();
$chapter_id = $_POST['chapter_id'];
$chapter__Get_By_Id = $chapter->Chapter__Get_By_Id($chapter_id);
$truyen_id = $chapter__Get_By_Id->truyen_id;
$truyen__Get_By_Id = $truyen->truyen__Get_By_Id($truyen_id);
?>

<div class="main-update">
    <h3 class="section-title">Cập nhật chapter</h3>
    <form class="form-group" action="pages/chapter/action.php?req=update" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="chapter_id" name="chapter_id" required value="<?=$chapter__Get_By_Id->chapter_id?>" readonly>
        <input type="hidden" class="form-control" id="truyen_id" name="truyen_id" required value="<?= $chapter__Get_By_Id->truyen_id ?>" readonly>
        <div class="col">
            <label for="chapter_ten" class="form-label">Tên chapter</label>
            <input type="text" class="form-control" id="chapter_ten" name="chapter_ten" required value="<?=$chapter__Get_By_Id->chapter_ten?>">
        </div>
        <div class="col">
            <label for="chapter_trang_thai" class="form-label">Trạng thái</label>
            <select class="form-select " aria-label=". chapter_trang_thai" id="chapter_trang_thai" name="chapter_trang_thai">
                <option value="1" selected>Công bố</option>
                <option value="0">Tạm ẩn</option>
            </select>
        </div>
        <div class="col">
            <label for="chapter_ngay_cap_nhat" class="form-label">Ngày cập nhật</label>
            <input type="text" class="form-control" id="chapter_ngay_cap_nhat" name="chapter_ngay_cap_nhat" required value="<?=$chapter__Get_By_Id->chapter_ngay_cap_nhat?>">
        </div>
        <div class="col">
            <label for="chapter_so" class="form-label">Chapter số</label>
            <input type="text" class="form-control" id="chapter_so" name="chapter_so" required value="<?=$chapter__Get_By_Id->chapter_so?>" readonly>
        </div>
        <div class="col">
            <label for="truyen_ten" class="form-label">Tên truyện</label>
            <input type="text" class="form-control" id="truyen_ten" name="truyen_ten" required value="<?=$truyen__Get_By_Id->truyen_ten?>" readonly>
        </div>
        <br />
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            <button type="button" onclick="return location.reload()" class="btn btn-secondary">Hủy</button>
        </div>
    </form>
</div>
