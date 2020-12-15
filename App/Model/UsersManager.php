<?php
namespace App\Model;
class UsersManager extends Manager
{
    public function getUserByName($username)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM users INNER JOIN roles ON users.role_id = roles.roles_id WHERE username = ?');
        $req->execute(array($username));
        return $req->fetch();
    }
    public function getUserByEmail($email)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM users WHERE email = ?');
        $req->execute(array($email));
        return $req->fetch();
    }
    public function addUser($username, $passwordHashed, $email)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('INSERT INTO users SET username = ?, password = ?, email = ?');
        $req->execute(array($username, $passwordHashed, $email));
    }
    /*faire une méthode listUsers pour ajouter les utilisateurs à la liste des joueurs/ses ?.*/
}