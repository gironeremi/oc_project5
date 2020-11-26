<?php
namespace App\Model;
class MembersManager extends Manager
{
    public function getMemberByName($memberName)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM members WHERE member_name = ?');
        $req->execute(array($memberName));
        return $req->fetch();
    }
    public function getMemberByEmail($email)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('SELECT * FROM members WHERE email = ?');
        $req->execute(array($email));
        return $req->fetch();
    }
    public function addMember($memberName, $passwordHashed, $email)
    {
        $db = $this->getDbConnect();
        $req = $db->prepare('INSERT INTO members SET member_name = ?, password = ?, email = ?');
        $req->execute(array($memberName, $passwordHashed, $email));
        //return $req->fetch();
    }
}