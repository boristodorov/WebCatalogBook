<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
mb_internal_encoding('UTF-8');
$db= mysqli_connect('localhost', 'espana', 'javaprogramiranje', 'books');

if(!$db){
    echo 'No database';
}
mysqli_set_charset($db, 'utf8');
