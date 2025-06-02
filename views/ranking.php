<?php $content = ob_start(); ?>
<h1>رتبه‌بندی پست‌ها بر اساس اهمیت</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>رتبه</th>
            <th>عنوان پست</th>
            <th>نویسنده</th>
            <th>امتیاز اهمیت</th>
            <th>تعداد بازدید</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ranking as $index => $item): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($item['post']->title) ?></td>
            <td><?= htmlspecialchars($item['post']->user->name) ?></td>
            <td><?= number_format($item['score'], 4) ?></td>
            <td><?= $item['post']->views->view_count ?? 0 ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); ?>
<?php require 'layout.php'; ?>