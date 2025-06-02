<?php $content = ob_start(); ?>
<div class="container">
    <h1 class="my-4">لیست پست‌ها</h1>
    
    <!-- فرم ایجاد پست جدید -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>ارسال پست جدید</h5>
        </div>
        <div class="card-body">
            <form action="/posts/store" method="POST">
                <div class="mb-3">
                    <textarea class="form-control" name="content" rows="3" placeholder="محتوای پست" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">ارسال پست</button>
            </form>
        </div>
    </div>

    <!-- جدول نمایش پست‌ها -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>محتوا</th>
                    <th>نویسنده</th>
                    <th>تعداد بازدید</th>
                    <th>پست‌های مرتبط</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?= $post->id ?></td>
                    <td><?= htmlspecialchars($post->content) ?></td>
                    <td>
                        <?= htmlspecialchars($post->user_name) ?>
                        <?php if($post->user_id == $_SESSION['user_id']): ?>
                            <span class="badge bg-info">شما</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $post->view_count ?></td>
                    <td>
    <?php 
    if (!empty($post->related_posts)) {
        foreach ($post->related_posts as $related) {
            echo '<span class="badge bg-secondary">پست ' . htmlspecialchars($related->id) . '</span> ';
        }
    } else {
        echo '<span class="text-muted">بدون ارتباط</span>';
    }
    ?>
</td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'layout.php'; ?>