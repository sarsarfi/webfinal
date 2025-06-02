<?php $content = ob_start(); ?>
<h1>ماتریس ارتباط پست‌ها</h1>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <?php for ($i = 0; $i < count($matrix); $i++): ?>
                <th>پست <?= $i+1 ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($matrix); $i++): ?>
            <tr>
                <th>پست <?= $i+1 ?></th>
                <?php for ($j = 0; $j < count($matrix[$i]); $j++): ?>
                <td><?= number_format($matrix[$i][$j], 2) ?></td>
                <?php endfor; ?>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'layout.php'; ?>