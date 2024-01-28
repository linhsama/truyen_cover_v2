<div class="auth-container row">
    <div class="logo-wrapper col-4">
        <img src="../assets/images/register.png" alt="login" class="img-fluid">
    </div>
    <div class=" form-wrapper col-8">
        <img src="../assets/images/logo.png" alt="logo" class="img-fluid">
        <h3 class="text-title mb-5">Chào mừng bạn mới!</h3>
        <form action="pages/action.php?req=dang-ky" method="post">
            <div class="form-group">
                <label for="ten_hien_thi">Tên hiển thị</label>
                <input type="text" name="ten_hien_thi" id="ten_hien_thi" class="form-control" required
                    placeholder="Nhập tên hiển thị">
            </div>
            <div class="form-group">
                <label for="ten_tai_khoan">Tên tài khoản</label>
                <input type="text" name="ten_tai_khoan" id="ten_tai_khoan" class="form-control" required
                    placeholder="Nhập tên tài khoản">
            </div>
            <div class="form-group">
                <label for="mat_khau">Mật khẩu</label>
                <input type="password" name="mat_khau" id="mat_khau" class="form-control" required
                    placeholder="Nhập mật khẩu">
            </div>
            <br>
            <div class="form-group text-center">
                <button class="btn btn-success w-100" type="submit">Đăng ký</button>
            </div>
        </form>
        <hr>
        <p class="footer-text">Bạn đã có tài khoản? <a href="index.php?pages=dang-nhap" class="text-danger">Đăng nhập
                ngay!</a></p>
    </div>
</div>