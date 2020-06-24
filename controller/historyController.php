<?php

require_once( 'model/history.php' );

/***************************
* ---- LOAD HISTORY PAGE -----
***************************/

function historyPage() {

        $histories = History::getHistoryByUserId($_SESSION['user_id']);

        require('view/historyView.php');
}

