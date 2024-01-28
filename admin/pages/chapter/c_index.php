<?php
require_once '../model/ChapterNoiDungModel.php';
require_once '../model/ChapterModel.php';
$chapter_noi_dung = new ChapterNoiDungModel();
$chapter = new ChapterModel();
$chapter_id = $_GET['chapter_id'];
$chapter__Get_By_Id = $chapter->chapter__Get_By_Id($chapter_id);
$chapter_noi_dung__Get_By_Chapter_Id = $chapter_noi_dung->ChapterNoiDung__Get_By_Chapter_Id($chapter_id);
$truyen_id = $chapter__Get_By_Id->truyen_id;
?>

<div id="main-container">
    <div class="main-title">
        <h3>Quản lý chapter nội dung</h3>
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
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="index.php?pages=chapter-noi-dung&chapter_id=<?= $chapter_id ?>">Danh sách
                    chapter nội dung</a>
            </li>
        </ul>
    </div>
    <div class="row section-container">
        <div class="col-8">
            <div class="main-data">
                <h3 class="section-title">Danh sách nội dung chapter <b><?= $chapter__Get_By_Id->chapter_ten ?></b></h3>
                <div class="table-responsive">
                    <table id="table_js" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nội dung</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($chapter_noi_dung__Get_By_Chapter_Id as $item) : ?>
                            <tr>
                                <td><?= $item->chapter_noi_dung_id ?></td>
                                <td><img src="../assets/<?= $item->chapter_noi_dung_image ?>"
                                        alt="<?= $item->chapter_noi_dung_id ?>" class="img-fluid" width="100"></td>
                                <td class="text-center font-weight-bold">
                                    <button type="button" class="btn btn-warning btn-update"
                                        onclick="return update_obj('<?= $item->chapter_noi_dung_id ?>')">
                                        <i class="fa fa-edit" aria-hidden="true"></i> Sửa
                                    </button>
                                    <?php if (isset($_SESSION['admin'])) : ?>
                                    <button type="button" class="btn btn-danger btn-delete"
                                        onclick="return delete_obj('<?= $item->chapter_noi_dung_id ?>')">
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
                <?php require_once 'c_add.php' ?>
            </div>
        </div>
    </div>
</div>

<script>
function update_obj(chapter_noi_dung_id) {
    $.post("pages/chapter/c_update.php", {
        chapter_noi_dung_id: chapter_noi_dung_id,
    }, function(data, status) {
        $(".main-form").html(data);
    });
};

function add_obj() {
    $.post("pages/chapter/c_add.php", {}, function(data, status) {
        $(".main-form").html(data);
    });
};

function delete_obj(chapter_noi_dung_id) {
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
            location.href = "pages/chapter/action.php?req=c_delete&chapter_noi_dung_id=" +
                chapter_noi_dung_id;
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        );
    });
};
window.addEventListener('load', function() {
    document.getElementById('dynamicTitle').innerText = "ADMIN | Chapter nội dung";
})
</script>