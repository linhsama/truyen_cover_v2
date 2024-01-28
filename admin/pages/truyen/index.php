<?php
require_once '../model/TruyenModel.php';
require_once '../model/TruyenTheLoaiModel.php';
require_once '../model/ChapterModel.php';
$truyen = new TruyenModel();
$chapter = new ChapterModel();
$truyenTheLoai = new TruyenTheLoaiModel();
$truyen__Get_All = $truyen->Truyen__Get_All();
function getRandomColor()
{
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

$itemColors = [];

?>

<div id="main-container">
    <div class="main-title">
        <h3>Quản lý truyện</h3>
        <ul class="breadcrumb">
            <li>
                <a href="#">Quản lý truyện</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="index.php?pages=truyen">Danh sách truyện</a>
            </li>
        </ul>
    </div>
    <div class="row section-container">
        <div class="col-8">
            <div class="main-data">
                <h3 class="section-title">Danh sách truyện</h3>
                <div class="table-responsive">
                    <table id="table_js" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh bìa</th>
                                <th>Tên truyện</th>
                                <th>Tác giả</th>
                                <th>Thể loại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($truyen__Get_All as $item) : ?>
                                <tr>
                                    <td><?= $item->truyen_id ?></td>
                                    <td><img src="../assets/<?=$item->truyen_anh_bia ?>" alt="<?= $item->truyen_ten ?>" class="img-fluid" width="100"></td>
                                    <td><?= $item->truyen_ten ?></td>
                                    <td><?= $item->truyen_tac_gia ?></td>
                                    <?php
                                    $truyenTheLoai__Get_By_Truyen_Id = $truyenTheLoai->TruyenTheLoai__Get_By_Truyen_Id($item->truyen_id);
                                    ?>
                                    <td>
                                        <?php
                                        foreach ($truyenTheLoai__Get_By_Truyen_Id as $item) {
                                            $itemName = $item->the_loai_ten;
                                            $itemColors[$itemName] = getRandomColor();
                                        }
                                        ?>

                                        <?php if (count($truyenTheLoai__Get_By_Truyen_Id) > 0) : ?>
                                            <?php foreach ($truyenTheLoai__Get_By_Truyen_Id as $item) : ?>
                                                <?php
                                                $itemName = $item->the_loai_ten;
                                                $badgeColor = isset($itemColors[$itemName]) ? $itemColors[$itemName] : 'secondary';
                                                ?>
                                                <span class="badge" style="background-color: <?= $badgeColor ?>;"><?= $itemName ?></span>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <span class="badge bg-secondary">Không có thể loại</span>
                                        <?php endif; ?>
                                    </td>


                                    <td class="text-center font-weight-bold">
                                        <button type="button" class="btn btn-success btn-sm btn-update" onclick="return update_chapter_obj('<?= $item->truyen_id ?>')">
                                           Quản lý Chapter (<?=count($chapter->Chapter__Get_By_Truyen_Id($item->truyen_id))?>)
                                        </button>
                                        <br>
                                        <button type="button" class="btn btn-warning btn-update mt-2" onclick="return update_obj('<?= $item->truyen_id ?>')">
                                            Sửa
                                        </button>
                                        <?php if (isset($_SESSION['admin'])) : ?>
                                            <button type="button" class="btn btn-danger btn-delete mt-2" onclick="return delete_obj('<?= $item->truyen_id ?>')">
                                                Xóa
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
    function update_chapter_obj(truyen_id) {
        location.href = "index.php?pages=chapter&truyen_id=" + truyen_id;
    };

    function update_obj(truyen_id) {
        $.post("pages/truyen/update.php", {
            truyen_id: truyen_id,
        }, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function add_obj() {
        $.post("pages/truyen/add.php", {}, function(data, status) {
            $(".main-form").html(data);
        });
    };

    function delete_obj(truyen_id) {
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
                location.href = "pages/truyen/action.php?req=delete&truyen_id=" + truyen_id;
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            );
        });
    };
    window.addEventListener('load', function() {
        document.getElementById('dynamicTitle').innerText = "ADMIN | Quản lý truyện";
    })
</script>