<?php

function isSessionActive()
{
    if (isset($_SESSION['usuario'])) {
        return header('Location:phpclase.php');
    }
}

function getUsers()
{
    return [
        'admin' => 'admin'
    ]; //aca ya empezo a delirar nacho, comprendi que es como bajar una base de datos xd
}
