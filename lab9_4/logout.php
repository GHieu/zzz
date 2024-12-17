<?php
session_start();
session_unset(); // Xóa toàn bộ session
session_destroy(); // Hủy session

header("Location: index.php"); // Chuyển về trang đăng nhập
exit;
?>