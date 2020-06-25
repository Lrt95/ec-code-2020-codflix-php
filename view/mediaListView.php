
<?php $tools = new Tools();
$genreTab = [];
$typeTab = [];
foreach ($genres as $genre => $value) {
    array_push($genreTab , $value["name"]);
}
foreach ($types as $type => $value) {
    array_push($typeTab , $value["type"]);
}

?>
<?php ob_start(); ?>

<div class="container">
        <form method="get">
            <div class="row">
            <div class="col">
                <?php $tools->createSelect("type", $typeTab, "Type");?>
            </div>
            <div class="col">
                <?php $tools->createSelect("genre", $genreTab , "Genre");?>
            </div>
            <div class="col">
                <?php $tools->createInput("date",
                    "date" ,
                    "date",
                    $search,
                    "form-control",
                    "" );?>
            </div>
            <div class="col">
                <div class="form-group has-btn">
                    <?php $tools->createInput("search",
                        "search" ,
                        "title",
                        $search,
                        "form-control",
                        "Rechercher un film ou une série" );?>
                </div>
            </div>
            <div class="col">
                <?php $tools->createButton("submit", "btn btn-block bg-red text-white", "Valider");?>
            </div>
            </div>
        </form>
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
            <div class="title">Sortie le : <?= $media['release_date']; ?></div>
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
