<?php
$type = $media["type"];
$name = $mediaType["name"];
$release_date = $media["release_date"];
$summary = $media["summary"];
$id = $media["id"];
if ($media["type"] === "Serie") {
    $getSeason = $_GET['saison'];
    $getEpisode = $_GET['episode'];
    $mediaSeasons = Media::saisonById($_GET['media']);
    $series = Media::serieBySeason($_GET['saison']);
    $episode = Media::getEpisodeUrl($_GET['saison'], $_GET['episode']);
    $histories->setSerieId($episode['id']);
    $histories->setMovieId($episode['serie_id']);
    $time = $episode["duration"];
} else {
    $movie = Media::getmovie($_GET['media']);
    $histories->setMovieId($movie['movie_id']);
    $time = $movie["duration"];
}
$histories->insertHistory()
?>


<?php ob_start(); ?>
    <div class="card mb-3 text-white bg-dark mb-3">
        <div class="card-body">
            <h1 class="display-1"><?= $media['title'] ?></h1>
            <span class="badge badge-pill badge-secondary">Genre : <?= $name ?></span>
            <span class="badge badge-pill badge-secondary">Durée : <?= $time ?> </span>
            <span class="badge badge-pill badge-secondary">Date de sortie : <?= $release_date ?></span>
            <hr style="border-top: 1px solid rgb(255, 255, 255);">
            <div class="col">
                <span class="font-weight-bold">Résumé : </span><span class="font-italic"><?= $summary ?></span>
            </div>
            <br/>
            <div class="input-group mb-3"><?php if ($type === "Serie"): ?>
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Saison</label>
                    </div>
                    <Select class="custom-select" id="inputGroupSelect01" name='saison'
                            onchange='locationChange(this.value, <?= $id ?>, <?= $getEpisode ?>)'>
                        <?php foreach ($mediaSeasons as $season => $value): ?>
                            <?php if ($value["saison"] === $getSeason): ?>
                                <option value='<?= $value["saison"] ?>' selected><?= $value["saison"] ?></option>
                            <?php else: ?>
                                <option value='<?= $value["saison"] ?>'><?= $value["saison"] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </Select>
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Episode</label>
                    </div>
                    <Select class="custom-select" id="inputGroupSelect01" name='episode'
                            onchange='locationChange(<?= $getSeason ?>, <?= $id ?>, this.value)'>
                        <?php foreach ($series as $serie => $value): ?>
                            <?php if ($value["episode"] === $getEpisode): ?>
                                <option value='<?= $value["episode"] ?>' selected><?= $value["name"] ?></option>
                            <?php else: ?>
                                <option value='<?= $value["episode"] ?>'><?= $value["name"] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </Select>
                <?php endif; ?>
            </div>
            <div class="embed-responsive embed-responsive-16by9"><?php if ($type === "Serie"): ?>
                    <iframe class="embed-responsive-item"
                            id="player"
                            type="text/html"
                            src=<?= $episode['url_serie'] . "?enablejsapi=1" ?>
                            frameborder='0'
                            allow='encrypted-media;'
                            allowfullscreen></iframe>
                <?php else: ?>
                    <iframe class="embed-responsive-item"
                            id="player"
                            type="text/html"
                            src=<?= $movie['url_movie'] . "?enablejsapi=1" ?>
                            frameborder='0'
                            allow='encrypted-media;'
                            allowfullscreen></iframe>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        let player;
        let done = false;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        function onPlayerReady(event) {
            event.target.playVideo();

        }

        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.PLAYING && !done) {
                done = true;
                console.log(done);
            } else if (event.data == YT.PlayerState.PAUSED) {
                console.log("PAUSED")
            } else if (event.data == YT.PlayerState.ENDED) {
                console.log("ENDED")
            }
        }

        function stopVideo() {

        }
    </script>

    <script>
        function locationChange(season, id, episode) {
            window.location = "http://localhost:63343/ec-code-2020-codflix-php/index.php?media=" + id + "&saison=" + season + "&episode=" + episode
        }
    </script>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>