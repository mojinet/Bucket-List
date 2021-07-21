<?php


namespace App\Service;


class Censurator{

    /*
     * Return a text without bad word :o
     */
    public function purify(string $text) : string{
        return str_replace(["connard","con", "salope", "pute", "pedale","trou du cul", "enculer"],"*",$text);
    }
}