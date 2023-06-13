<?php

require_once "vendor/autoload.php";

function randomErr(): int
{
    $int = rand(1, 3);

    if ($int === 1) {
        throw new Exception("Random Error");
    }

    if ($int === 2) {
        throw new \App\Error\MyError("Custom Error");
    }

    return $int;
}

function useRandom(): string
{
    try {
        echo 'avant error <br>';
        echo strval(randomErr()) . "<br>";
        echo 'après error <br>';
        return "Tout s'est bien passé";
    } catch (Exception $exception) {
        return "Il s'est passé un truc...";
    } catch (\App\Error\MyError $exception) {
        return "Il s'est passé un truc custom !!!!!";
    }
}

echo useRandom();
