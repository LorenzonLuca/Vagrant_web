<?php

class Helper
{
    public static function sanitize($s){
        $s = trim($s);
        $s = stripslashes($s);
        $s = htmlspecialchars($s);
        return $s;
    }
}