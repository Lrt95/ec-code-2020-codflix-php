<?php ob_start(); ?>

<div class="row">
    <div class="col-md-4 offset-md-8">
        <form method="get">
            <div class="form-group has-btn">
                <input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
                       placeholder="Rechercher un film ou une série">

                <button type="submit" class="btn btn-block bg-red">Valider</button>
            </div>
        </form>
    </div>
</div>

<div class="media-list">
    <?php foreach ($medias as $media): ?>
        <a class="item" href="index.php?media=<?= $media['id']; ?>
                                              <?= $media['type'] === 'Serie' ? ' &saison=1 &episode=1' : null ?>">
            <div class="video">
                <div>
                    <iframe src=<?= $media['trailer_url']; ?>
                            frameborder="0"
                            allow="encrypted-media;"
                            allowfullscreen></iframe>
                </div>
            </div>
            <div class="title"><?= $media['title']; ?></div>
            <div>
                <div class="summary">Date de sortie : <?= $media['release_date']; ?></div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<script>
    function locationChange(season, id, episode) {
        window.location = "/ec-code-2020-codflix-php/index.php?media="+id+"&saison="+season+"&episode=" + episode
    }
</script>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
