<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="../../assets/vendor/boxicons-2.1.4/css/boxicons.min.css">
    <style>
    body {
        background-color: #f8f9fa;
        color: #495057;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    #main-container {
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    h3 {
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    p {
        margin: 10px 0;
    }

    .bxs-error {
        color: #dc3545;
        font-size: 48px;
        margin-right: 10px;
    }

    .retry-button {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .retry-button:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div id="main-container">
        <div class="row section-container">
            <div class="col-12">
                <div class="main-data">
                    <h3><i class='bx bxs-error'></i> Lỗi tải trang</h3>
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<p>Mã lỗi: <i>" . htmlspecialchars($_GET['error']) . "</i></p>";
                    } else {
                        echo "<p>Không có thông tin lỗi chi tiết.</p>";
                    }
                    echo "<button class='retry-button' onclick='retryPage()'>Thử lại</button>";
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    function retryPage() {
        history.back();
    }
    </script>

</body>

</html>