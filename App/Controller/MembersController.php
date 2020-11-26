<?php
namespace App\Controller;
use App\Model\MembersManager;

class MembersController extends Controller
{
    public function register()
    {
        if(isset($_POST['memberName']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])) {
            $errors = array();
            $membersManager = new MembersManager();
            $memberName = $this->cleanVar($_POST['memberName']);
            $email = $this->cleanVar($_POST['email']);
            $password = $this->cleanVar($_POST['password']);
            $passwordConfirm = $this->cleanVar($_POST['passwordConfirm']);
            if(empty($memberName) || !preg_match('/^[a-zA-Z0-9_]+$/', $memberName)) {
                $errors['memberName'] = "Ce pseudonyme n'est pas valide (alphanumérique)";
            }
            $memberExists = $membersManager->getMemberByName($memberName);
            if ($memberExists) {
                $errors['memberName'] = 'Ce pseudonyme est dejà pris';
            }
            if (empty($email) || !filter_var(($email),FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Cet e-mail n'est pas valide";
            }
            $emailExists = $membersManager->getMemberByEmail($email);
            if ($emailExists) {
                $errors['email'] = "Cette adresse email est dejà utilisée";
            }
            if (empty($password) || empty($passwordConfirm)) {
                $errors['password'] = "Un mot de passe est manquant";
            }
            if ($password != $passwordConfirm) {
                $errors['passwordMatch'] = "Les mots de passe ne sont pas identiques";
            }
            if (empty($errors)) {
                $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                $membersManager->addMember($memberName, $passwordHashed, $email);
                $successMessage = 'Vous êtes à présent inscrit. Bienvenue dans la meute!';
                require('View/template.php');
                die();
            }
        }
        require('View/registerView.php');
    }
    public function login()
    {
        if (isset($_POST['memberName']) && isset($_POST['password'])) {
            $membersManager = new MembersManager();
            $memberName = $this->cleanVar($_POST['memberName']);
            $password = $this->cleanVar($_POST['password']);
            $memberExists = $membersManager->getMemberByName($memberName);
            if (!$memberExists) {
                $errors['memberName'] = "Ce pseudonyme n'existe pas.";
                //sinon -> pseudo trouvé dans la base, on continue
            } elseif (!password_verify($password, $memberExists['password'])) {
                $errors['password'] = "Mot de passe incorrect!";
            }
            if (empty($errors)) {
                $_SESSION['memberName'] = $memberName;
                $_SESSION['memberId'] = $memberExists['member_id'];
                $_SESSION['isAdmin'] = $memberExists['is_admin'];
                if ($_SESSION['isAdmin'] == 1) {
                    $adminController = new AdminController();
                    $adminController->admin();
                    die();
                } else {
                    $successMessage = 'Vous êtes connecté. Bienvenue '. $memberName . " !";
                    require ('View/template.php');
                    die();
                }
            }
        }
        require('View/loginView.php');
    }
    public function logout()
    {
        session_destroy();
        unset($_SESSION['memberName']);
        $successMessage = "Vous êtes bien déconnecté.";
        require('View/template.php');
    }
}