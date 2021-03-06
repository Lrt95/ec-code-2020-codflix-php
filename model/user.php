<?php

require_once('database.php');

class User
{

    protected $id;
    protected $email;
    protected $password;
    protected $isActive;


    public function __construct($user = null)
    {

        if ($user != null):
            $this->setId(isset($user->id) ? $user->id : null);
            $this->setEmail($user->email);
            $this->setPassword($user->password, isset($user->password_confirm) ? $user->password_confirm : false);
            $this->setIsActive(isset($user->isActive) ? $user->isActive : null);
        endif;
    }

    /***************************
     * -------- SETTERS ---------
     ***************************/

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
            throw new Exception('Email incorrect');
        endif;

        $this->email = $email;

    }

    public function setPassword($password, $password_confirm = false)
    {

        if ($password_confirm && $password != $password_confirm) {
            throw new Exception('Vos mots de passes sont différents');
        } else if ((strlen($password) === 0 || strlen($password_confirm) === 0) && $password_confirm) {
            throw new Exception('Vos mots de passes sont vides');
        } else if (strpos($password, " ") !== false ) {
            throw new Exception('Il y a un espace dans votre mot de passe');
        }

        //je ne met pas de Regex à code du mot de passe 123456 de l'énnoncé (coding@gmail.com)
        $this->password = hash('sha256' ,$password);
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive): void
    {
        $this->isActive = $isActive;
    }

    /***************************
     * -------- GETTERS ---------
     ***************************/

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /***********************************
     * -------- CREATE NEW USER ---------
     ************************************/

    public function createUser()
    {

        // Open database connection
        $db = init_db();

        // Check if email already exist
        $req = $db->prepare("SELECT * FROM user WHERE email = '" . $this->email . "'");
        $req->execute();

        if ($req->rowCount() > 0) throw new Exception("Email ou mot de passe incorrect");

        // Insert new user
        $req->closeCursor();

        $req = $db->prepare("INSERT INTO user ( email, password ) VALUES ( :email, :password )");
        $req->execute(array(
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ));

        // Close databse connection
        $db = null;

        $this->sendActivationMail();

    }

    /**************************************
     * -------- GET USER DATA BY ID --------
     ***************************************/

    public static function getUserById($id)
    {

        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM user WHERE id  = '" . $id . "'");
        $req->execute(array($id));

        // Close databse connection
        $db = null;

        return $req->fetch();
    }

    /***************************************
     * ------- GET USER DATA BY EMAIL -------
     ****************************************/

    public function getUserByEmail()
    {

        // Open database connection
        $db = init_db();

        $req = $db->prepare("SELECT * FROM user WHERE email = '" . $this->email . "'");
        $req->execute();

        // Close databse connection
        $db = null;

        return $req->fetch();
    }

    private function sendActivationMail()
    {


        $destinataire = $this->email;
        $sujet = "Activer votre compte";
        $entete = "From: inscription@codflix.com";


        $message = 'Bienvenue sur CodFlix,
        Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
        ou copier/coller dans votre navigateur Internet. 
        http://codflix.com/activation.php?log='.urlencode($destinataire). '
        
        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre.';

        mail($destinataire, $sujet, $message, $entete);
    }
}
