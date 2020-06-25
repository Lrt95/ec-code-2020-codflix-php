<?php ob_start(); ?>

<a type="button"
   class="btn btn-danger"
   onclick="onDeleteAllElement()">
    <img class="img-fluid"
         alt="Responsive image"
         src="asset/image/baseline_clear_white_18dp.png"
    ></a>
<span>Supprimer tout</span>
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
            <td><a type="button"
                   class="btn btn-danger"
                   onclick="onDeleteOneElement(<?= $hystory["id"]?>)">
                    <img class="img-fluid"
                         alt="Responsive image"
                         src="asset/image/baseline_clear_white_18dp.png"
                    ></a>      <?= $media['title']; ?></td>
            <td><?= $episode['episode'] ?></td>
            <td><?= $episode['saison'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<script>
    function onDeleteAllElement() {
        $.ajax({
            type: "POST",
            url: "./ajax/deleteAllElementHistory.php",
            cache: false,
            success: function (response) {
                console.log(response);
                window.location.reload();
            }
        });
    }

    function onDeleteOneElement(target) {
        $.ajax({
            type: "POST",
            url: "./ajax/deleteOneElementHistory.php",
            cache: false,
            data: {'target': target},
            success: function (response) {
                console.log(response);
                window.location.reload();
            }
        });
    }
</script>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
