<?php
namespace App\Controller;
class ErrorsController extends Controller
{
    public function error(\Exception $exception)
    {
        require('View/errorsView.php');
    }
}