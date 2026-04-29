<?php
session_start();
unset($_SESSION['admin_editor_active']);
session_destroy();
header('Location: /admin/login.php');
exit;
