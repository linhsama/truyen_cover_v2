<div class="main-add">
    <h3 class="section-title">Thêm tài khoản</h3>
    <form class="form-group" action="pages/tai-khoan/action.php?req=add" method="post">
        <div class="col">
            <label for="ten_hien_thi" class="form-label">Tên hiển thị</label>
            <input type="text" class="form-control" id="ten_hien_thi" name="ten_hien_thi" required>
        </div>
        <div class="col">
            <label for="ten_tai_khoan" class="form-label">Tên tài khoản</label>
            <input type="text" class="form-control" id="ten_tai_khoan" name="ten_tai_khoan" required>
        </div>
        <div class="col">
            <label for="mat_khau" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="mat_khau" name="mat_khau" required>
        </div>
        <div class="col">
            <label for="trang_thai" class="form-label">Trạng thái</label>
            <select class="form-select " aria-label=". trang_thai" id="trang_thai" name="trang_thai">
                <option value="1" selected>Hoạt động</option>
                <option value="0">Khóa</option>
            </select>
        </div>
        <div class="col">
            <label for="phan_quyen" class="form-label">Phân quyền</label>
            <select class="form-select " aria-label=". phan_quyen" id="phan_quyen" name="phan_quyen">
                <option value="1" selected>Mod</option>
                <option value="2">User</option>
            </select>
        </div>
        <br />
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
        </div>
    </form>
</div>