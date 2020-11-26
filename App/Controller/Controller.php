<?php
namespace App\Controller;
class Controller
{
    public function cleanVar($str)
    {
        if (isset($str)) {
            return trim(htmlspecialchars($str));
        } else {
            return "";
        }
    }
}