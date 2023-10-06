<?php
require_once('App.php');
class ModelCommentaire
{
    private $id_blog;
    private $commentaire;
    private $avatar;
    private $nom_intervenant;
    private $valide;
    public function __construct($id_blog = null, $commentaire = null, $avatar = null, $nom_intervenant = null, $valide = null)
    {
        if (!is_null($id_blog) && !is_null($commentaire) && !is_null($avatar) && !is_null($nom_intervenant)) {

            // Si aucun des paramètre n'est nul, c'est forcement qu'on les a fournis
            $this->id_blog = $id_blog;
            $this->commentaire = $commentaire;
            $this->avatar = $avatar;
            $this->nom_intervenant = $nom_intervenant;
            $this->valide = $valide;
        }
    }
    public function __get($attr)
    {
        if (!isset($this->attr))
            return "erreur";
        else
            return ($this->attr);
    }
    public function __set($attr, $value)
    {
        $this->attr = $value;
    }

    public static function getbyid($id)
    {
        $db = App::getDB();
        $sql = "SELECT * FROM commentaire where id=?";
        $params = array($id);
        $resultat = $db->execute_query($sql, $params);
        if (!$resultat) {
            echo "Lecture impossible";
        } else {
            return $resultat;
        }
    }
    public static function fetch($result)
    {
        $resultat = $result->fetch(PDO::FETCH_ASSOC);
        if (!$resultat) {
            echo "fetch impossible";
        } else {
            return $resultat;
        }
    }
    public static function getvalid($id)
    {
        $db = App::getDB();
        $sql = "SELECT * FROM commentaire where valide=1 AND id_blog=?";
        $params = array($id);
        $resultat = $db->execute_query($sql, $params);
        if (!$resultat) {
            echo "Lecture impossible";
        } else {
            return $resultat;
        }
    }
    public static function getAll()
    {
        $db = App::getDB();
        $sql = "SELECT * FROM commentaire";
        $resultat = $db->execute_query($sql);
        if (!$resultat) {
            echo "Lecture impossible, id";
        } else {
            return $resultat->fetchAll(PDO::FETCH_OBJ);
        }
    }
    public static function getAlls()
    {
        $db = App::getDB();
        $sql = "SELECT * FROM commentaire";
        $resultat = $db->execute_query($sql);
        if (!$resultat) {
            echo "Lecture impossible, id";
        } else {
            return $resultat;
        }
    }
    public function save($id = null)
    {
        $db = App::getDB();
        try {
            if ($id == null) { //insertion d’un nouveau produit
                $sql = "INSERT INTO commentaire(id_blog, commentaire, avatar, nom_intervenant, valide) VALUES (?,?,?,?,?)";
                $params = array(
                    $this->id_blog,
                    $this->commentaire,
                    $this->avatar,
                    $this->nom_intervenant,
                    $this->valide
                );
                $resultat = $db->execute_query($sql, $params);
            } else { //update d’un produit existant
                $sql = "UPDATE commentaire SET id_blog=:id_blog,
                    commentaire=:commentaire,
                    avatar=:avatar,
                    nom_intervenant=:nom_intervenant,
                    valide=:valide,
                    WHERE id=:id";
                $params = array(
                    'id_blog' => $this->id_blog,
                    'commentaire' => $this->commentaire,
                    'avatar' => $this->avatar,
                    'nom_intervenant' => $this->nom_intervenant,
                    'valide' => $this->valide,
                    'id' => $id
                );
                $resultat = $db->execute_query($sql, $params);
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 2300) {
                $message = $e->getMessage();
            }
            return false;
        }
        return true;

    }
    public static function delete($id)
    {
        $db = App::getDB();
        try {
            $sql = "DELETE FROM commentaire where id=? LIMIT 1";
            $params = array($id);
            $resultat = $db->execute_query($sql, $params);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    public static function updateValide($id)
    {
        $db = App::getDB();
        try {
            $sql = "UPDATE  commentaire SET valide=1 WHERE id=$id";
            $resultat = $db->execute_query($sql);
        } catch (PDOException $e) {
            echo "Lecture impossible, id";
        }
        return $resultat;
    }
}