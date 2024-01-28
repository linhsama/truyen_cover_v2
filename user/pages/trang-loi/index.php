<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <link rel="stylesheet" href="../../assets/vendor/boxicons-2.1.4/css/boxicons.min.css">
    <style>
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            width: 100%;
        }

        .main-item-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        h3 {
            color: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bxs-error {
            color: #dc3545;
            font-size: 48px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <main class="main">

        <div class="main-container">
            <div class="main-title-container">
                <h3><i class='bx bxs-error'></i> Lỗi tải trang</h3>
            </div>
            <div class="main-item-container">
                <?php
                if (isset($_GET['error'])) {
                    echo "<p>Mã lỗi: <i>" . htmlspecialchars($_GET['error']) . "</i></p>";
                } else {
                    echo "<b>Trang không tồn tại!.</b>";
                }
                echo "<button class='btn btn-sm btn-danger' onclick='retryPage()'>Quay lại</button>";
                ?>
            </div>
        </div>

        <script>
            function retryPage() {
                history.back();
            }
        </script>

</body>

</html>