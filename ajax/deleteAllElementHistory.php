<?php
session_start();
require_once( '../model/history.php' );

function deleteAllElementHistory()
{

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    echo '<div>' . $user_id . '</div>';
    if ($user_id) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

        if ($user_id == '') {
            return 'Erreur serveur';
        }
        $id = $_POST['target'];
        $historyMedia = History::deleteAllElementHistory();
    }
}

echo deleteAllElementHistory();
