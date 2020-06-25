<?php

require_once( 'model/media.php' );
require_once( 'model/history.php' );
require_once('model/tools.php');

/***************************
* ---- LOAD MEDIA PAGE -----
***************************/

function mediaPage() {

    if (isset($_GET['media'])) {
        $media = Media::mediaById($_GET['media']);
        $mediaType = Media::mediaTypeById($media["genre_id"]);
        require('view/mediaDetailView.php');
    }
    else {
        $search = isset($_GET['title']) ? $_GET['title'] : null;
//        $dateSelected = isset($_GET['date']) ? $_GET['date'] : null;
//        $genreSelected = isset($_GET['genre']) ? $_GET['genre'] : null;
//        $typeSelected = isset($_GET['type']) ? $_GET['type'] : null;

        $medias = Media::filterMedias($search);
        $genres = Media::getGenre();
        $types = Media::getTypeQuery();
        require('view/mediaListView.php');
    }
}

