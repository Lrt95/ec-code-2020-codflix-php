<?php ob_start(); ?>


<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col"> Film / Série </th>
        <th scope="col"> Episode </th>
        <th scope="col"> Saison </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($histories as $hystory)
    { ?>
        <?php $media = Media::mediaById($hystory['movie_id']);
        $episode = Media::getEpisodeById($hystory['serie_id']);
        ?>
        <tr>
            <td><?= $media['title']; ?></td>
            <td><?= $episode['episode'] ?></td>
            <td><?= $episode['saison'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
