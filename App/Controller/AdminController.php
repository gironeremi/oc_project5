<?php
namespace App\Controller;
class AdminController extends Controller
{
    public function adminDashboard()
    {
        if ($_SESSION['role'] === 'motherBrain') {
            require('View/adminDashboardView.php');
        } else {
            throw new \Exception('Accès non autorisé!');
        }
    }
}