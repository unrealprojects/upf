<?php
namespace UpfHelpers;

class String{
    /*** Transform nth letter To Uppercase
            * As default First Letter
     ***/
    public static function LetterToUppercase($String,$LetterNumber=0){
        $String[$LetterNumber]=strtoupper($String[$LetterNumber]);
        return $String;
    }
}