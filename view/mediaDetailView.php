<?php
$type = $media["type"];
$name = $mediaType["name"];
$release_date = $media["release_date"];
$summary = $media["summary"];
$id = $media["id"];
$movie = Media::getmovie($_GET['media']);
if ($media["type"] === "Serie") {
    $getSeason = $_GET['saison'];
    $getEpisode = $_GET['episode'];
    $mediaSeasons = Media::saisonById($_GET['media']);
    $series = Media::serieBySeason($_GET['saison']);
    $episode = Media::getEpisodeUrl($_GET['saison'],$_GET['episode']);
}
?>


<?php ob_start(); ?>


<div class="col">
    <div><?= $media['title'] ?></div>
    <div><?php if($type === "Serie") {

            echo "<Select name='saison' onchange='locationChange(this.value, $id, $getEpisode)'>";
            foreach ($mediaSeasons as $season => $value) {
                if ($value["saison"] === $getSeason) {
                    echo "<option value='" . $value["saison"] . "' selected>". $value["saison"] ."</option> ";
                } else {
                    echo "<option value='" . $value["saison"] . "'>". $value["saison"] ."</option> ";
                }
            }
            echo "</Select>";

            echo "<Select name='episode' onchange='locationChange($getSeason, $id, this.value)'>";
            foreach ($series as $serie => $value) {
                if ($value["episode"] === $getEpisode) {
                    echo "<option value='" . $value["episode"] . "' selected>". $value["name"] ."</option> ";
                } else {
                    echo "<option value='" . $value["episode"] . "'>". $value["name"] ."</option> ";
                }
            }
            echo "</Select>";
    } ?></div>
    <div><?php if($type === "Serie"): ?>
             <iframe src=<?=$episode['url_serie'] . "?autoplay=true"?> frameborder='0' allow='encrypted-media;'allowfullscreen></iframe>
        <?php else: ?>
             <iframe src=<?=$movie['url_movie'] . "?autoplay=true"?> frameborder='0' allow='encrypted-media;'allowfullscreen></iframe>
        <?php endif; ?>
    </div>

    <div><?= $name ?></div>
    <div><?= $release_date ?></div>
    <div><?= $summary ?></div>
</div>

    <script>
        function locationChange(season, id, episode) {
            window.location = "http://localhost:63343/ec-code-2020-codflix-php/index.php?media="+id+"&saison="+season+"&episode=" + episode
        }
    </script>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>