<?php

function view($viewPath, $data = []) {
    extract($data);
    ob_start();
    require __DIR__ . '/../views/' . $viewPath;
    $content = ob_get_clean(); // محتوای صفحه فرعی (مثلاً register.php)
    
    // اطمینان از در دسترس بودن $content در layout
    include __DIR__ . '/../views/layout.php';
}

function redirect($path) {
    header("Location: $path");
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

