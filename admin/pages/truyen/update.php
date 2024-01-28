<?php
require_once '../../../model/TruyenModel.php';
require_once '../../../model/TruyenTheLoaiModel.php';
require_once '../../../model/TheLoaiModel.php';
require_once '../../../model/NhomTruyenModel.php';
$truyen = new TruyenModel();
$truyenTheLoai = new TruyenTheLoaiModel();
$theLoai = new TheLoaiModel();
$nhomTruyen = new NhomTruyenModel();
$truyen_id = $_POST['truyen_id'];
$truyen__Get_By_Id = $truyen->Truyen__Get_By_Id($truyen_id);
$truyenTheLoai__Get_By_Truyen_Id = $truyenTheLoai->TruyenTheLoai__Get_By_Truyen_Id($truyen_id);
$theLoai__Get_All = $theLoai->TheLoai__Get_All();
$nhomTruyen__Get_All = $nhomTruyen->NhomTruyen__Get_All();
?>

<div class="main-update">
    <h3 class="section-title">Cập nhật truyện</h3>
    <form class="form-group" action="pages/truyen/action.php?req=update" method="post" enctype="multipart/form-data" id="formTruyen">
        <input type="hidden" class="form-control" id="truyen_id" name="truyen_id" required value="<?= $truyen__Get_By_Id->truyen_id ?>" readonly>
        <input type="hidden" class="form-control" id="truyen_anh_bia_cu" name="truyen_anh_bia_cu" required value="<?= $truyen__Get_By_Id->truyen_anh_bia ?>" readonly>
        <input type="hidden" class="form-control" id="truyen_luot_xem" name="truyen_luot_xem" required readonly value="<?= $truyen__Get_By_Id->truyen_luot_xem ?>">
        <div class="col">
            <label for="truyen_ten" class="form-label">Tên truyện</label>
            <input type="text" class="form-control" id="truyen_ten" name="truyen_ten" required value="<?= $truyen__Get_By_Id->truyen_ten ?>">
        </div>
        <div class="col">
            <label for="truyen_tac_gia" class="form-label">Tên tác giả</label>
            <input type="text" class="form-control" id="truyen_tac_gia" name="truyen_tac_gia" required value="<?= $truyen__Get_By_Id->truyen_tac_gia ?>">
        </div>
        <div class="col">
            <label for="truyen_anh_bia" class="form-label">Ảnh bìa</label>
            <input accept="image/*" type='file' class="form-control" id="truyen_anh_bia" name="truyen_anh_bia">
            <div id="truyen_anh_bia_preview"><img src="../assets/<?= $truyen__Get_By_Id->truyen_anh_bia ?>" alt="<?= $truyen__Get_By_Id->truyen_ten ?>" class="img-fluid" width="200"></div>
        </div>
        <div class="col">
            <label for="truyen_trang_thai" class="form-label">Trạng thái</label>
            <select class="form-select " aria-label=". truyen_trang_thai" id="truyen_trang_thai" name="truyen_trang_thai">
                <option value="1" <?= $truyen__Get_By_Id->truyen_trang_thai == 1 ? "selected" : "" ?>>Công bố</option>
                <option value="0" <?= $truyen__Get_By_Id->truyen_trang_thai == 0 ? "selected" : "" ?>>Tạm ẩn</option>
            </select>
        </div>
        <div class="col">
            <label for="truyen_mo_ta" class="form-label">Mô tả</label>
            <textarea class="form-control" id="truyen_mo_ta" name="truyen_mo_ta" required><?= $truyen__Get_By_Id->truyen_mo_ta ?></textarea>
        </div>
        <div class="col">
            <label for="truyen_tinh_trang" class="form-label">Tình trạng</label>
            <select class="form-select " aria-label=". truyen_tinh_trang" id="truyen_tinh_trang" name="truyen_tinh_trang">
                <option value="1" <?= $truyen__Get_By_Id->truyen_tinh_trang == 1 ? "selected" : "" ?>>Đang tiến hành
                </option>
                <option value="2" <?= $truyen__Get_By_Id->truyen_tinh_trang == 2 ? "selected" : "" ?>>Hoàn thành
                </option>
                <option value="3" <?= $truyen__Get_By_Id->truyen_tinh_trang == 3 ? "selected" : "" ?>>Tạm ngừng</option>
            </select>
        </div>
        <div class="col">
            <label>Chọn thể loại:</label>
            <?php foreach ($theLoai__Get_All as $item) : ?>
                <?php
                $isChecked = false;
                foreach ($truyenTheLoai__Get_By_Truyen_Id as $truyenTheLoaiItem) {
                    if ($item->the_loai_id == $truyenTheLoaiItem->the_loai_id) {
                        $isChecked = true;
                        break;
                    }
                }
                ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="the_loai_id<?= $item->the_loai_id ?>" value="<?= $item->the_loai_id ?>" name="the_loai_id[]" <?= $isChecked ? 'checked' : '' ?>>
                    <label class="form-check-label" for="the_loai_id<?= $item->the_loai_id ?>"><?= $item->the_loai_ten ?></label>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col">
            <label>Chọn nhóm truyện:</label>
            <?php foreach ($nhomTruyen__Get_All as $item) : ?>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="nhom_truyen_id<?= $item->nhom_truyen_id ?>" value="<?= $item->nhom_truyen_id ?>" name="nhom_truyen_id" <?= $item->nhom_truyen_id == $truyen__Get_By_Id->nhom_truyen_id ? 'checked' : '' ?>>
                    <label class="form-check-label" for="nhom_truyen_id<?= $item->nhom_truyen_id ?>"><?= $item->nhom_truyen_ten ?></label>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col">
            <label for="truyen_ngay_dang" class="form-label">Ngày đăng</label>
            <input type="text" class="form-control" id="truyen_ngay_dang" name="truyen_ngay_dang" required readonly value="<?= $truyen__Get_By_Id->truyen_ngay_dang ?>">
        </div>
        <br />
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            <button type="button" onclick="return location.reload()" class="btn btn-secondary">Hủy</button>
        </div>
    </form>
