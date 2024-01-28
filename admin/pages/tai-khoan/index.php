<?php
if (!isset($_SESSION['admin'])) {
    header("location: index.php?pages=trang-loi&error=" . 'Bạn không có quyền truy cập trang nay!');
    exit();
}
require_once '../model/TaiKhoanModel.php';
$taiKhoan = new TaiKhoanModel();
$taiKhoan__Get_All = $taiKhoan->TaiKhoan__Get_All();
?>

<div id="main-container">
    <div class="main-title">
        <h3>Quản lý tài khoản</h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">Quản lý tài khoản</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="index.php?pages=tai-khoan">Danh sách tài khoản</a>
            </li>
        </ul>
    </div>
    <div class="row section-container">
        <div class="col-8">
            <div class="main-data">
                <h3 class="section-title">Danh sách tài khoản</h3>
                <div class="table-responsive">
                    <table id="table_js" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên tài khoản</th>
                                <th>Tên tài khoản</th>
                                <th>Phân quyền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($taiKhoan__Get_All as $item) : ?>
                                <tr>
                                    <td><?= $item->tai_khoan_id ?></td>
                                    <td><?= $item->ten_hien_thi ?></td>
                                    <td><?= $item->ten_tai_khoan ?></td>
                                    <td><?= $item->phan_quyen == '0' ? "<b class='text-danger'>Admin</b>" : ($item->phan_quyen == '1' ? "<b class='text-warning'>Manager</b>" : "<b class='text-primary'>User</b>") ?></td>
                                    <td><?= $item->trang_thai == '1' ? "<b class='text-success'>Hoạt động</b>" : "<b class='text-danger'>Khóa</b>" ?></td>
                                    <td class="text-center font-weight-bold">
                                        <button type="button" class="btn btn-warning btn-update" onclick="return update_obj('<?= $item->tai_khoan_id ?>')">
                                            <i class="fa fa-edit" aria-hidden="true"></i> Sửa
                                        </button>
                                        <?php if (isset($_SESSION['admin'])) : ?>
                                            <button type="button" class="btn btn-danger btn-delete" onclick="return delete_obj('<?= $item->tai_khoan_id ?>')">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                            </button>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-4">
            <div class="main-form">
                <?php require_once 'add.php' ?>
            </div>
        </div>
    </div>
</div>

<script>
    function update_obj(tai_khoan_id) {
        $.post("pages/tai-khoan/update.php", {
            tai_khoan_id: tai_khoan_id,
        }, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function add_obj() {
        $.post("pages/tai-khoan/add.php", {}, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function delete_obj(tai_khoan_id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "m-2 btn btn-danger",
                cancelButton: "m-2 btn btn-secondary"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Xác nhận thao tác",
            text: "Chắc chắn xóa!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Xóa!",
            cancelButtonText: "Hủy!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "pages/tai-khoan/action.php?req=delete&tai_khoan_id=" + tai_khoan_id;
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            );
        });
    };
    window.addEventListener('load', function() {
        document.getElementById('dynamicTitle').innerText = "ADMIN | Quản lý tài khoản";
    })
</script>