<?php ob_start(); ?>

<div>
    <?php foreach ($histories as $hystory): ?>
        <div><?= $hystory['movie_id'] ?></div>
        <div><?= $hystory['serie_id'] ?></div>
        <div><?= $hystory['start_date'] ?></div>
        <div><?= $hystory['finish_date'] ?></div>
        <div><?= $hystory['watch_duration'] ?></div>
    <?php endforeach; ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
