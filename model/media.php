<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $type ) {
    $this->type = $type;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->type;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  /***************************
  * -------- GET LIST --------
  ***************************/

  public static function filterMedias( $title ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE title LIKE ".'"%' . $title . '%"' . " ORDER BY release_date DESC" );
    $req->execute();

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }

    public static function filterMediasWithJoinAndOrder( $title, $filter, $order ) {

        // Open database connection
        $db   = init_db();
        $req  = $db->prepare( 'SELECT media.id , genre_id , title , type, release_date, trailer_url, genre.name FROM media 
                                        LEFT JOIN genre 
                                        ON genre.id = media.genre_id
                                        WHERE title LIKE'. '%' . $title . '%' .
                                        'ORDER BY' . $filter . ' ' . $order );
        $req->execute();
        // Close databse connection
        $db   = null;

        return $req->fetchAll();

    }


//SELECT media.id , genre_id , type, release_date, trailer_url, genre.name FROM media LEFT JOIN genre ON genre.id = media.genre_id ORDER BY genre.name DESC
    /***************************
     * -------- GET FILM --------
     ***************************/

    public static function mediaById( $id ) {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM media WHERE id = " . $id);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    /***************************
     * ---- GET TYPE FILM ------
     ***************************/
    public static function mediaTypeById($id)
    {
        // Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM genre WHERE id = " . $id);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    /***************************
     * -------- GET SERIE --------
     ***************************/

    public static function serieBySeason($season) {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM series WHERE saison = " . $season);
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    /***************************
     * -------- GET SAISON --------
     ***************************/

    public static function saisonById( $id ) {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM series WHERE serie_id = " . $id . " GROUP BY saison");
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    /***************************
     * ------ GET EPISODE ------
     ***************************/

    public static function getEpisode($saison, $episode ) {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM series WHERE saison = " . $saison . " AND episode=" . $episode );
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    /***************************
     * ------ GET Movie ------
     ***************************/

    public static function getMovie( $movie ) {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM movies WHERE  movie_id = " . $movie );
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    public static function getEpisodeById( $id ) {
// Open database connection
        $db = init_db();
        $req = $db->prepare("SELECT * FROM series WHERE id = " . $id );
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetch();
    }

    public static function getGenre() {
        $db = init_db();
        $req = $db->prepare("SELECT * FROM genre GROUP BY name");
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }

    public static function getTypeQuery() {
        $db = init_db();
        $req = $db->prepare("SELECT * FROM media GROUP BY type");
        $req->execute();

        // Close database connection
        $db = null;

        return $req->fetchAll();
    }
}


