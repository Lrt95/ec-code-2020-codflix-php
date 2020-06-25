<?php
session_start();
require_once( '../model/history.php' );

function addElementHistory()
{
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    if ($user_id) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

        if ($user_id == '') {
            return 'Erreur serveur';
        }
        $movie_id = $_POST['movie_id'];
        $serie_id = $_POST['serie_id'];
        $start_date = $_POST['start_date'];
        $finish_date = $_POST['finish_date'];

        $history = History::getInstance($user_id, $movie_id, $serie_id, $start_date , $finish_date, "NULL");
        $history->insertHistory();
    }

}

echo addElementHistory();
