<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>پروژه وب</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- منوی بالا -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/webfinal/">پروژه وب</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/webfinal/posts">پست‌ها</a>
                <a class="nav-link" href="/webfinal/matrix">ماتریس</a>
                <a class="nav-link" href="/webfinal/ranking">رتبه‌بندی</a>
                <a class="nav-link" href="/webfinal/login">ورود</a>
                <a class="nav-link" href="/webfinal/register">ثبت‌نام</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?= $content ?? '' ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
