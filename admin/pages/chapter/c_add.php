<!-- HTML -->
<div class="main-add">
    <h3 class="section-title">Thêm chapter nội dung</h3>
    <form id="chapterForm" class="form-group" action="pages/chapter/action.php?req=c_add" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" id="chapter_id" name="chapter_id" required value="<?= $chapter_id ?>" readonly>
        <div class="col">
            <label for="chapter_ten" class="form-label">Tên chapter</label>
            <input type="text" class="form-control" id="chapter_ten" name="chapter_ten" required value="<?= $chapter__Get_By_Id->chapter_ten ?>" readonly>
        </div>
        <div class="col">
            <label for="chapter_noi_dung_image" class="form-label">Chọn file (nhiều file có thể chọn)</label>
            <div class="input-group">
                <input type="file" class="form-control" id="chapter_noi_dung_image" name="chapter_noi_dung_image[]" multiple>
                <div class="input-group-append">
                    <button type="submit" id="submitButton" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>
        <div id="chapter_noi_dung_image_preview" class="image-preview"></div>
    </form>
</div>

<script>
    // Lấy ra đối tượng input có id là 'chapter_noi_dung_image'
    var chapter_noi_dung_image = document.getElementById('chapter_noi_dung_image');
    // Lấy ra đối tượng hiển thị ảnh preview có id là 'chapter_noi_dung_image_preview'
    var chapter_noi_dung_image_preview = document.getElementById('chapter_noi_dung_image_preview');

    // Biến lưu trữ danh sách các file đã chọn
    let selectedFiles = [];

    // Hàm xóa ảnh preview
    function clearImagePreview() {
        chapter_noi_dung_image_preview.innerHTML = '';
    }

    // Hàm hiển thị ảnh preview
    function displayImagePreview(files) {
        // Xóa nếu có ảnh preview cũ
        clearImagePreview();

        // Hiển thị modal quá trình tải lên
        $('#uploadProgressModal').modal('show');

        // Số lượng file được tải lên
        var totalFiles = files.length;
        let filesUploaded = 0;

        // Duyệt qua từng file và hiển thị ảnh preview
        files.forEach(function(file, index) {
            // Kiểm tra loại MIME của tệp tin
            if (file.type.startsWith('image/')) {
                // Tạo một container cho mỗi ảnh và nút xóa
                var imageContainer = document.createElement('div');
                imageContainer.className = 'image-item';

                // Tạo ảnh
                var img = document.createElement('img');

                // Sử dụng FileReader để đọc file và hiển thị
                var reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);

                img.alt = 'chapter_noi_dung_image_preview';
                img.style.width = '200px';
                img.style.height = '300px';


                // Tạo một card Bootstrap cho mỗi ảnh và nút xóa
                var cardContainer = document.createElement('div');
                cardContainer.className = 'card mb-3';

                // Tạo một card-body để chứa ảnh và tên file
                var cardBody = document.createElement('div');
                cardBody.className = 'card-body';

                // Tạo ảnh
                var img = document.createElement('img');
                img.className = 'card-img-top';
                img.alt = 'chapter_noi_dung_image_preview';
                img.src = URL.createObjectURL(file);
                img.style.width = '100%';

                // Tạo tên file
                var fileName = document.createElement('p');
                fileName.className = 'card-text';
                fileName.innerText = file.name;

                // Tạo nút xóa ảnh
                var deleteButton = document.createElement('button');
                deleteButton.className = 'btn btn-danger';
                deleteButton.innerText = 'Xóa ảnh';
                deleteButton.addEventListener('click', function() {
                    // Xóa card khi nút xóa được nhấp
                    cardContainer.remove();
                    // Cập nhật giá trị của input file với danh sách các file còn lại
                    updateFileInputValue(index);
                });

                // Thêm ảnh và tên file vào card-body
                cardBody.appendChild(img);
                cardBody.appendChild(fileName);

                // Thêm card-body và nút xóa vào card container
                cardContainer.appendChild(cardBody);
                cardContainer.appendChild(deleteButton);

                // Hiển thị card trong #chapter_noi_dung_image_preview
                chapter_noi_dung_image_preview.appendChild(cardContainer);



                // Tăng số lượng file đã tải lên
                filesUploaded++;

                // Cập nhật tiến trình trên modal
                var progress = (filesUploaded / totalFiles) * 100;
                $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);

                // Nếu tất cả file đã được tải lên, ẩn modal
                if (filesUploaded === totalFiles) {
                    $('#uploadProgressModal').modal('hide');
                }
            } else {
                // Nếu không phải là ảnh, thông báo lỗi
                alert('Vui lòng chọn một tệp tin hình ảnh.');
                // Đặt giá trị của input file về rỗng để xóa tệp đã chọn
                chapter_noi_dung_image.value = '';
            }
        });
    }

    // Hàm cập nhật giá trị của input file với danh sách các file còn lại
    function updateFileInputValue(index) {
        // Xóa file đã chọn khỏi mảng
        selectedFiles.splice(index, 1);

        // Tạo một đối tượng DataTransfer để cập nhật giá trị của input file
        var dataTransfer = new DataTransfer();

        // Thêm các file còn lại vào đối tượng DataTransfer
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        // Gán đối tượng DataTransfer cho input file
        chapter_noi_dung_image.files = dataTransfer.files;

        // Gửi sự kiện change để kích hoạt lại sự kiện change
        chapter_noi_dung_image.dispatchEvent(new Event('change'));
    }

    // Khi giá trị của input 'chapter_noi_dung_image' thay đổi
    chapter_noi_dung_image.addEventListener('change', function(evt) {
        // Lấy ra mảng các file được chọn trong input
        var files = Array.from(chapter_noi_dung_image.files);

        // Lưu trữ các file vào biến selectedFiles
        selectedFiles = files;

        // Hiển thị ảnh preview cho tất cả các file được chọn
        displayImagePreview(files);
    });
</script>