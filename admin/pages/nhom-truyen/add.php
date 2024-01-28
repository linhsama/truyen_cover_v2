<div class="main-add">
    <h3 class="section-title">Thêm nhóm truyện</h3>
    <form class="form-group" action="pages/nhom-truyen/action.php?req=add" method="post">
        <div class="col">
            <label for="nhom_truyen_ten" class="form-label">Tên nhóm truyện</label>
            <input type="text" class="form-control" id="nhom_truyen_ten" name="nhom_truyen_ten" required>
        </div>
        <div class="col">
            <label for="nhom_truyen_mo_ta" class="form-label">Mô tả</label>
            <textarea class="form-control" id="nhom_truyen_mo_ta" name="nhom_truyen_mo_ta"></textarea>
        </div>
        <br />
        <div class="col text-center">
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
        </div>
    </form>
</div>