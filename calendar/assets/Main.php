<?php

/**
 * Created by PhpStorm.
 * User: Aron
 * Date: 17/10/2016
 * Time: 20:46
 */
class Main
{
    public function redirect($url)
    {
        header("Location: $url");
    }

}