</div>


<script>
    // Lấy ra đối tượng input có id là 'truyen_anh_bia'
    var truyen_anh_bia = document.getElementById('truyen_anh_bia');
    // Lấy ra đối tượng hiển thị ảnh preview có id là 'truyen_anh_bia_preview'
    var truyen_anh_bia_preview = document.getElementById('truyen_anh_bia_preview');

    // Khi giá trị của input 'truyen_anh_bia' thay đổi
    truyen_anh_bia.addEventListener('change', function(evt) {
        // Lấy ra mảng các file được chọn trong input
        var [file] = truyen_anh_bia.files;

        // Kiểm tra xem có file nào được chọn không
        if (file) {
            // Kiểm tra loại MIME của tệp tin
            if (file.type.startsWith('image/')) {
                // Nếu là ảnh, thì hiển thị nó
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'truyen_anh_bia_preview';
                img.style.width = '200px';
                img.style.height = '300px';
                truyen_anh_bia_preview.innerHTML = '';
                truyen_anh_bia_preview.appendChild(img);
            } else {
                // Nếu không phải là ảnh, thông báo lỗi
                alert('Vui lòng chọn một tệp tin hình ảnh.');
                // Đặt giá trị của input file về rỗng để xóa tệp đã chọn
                truyen_anh_bia.value = '';
            }
        }
    });
</script>


<script>
    // Function to check if at least one checkbox is checked
    function isAnyCheckboxChecked() {
        var checkboxes = document.getElementsByName('the_loai_id[]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                return true;
            }
        }
        return false;
    }

    // Function to validate the form before submission
    function validateForm() {
        if (!isAnyCheckboxChecked()) {
            alert('Vui lòng chọn ít nhất một thể loại.');
            return false;
        }
        return true;
    }

    // Add the onsubmit attribute to the form to call the validateForm function
    document.getElementById('formTruyen').onsubmit = validateForm;
</script>