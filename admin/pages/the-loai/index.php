<?php
require_once '../model/TheLoaiModel.php';
$theLoai = new TheLoaiModel();
$theLoai__Get_All = $theLoai->TheLoai__Get_All();
?>

<div id="main-container">
    <div class="main-title">
        <h3>Quản lý thể loại</h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">Quản lý thể loại</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="index.php?pages=the-loai">Danh sách thể loại</a>
            </li>
        </ul>
    </div>
    <div class="row section-container">
        <div class="col-8">
            <div class="main-data">
                <h3 class="section-title">Danh sách thể loại</h3>
                <div class="table-responsive">
                    <table id="table_js" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên thể loại</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($theLoai__Get_All as $item) : ?>
                                <tr>
                                    <td><?= $item->the_loai_id ?></td>
                                    <td><?= $item->the_loai_ten ?></td>
                                    <td><?= $item->the_loai_mo_ta ?></td>
                                    <td class="text-center font-weight-bold">
                                        <button type="button" class="btn btn-warning btn-update" onclick="return update_obj('<?= $item->the_loai_id ?>')">
                                            <i class="fa fa-edit" aria-hidden="true"></i> Sửa
                                        </button>
                                        <?php if (isset($_SESSION['admin'])) : ?>
                                            <button type="button" class="btn btn-danger btn-delete" onclick="return delete_obj('<?= $item->the_loai_id ?>')">
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
    function update_obj(the_loai_id) {
        $.post("pages/the-loai/update.php", {
            the_loai_id: the_loai_id,
        }, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function add_obj() {
        $.post("pages/the-loai/add.php", {}, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function delete_obj(the_loai_id) {
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
                location.href = "pages/the-loai/action.php?req=delete&the_loai_id=" + the_loai_id;
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            );
        });
    };
    window.addEventListener('load', function() {
        document.getElementById('dynamicTitle').innerText = "ADMIN | Quản lý thể loại";
    })
</script>