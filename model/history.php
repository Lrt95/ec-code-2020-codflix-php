<?php

require_once('database.php');

class History
{

    private $id;
    private $user_id;
    private $movie_id;
    private $serie_id;
    private $start_date;
    private $finish_date;
    private $watch_duration;

    private static $_instance = null;

    /**
     * History constructor.
     * @param $user_id
     * @param $movie_id
     * @param $serie_id
     * @param $start_date
     * @param $finish_date
     * @param $watch_duration
     */
    public function __construct($user_id, $movie_id, $serie_id, $start_date, $finish_date, $watch_duration)
    {
        $this->user_id = $user_id;
        $this->movie_id = $movie_id;
        $this->serie_id = $serie_id;
        $this->start_date = $start_date === "false" ? "NULL" : $start_date;
        $this->finish_date = $finish_date === "false" ? "NULL" : $finish_date;
        $this->watch_duration = $watch_duration;
    }

    public static function getInstance($user_id, $movie_id, $serie_id, $start_date, $finish_date, $watch_duration) {

        if(is_null(self::$_instance)) {
            self::$_instance = new History($user_id, $movie_id, $serie_id, $start_date, $finish_date, $watch_duration);
        }

        return self::$_instance;
    }





    /***************************
     * -------- GETTERS ---------
     ***************************/

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getMovieId()
    {
        return $this->movie_id;
    }

    /**
     * @return mixed
     */
    public function getSerieId()
    {
        return $this->serie_id;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        if ($this->start_date === "NULL") {
            return $this->start_date;
        } else {
            return '"' .  $this->start_date . '"';
        }
    }

    /**
     * @return mixed
     */
    public function getFinishDate()
    {
        if ($this->finish_date === "NULL") {
            return $this->finish_date;
        } else {
            return '"' .  $this->finish_date . '"';
        }
    }

    /**
     * @return mixed
     */
    public function getWatchDuration()
    {
        return $this->watch_duration;
    }


    /**************************************
     * ------------ GET HISTORY -----------
     ***************************************/

    public static function getHistoryByUserId($user_id)
    {

        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM history WHERE user_id  = '" . $user_id . "'" . "ORDER BY `start_date` DESC"  );
        $req->execute();
        // Close databse connection
        $db = null;

        return $req->fetchAll();
    }

    /**************************************
     * ------------ SET HISTORY -----------
     ***************************************/

    public static function setHistoryByUserId($user_id)
    {

        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM history WHERE user_id  = '" . $user_id . "'");
        $req->execute();
        // Close databse connection
        $db = null;

        return $req->fetchAll();
    }

    /***********************************
     * ------ INSERT NEW HISTORY -------
     ************************************/

    public function insertHistory()
    {
        // Open database connection
        $db = init_db();
        $req = $db->prepare("INSERT INTO history ( user_id, movie_id, serie_id, start_date, 
                            finish_date, watch_duration ) 
                            VALUES (" . $this->getUserId() . ", " .
                            $this->getMovieId() . ", " . $this->getSerieId() . ", "
                            .$this->getStartDate()  .", " . $this->getFinishDate() .  ", "
                            . $this->getWatchDuration() . ")");
        $req->execute();
        // Close databse connection
        $db = null;

    }


    public static function deleteOneElementHistory($id) {
            // Open database connection
        $db = init_db();
        $req = $db->prepare('DELETE FROM history WHERE id = ' . $id);
        $req->execute();
        // Close databse connection
        $db = null;

    }

    public static function deleteAllElementHistory() {
        // Open database connection
        $db = init_db();
        $req = $db->prepare('DELETE FROM history');
        $req->execute();
        // Close databse connection
        $db = null;

    }
}


