<?php

use Carbon\Carbon as CarbonCarbon;

function limite_texto($value, $limit = 20, $end = '...'){
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
    }
    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}

function mesActual(){     
    return '04';    
}

function mesyanotext(){
    return CarbonCarbon::now()->isoFormat("MMMM Y"); 
}

function mesActualtext(){ 
     return CarbonCarbon::now()->isoFormat('MMMM');
}

function anoActual(){   
    return CarbonCarbon::now()->format('Y');
}

function fechaactualText(){  
    return CarbonCarbon::now()->isoFormat("D \D\E MMMM Y");
}

function fechaactual(){    
    return '2023-04-30';
    return CarbonCarbon::now()->format('Y-m-d');
}

function encriptar($id){
    $timestamp = 125346164;
    $randomKey = 21415; 
    return base64_encode($id);
}

function decriptar($id){ 
    return base64_decode($id);
}

function moneyformat($money){
    return number_format($money, 2, '.', ',');
}

function versionfile(){ 
    return 'v1.920102022';
}