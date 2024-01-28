<?php
require_once '../model/TheLoaiModel.php';
require_once '../model/NhomTruyenModel.php';
$theLoai = new TheLoaiModel();
$nhomTruyen = new NhomTruyenModel();
$theLoai__Get_All = $theLoai->TheLoai__Get_All();
$nhomTruyen__Get_All = $nhomTruyen->nhomTruyen__Get_All();

?>

<div class="main-add">
    <h3 class="section-title">Thêm truyện</h3>
    <form class="form-group" action="pages/truyen/action.php?req=add" method="post" enctype="multipart/form-data" id="formTruyen">

        <div class="col">
            <label for="truyen_ten" class="form-label">Tên truyện</label>
            <input type="text" class="form-control" id="truyen_ten" name="truyen_ten" required>
        </div>
        <div class="col">
            <label for="truyen_tac_gia" class="form-label">Tên tác giả</label>
            <input type="text" class="form-control" id="truyen_tac_gia" name="truyen_tac_gia" required>
            <div class="col">
                <label for="truyen_anh_bia" class="form-label">Ảnh bìa</label>
                <input accept="image/*" type='file' class="form-control" id="truyen_anh_bia" name="truyen_anh_bia" required>
                <div id="truyen_anh_bia_preview"></div>
            </div>
        </div>
        <div class="col">
            <label for="truyen_trang_thai" class="form-label">Trạng thái</label>
            <select class="form-select " aria-label=". truyen_trang_thai" id="truyen_trang_thai" name="truyen_trang_thai">
                <option value="1" selected>Công bố</option>
                <option value="0">Tạm ẩn</option>
            </select>
        </div>
        <div class="col">
            <label for="truyen_mo_ta" class="form-label">Mô tả</label>
            <textarea class="form-control" id="truyen_mo_ta" name="truyen_mo_ta" required></textarea>
        </div>
        <div class="col">
            <label>Chọn thể loại:</label>
            <?php foreach ($theLoai__Get_All as $item) : ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="the_loai_id<?= $item->the_loai_id ?>" value="<?= $item->the_loai_id ?>" name="the_loai_id[]">
                    <label class="form-check-label" for="the_loai_id<?= $item->the_loai_id ?>"><?= $item->the_loai_ten ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col">
            <label>Chọn nhóm truyện:</label>
            <?php foreach ($nhomTruyen__Get_All as $item) : ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="nhom_truyen_id<?= $item->nhom_truyen_id ?>" value="<?= $item->nhom_truyen_id ?>" name="nhom_truyen_id">
                    <label class="form-check-label" for="nhom_truyen_id<?= $item->nhom_truyen_id ?>"><?= $item->nhom_truyen_ten ?></label>
                </div>
            <?php endforeach; ?>
        </div>


        <br />
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
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