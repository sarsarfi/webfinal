<?php $content = ob_start(); ?>
<h1>لیست دانشجویان</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>نام</th>
            <th>ایمیل</th>
            <th>تعداد پست‌ها</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?= htmlspecialchars($student->name) ?></td>
            <td><?= htmlspecialchars($student->email) ?></td>
            <td><?= $student->posts()->count() ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $content = ob_get_clean(); ?>
<?php require 'layout.php'; ?>