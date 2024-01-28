<?php
class Database
{
    public $connect;

    public function __construct()
    {
        $init = parse_ini_file("config.ini");
        $servername = $init["servername"];
        $dbname = $init["dbname"];
        $username = $init["username"];
        $password = $init["pass"];

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        );
        try {
            $this->connect = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password, $opt);

            $this->connect->query("SET NAMES 'utf8mb4'");
            $this->connect->query("SET CHARACTER SET utf8mb4");
            $this->connect->query("SET SESSION collation_connection = 'utf8mb4_unicode_ci'");
        } catch (PDOException $e) {
            header("location: index.php?pages=trang-loi&error=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
?>
