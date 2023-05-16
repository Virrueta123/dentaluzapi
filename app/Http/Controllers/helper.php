<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
use Carbon\Carbon as CarbonCarbon;
class Helpers {

    public function __construct() {
        
    }
     
    public static function limite_texto($value, $limit = 20, $end = '...'){
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
                return $value;
        }
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
    }

    public static function mesActual(){     
        return '04';    
    }

    public static function mesyanotext(){
        return CarbonCarbon::now()->isoFormat("MMMM Y"); 
    }

    public static function mesActualtext(){ 
         return CarbonCarbon::now()->isoFormat('MMMM');
    }

    public static function anoActual(){   
        return CarbonCarbon::now()->format('Y');
    }

    public static function fechaactualText(){  
        return CarbonCarbon::now()->isoFormat("D \D\E MMMM Y");
    }

    public static function fechaactual(){    
        return '2023-04-30';
        return CarbonCarbon::now()->format('Y-m-d');
    }

    public static function encriptar($id){
        $timestamp = 125346164;
        $randomKey = 21415; 
        return base64_encode($id);
    }

    public static function decriptar($id){ 
        return base64_decode($id);
    }

    public static function moneyformat($money){
        return number_format($money, 2, '.', ',');
    }

    public static function versionfile(){ 
        return 'v1.920102022';
    }
}
