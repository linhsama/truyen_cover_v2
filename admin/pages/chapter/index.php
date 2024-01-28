<?php
require_once '../model/ChapterModel.php';
require_once '../model/TruyenModel.php';
$chapter = new ChapterModel();
$truyen = new TruyenModel();
$truyen_id = $_GET['truyen_id'];
$truyen__Get_By_Id = $truyen->truyen__Get_By_Id($truyen_id);
$chapter__Get_By_Truyen_Id = $chapter->Chapter__Get_By_Truyen_Id($truyen_id);
?>

<div id="main-container">
    <div class="main-title">
        <h3>Quản lý chapter</h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">Quản lý truyện</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="index.php?pages=truyen">Danh sách truyện</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="index.php?pages=chapter&truyen_id=<?= $truyen_id ?>">Danh sách chapter</a>
            </li>
        </ul>
    </div>
    <div class="row section-container">
        <div class="col-8">
            <div class="main-data">
                <h3 class="section-title">Danh sách chapter truyện <b><?= $truyen__Get_By_Id->truyen_ten ?></b></h3>
                <div class="table-responsive">
                    <table id="table_js" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên chapter</th>
                                <th>Chapter số</th>
                                <th>Ngày cập nhật</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($chapter__Get_By_Truyen_Id as $item) : ?>
                                <tr>
                                    <td><?= $item->chapter_id ?></td>
                                    <td><?= $item->chapter_ten ?></td>
                                    <td><?= $item->chapter_so ?></td>
                                    <td><?= $item->chapter_ngay_cap_nhat ?></td>
                                    <td class="text-center font-weight-bold">
                                        <button type="button" class="btn btn-success btn-update" onclick="return update_chapter_obj('<?= $item->chapter_id ?>')">
                                            <i class="fa fa-edit" aria-hidden="true"></i> Quản lý nội dung chapter
                                        </button>
                                        <button type="button" class="btn btn-warning btn-update" onclick="return update_obj('<?= $item->chapter_id ?>')">
                                            <i class="fa fa-edit" aria-hidden="true"></i> Sửa
                                        </button>
                                        <?php if (isset($_SESSION['admin'])) : ?>
                                            <button type="button" class="btn btn-danger btn-delete" onclick="return delete_obj('<?= $item->chapter_id ?>')">
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
    function update_chapter_obj(chapter_id) {
        location.href = "index.php?pages=chapter-noi-dung&chapter_id=" + chapter_id;
    };

    function update_obj(chapter_id) {
        $.post("pages/chapter/update.php", {
            chapter_id: chapter_id,
        }, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function add_obj() {
        $.post("pages/chapter/add.php", {}, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function delete_obj(chapter_id) {
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
                location.href = "pages/chapter/action.php?req=delete&chapter_id=" + chapter_id;
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            );
        });
    };
    window.addEventListener('load', function() {
        document.getElementById('dynamicTitle').innerText = "ADMIN | Quản lý chapter";
    })
</script>