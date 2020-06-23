<?php $type = $media["type"]?>
<?php $name = $mediaType["name"]?>
<?php $release_date = $media["release_date"]?>
<?php $summary = $media["summary"]?>
<?php $id = $media["id"]?>
<?php ob_start(); ?>


<div class="col">
    <div><?= $media['title'] ?></div>
    <iframe src=<?= $media['trailer_url']; ?>
            frameborder="0"
            allow="encrypted-media;"
            allowfullscreen></iframe>
    <div><?= $type ?></div>
    <div><?php if($type === "Serie") {
            echo "<form method='post'>";
            $saisons = Media::saisonById($id);
            echo "<Select name='saison'>";
            foreach ($saisons as $saison => $value) {
                echo "<option value='" . $value["saison"] . "'>". $value["saison"] ."</option> ";
            }
            echo "</Select>";
            echo "</form>";
            if(( isset($_POST["saison"]))) {
                echo "<div>" . $_POST["saison"] . "</div>";
            }
            $series = Media::serieBySeason($_POST["saison"]);
            echo "<Select>";
            foreach ($series as $serie => $value) {
                echo "<option>". $value["name"] . "</option> ";
            }
            echo "</Select>";
    } ?></div>
    <div><?= $name ?></div>
    <div><?= $release_date ?></div>
    <div><?= $summary ?></div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>