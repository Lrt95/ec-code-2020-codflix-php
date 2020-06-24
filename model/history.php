<?php

require_once('database.php');

class History
{

    protected $id;
    protected $user_id;
    protected $movie_id;
    protected $serie_id;
    protected $start_date;
    protected $finish_date;
    protected $watch_duration;

    /**
     * History constructor.
     * @param $user_id
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->movie_id = "NULL";
        $this->serie_id = "NULL";
        $this->start_date = "NULL";
        $this->finish_date = "NULL";
        $this->watch_duration = "NULL";
    }



    /***************************
     * -------- SETTERS ---------
     ***************************/


    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }


    /**
     * @param mixed $movie_id
     */
    public function setMovieId($movie_id): void
    {
        $this->movie_id = $movie_id;
    }


    /**
     * @param mixed $serie_id
     */
    public function setSerieId($serie_id): void
    {
        $this->serie_id = $serie_id;
    }


    /**
     * @throws Exception
     */
    public function setStartDate(): void
    {
        $date = new DateTime();
        $this->start_date = date_format($date, 'Y-m-d H:i:s');
    }


    /**
     * @throws Exception
     */
    public function setFinishDate(): void
    {
        $date = new DateTime();
        $this->finish_date = date_format($date, 'Y-m-d H:i:s');
    }


    /**
     * @param mixed $watch_duration
     */
    public function setWatchDuration($watch_duration): void
    {
        $this->watch_duration = $watch_duration;
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
        return $this->start_date;
    }

    /**
     * @return mixed
     */
    public function getFinishDate()
    {
        return $this->finish_date;
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

        $req = $db->prepare("SELECT * FROM history WHERE user_id  = '" . $user_id . "'");
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
}


