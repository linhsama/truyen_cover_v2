<?php
require_once '../../../model/ChapterNoiDungModel.php';
require_once '../../../model/ChapterModel.php';
$chapter_noi_dung = new ChapterNoiDungModel();
$chapter = new ChapterModel();
$chapter_noi_dung_id = $_POST['chapter_noi_dung_id'];
$chapterNoiDung__Get_By_Id = $chapter_noi_dung->ChapterNoiDung__Get_By_Id($chapter_noi_dung_id);
$chapter_id = $chapterNoiDung__Get_By_Id->chapter_id;
$chapter__Get_By_Id = $chapter->chapter__Get_By_Id($chapter_id);
?>

<div class="main-update">
    <h3 class="section-title">Cập nhật chapter nội dung</h3>
    <form class="form-group" action="pages/chapter/action.php?req=c_update" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="chapter_noi_dung_image_cu" name="chapter_noi_dung_image_cu" required value="<?=$chapterNoiDung__Get_By_Id->chapter_noi_dung_image?>" readonly>
        <input type="hidden" class="form-control" id="chapter_noi_dung_id" name="chapter_noi_dung_id" required value="<?=$chapterNoiDung__Get_By_Id->chapter_noi_dung_id?>" readonly>
        <input type="hidden" class="form-control" id="chapter_id" name="chapter_id" required value="<?= $chapter_id ?>" readonly>
        <div class="col">
            <label for="chapter_noi_dung_image" class="form-label">Chapter nội dung</label>
            <input accept="image/*" type='file' class="form-control" id="chapter_noi_dung_image" name="chapter_noi_dung_image">
            <div id="chapter_noi_dung_image_preview"><img src="../assets/<?=$chapterNoiDung__Get_By_Id->chapter_noi_dung_image ?>" alt="<?= $chapterNoiDung__Get_By_Id->chapter_id ?>" class="img-fluid" width="200"></div>
        </div>
        <div class="col">
            <label for="chapter_ten" class="form-label">Tên chapter</label>
            <input type="text" class="form-control" id="chapter_ten" name="chapter_ten" required value="<?=$chapter__Get_By_Id->chapter_ten?>" readonly>
        </div>
        <br>
        <div class="col text-center">
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
            <button type="button" onclick="return location.reload()" class="btn btn-secondary">Hủy</button>
        </div>
    </form>
</div>


<script>

// Lấy ra đối tượng input có id là 'chapter_noi_dung_image'
    var chapter_noi_dung_image = document.getElementById('chapter_noi_dung_image');
    // Lấy ra đối tượng hiển thị ảnh preview có id là 'chapter_noi_dung_image_preview'
    var chapter_noi_dung_image_preview = document.getElementById('chapter_noi_dung_image_preview');

    // Khi giá trị của input 'chapter_noi_dung_image' thay đổi
    chapter_noi_dung_image.addEventListener('change', function(evt) {
        // Lấy ra mảng các file được chọn trong input
        var [file] = chapter_noi_dung_image.files;

        // Kiểm tra xem có file nào được chọn không
        if (file) {
            // Kiểm tra loại MIME của tệp tin
            if (file.type.startsWith('image/')) {
                // Nếu là ảnh, thì hiển thị nó
                var img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'chapter_noi_dung_image_preview';
                img.style.width = '200px';
                img.style.height = '300px';
                chapter_noi_dung_image_preview.innerHTML = '';
                chapter_noi_dung_image_preview.appendChild(img);
            } else {
                // Nếu không phải là ảnh, thông báo lỗi
                alert('Vui lòng chọn một tệp tin hình ảnh.');
                // Đặt giá trị của input file về rỗng để xóa tệp đã chọn
                chapter_noi_dung_image.value = '';
            }
        }
    });
</script>