<div class="main-add">
    <h3 class="section-title">Thêm thể loại</h3>
    <form class="form-group" action="pages/the-loai/action.php?req=add" method="post">
        <div class="col">
            <label for="the_loai_ten" class="form-label">Tên thể loại</label>
            <input type="text" class="form-control" id="the_loai_ten" name="the_loai_ten" required>
        </div>
        <div class="col">
            <label for="the_loai_mo_ta" class="form-label">Mô tả</label>
            <textarea class="form-control" id="the_loai_mo_ta" name="the_loai_mo_ta"></textarea>
        </div>
        <br />
        <div class="col text-center">
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
        </div>
    </form>
</div>