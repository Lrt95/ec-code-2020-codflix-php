<?php

require_once( 'model/media.php' );
require_once( 'model/history.php' );

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
        $medias = Media::filterMedias($search);
        require('view/mediaListView.php');
    }
}

