<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
mb_internal_encoding('UTF-8');
$db = mysqli_connect('localhost', 'espana', 'javaprogramiranje', 'books');

if (!$db) {
    echo 'No database';
}
mysqli_set_charset($db, 'utf8');

function getAuthors($db) {
    $q = mysqli_query($db, 'SELECT * FROM authors');
    if (mysqli_error($db)) {
        return FALSE;
    }
    $ret= [];
    while ($row = mysqli_fetch_assoc($q)) {
        $ret[] = $row;
    }
    return $ret;
}
function  isAuthorIdExist ($db, $ids){
    
    if(!is_array($ids)){
        return FALSE;
    }
    $q = mysqli_query($db, 'SELECT * FROM authors WHERE author_id IN ('. implode(',', $ids) . ')');
    if(mysqli_error($db)){
        return FALSE;
    }
    if(mysqli_num_rows($q)== count($ids)){
        return true;
    }
    return FALSE;
    
}