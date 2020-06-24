<?php

require_once( 'database.php' );

class History {

  protected $id;
  protected $user_id;
  protected $movie_id;
  protected $serie_id;
  protected $start_date;
  protected $finish_date;
  protected $watch_duration;

    /**
     * History constructor.
     * @param null $history
     */
    public function __construct($history = null)
    {
        if($history === null) {
            $this->setUserId($history->user_id);
            $this->setMovieId($history->movie_id);
            $this->setSerieId($history->serie_id) ;
            $this->setStartDate($history->start_date);
            $this->setFinishDate($history->finish_date);
            $this->setWatchDuration($history->watch_duration);
        }
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
     * @param mixed $start_date
     */
    public function setStartDate($start_date): void
    {
        $this->start_date = $start_date;
    }



    /**
     * @param mixed $finish_date
     */
    public function setFinishDate($finish_date): void
    {
        $this->finish_date = $finish_date;
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
}


