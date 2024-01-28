<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("location: ../../auth/?pages=dang-nhap");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title id="dynamicTitle">Truyện Cover</title>
</head>

<link rel="shortcut icon" href="../../assets/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../../assets/vendor/bootstrap-5.2.3-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../../assets/css/auth.css">
</head>

<body>
  <div class="login-register-container">
    <div class="auth-container">
      <div class="logo-wrapper">
        <img src="../../assets/images/login.png" alt="login" class="img-fluid">
      </div>
      <div class=" form-wrapper">
        <img src="../../assets/images/logo.png" alt="logo" class="img-fluid">
        <h3 class="text-title mb-5">Chào mừng bạn mới!</h3>
        <form action="action.php?req=chinh-sua" method="post">
          <input type="hidden" name="tai_khoan_id" id="tai_khoan_id" class="form-control" required placeholder="" value="<?= $_SESSION['user']->tai_khoan_id ?>">
          <input type="hidden" name="mat_khau_cu" id="mat_khau_cu" class="form-control" required placeholder="Nhập mật khẩu" value="<?= $_SESSION['user']->mat_khau ?>">
          <div class="form-group">
            <label for="ten_hien_thi">Tên hiển thị</label>
            <input type="text" name="ten_hien_thi" id="ten_hien_thi" class="form-control" required placeholder="Nhập tên hiển thị" value="<?= $_SESSION['user']->ten_hien_thi ?>">
          </div>
          <div class="form-group">
            <label for="ten_tai_khoan">Tên tài khoản</label>
            <input type="text" name="ten_tai_khoan" id="ten_tai_khoan" class="form-control" required placeholder="Nhập tên tài khoản" value="<?= $_SESSION['user']->ten_hien_thi ?>">
          </div>
          <div class="form-group">
            <label for="mat_khau">Mật khẩu mới</label>
            <input type="password" name="mat_khau_moi" id="mat_khau_moi" class="form-control" placeholder="Bỏ qua nếu không thay đổi">
          </div>
          <br>
          <div class="form-group text-center">
            <button class="btn btn-danger w-100" type="submit">Chỉnh sửa</button>
          </div>
        </form>
        <hr>
        <p class="footer-text">Xem truyện thôi nào ! <a href="../../index.php?pages=trang-chu" class="text-danger">Về trang chủ</a></p>
      </div>
    </div>

  </div>


  <script src="../../assets/vendor/jquery-3.7.1.js"></script>
  <script src="../../assets/vendor/bootstrap-5.2.3-dist/js/bootstrap.min.js"></script>
  <script src="../../assets/vendor/sweetalert2@11.js"></script>

  <?php if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
      case 'success':
        echo "<script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: 'success',
                        title: 'Cập nhật thành công!'
                    });
                </script>";
        break;

      case 'error':
        echo "<script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'Cập nhật không thành công!'
                        });
                    </script>";
        break;

      case 'warning':
        echo "<script>
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: 'warning',
                            title: 'Thông tin đăng nhập không chính xác hoặc tài khoản bị khóa!'
                        });
                    </script>";
        break;
    }
  } ?>
</body>

</html>