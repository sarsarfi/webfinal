<?php $content = ob_start(); ?>
<h1>ارسال پست جدید</h1>

<form action="/webfinal/posts/create" method="POST">
    <div class="mb-3">
        <label for="content" class="form-label">محتوای پست</label>
        <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">ارسال پست</button>
</form>

<?php $content = ob_get_clean(); ?>
<?php require 'layout.php'; ?>
