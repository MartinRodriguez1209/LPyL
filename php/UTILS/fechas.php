<?php

function calcularEdad($fechaNacimiento)
{
    $nacimiento = new DateTime($fechaNacimiento);
    $hoy = new DateTime("today");
    return $hoy->diff($nacimiento)->y;
}

function esMayorDeEdad($fechaNacimiento)
{
    return calcularEdad($fechaNacimiento) >= 18;
}

function fechaActual($formato = "d/m/Y")
{
    return date($formato);
}

function horaActual($formato = "H:i:s")
{
    return date($formato);
}

function diaDeLaSemana()
{
    $dias = [
        1 => "Lunes",
        2 => "Martes",
        3 => "Miércoles",
        4 => "Jueves",
        5 => "Viernes",
        6 => "Sábado",
        7 => "Domingo"
    ];
    return $dias[date("N")];
}

function numeroDiaSemana()
{
    return (int) date("N"); // 1=lunes, 7=domingo
}

function antiguedad($fechaIngreso)
{
    $ingreso = new DateTime($fechaIngreso);
    $hoy = new DateTime("today");
    return $hoy->diff($ingreso)->y;
}

function tieneAntiguedad($fechaIngreso, $anios = 2)
{
    return antiguedad($fechaIngreso) >= $anios;
}
