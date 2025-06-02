<?php
namespace App\Controller;


use App\Model\Post;

class PostController
{
    public function create()
    {
        // چک کن کاربر وارد شده باشه (احراز هویت)
        if (!isset($_SESSION['user_id'])) {
            redirect('/webfinal/login');
        }
        
        view('create_post.php');
    }

    public function store()
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/webfinal/login');
        }

        $content = $_POST['content'] ?? '';

        if (empty(trim($content))) {
            // می‌تونی خطا نشون بدی یا به فرم برگردونی
            redirect('/webfinal/posts/create');
        }

        // ذخیره در دیتابیس
        Post::create([
            'content' => $content,
            'user_id' => $_SESSION['user_id'],
        ]);

        redirect('/webfinal/posts');
    }
}
?>
