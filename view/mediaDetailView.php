
<?php ob_start(); ?>

<div class="col">
    <div><?= $media['title']?></div>
    <iframe src=<?= $media['trailer_url']; ?>
            frameborder="0"
            allow="encrypted-media;"
            allowfullscreen></iframe>
    <div><?= $media['type']?></div>
    <div><?= $mediaType['name']?></div>
    <div><?= $media['release_date']?></div>
    <div><?= $media['summary']?></div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>