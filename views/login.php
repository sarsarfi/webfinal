<?php $content = ob_start(); ?>
<div class="container mt-5">
    <h2>ورود به سیستم</h2>
    <form method="POST" action="/webfinal/login">
        <div class="mb-3">
            <label>ایمیل:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>رمز عبور:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-success">ورود</button>
    </form>
</div>
<?php $content = ob_get_clean(); include 'layout.php'; ?>
