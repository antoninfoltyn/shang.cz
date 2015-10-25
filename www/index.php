<?php

// Zapnout chybové hlášení
ini_set("display_errors", 1);
error_reporting(E_ERROR | E_WARNING);
 
// Nastavení interního kódování pro funkce pro práci s řetězci
mb_internal_encoding("UTF-8");

// Callback pro automatické načítání tříd controllerů a modelů
function autoloadFunkce($trida)
{
    // Končí název třídy řetězcem "Kontroler" ?
    if (preg_match('/Kontroler$/', $trida))
        require("kontrolery/" . $trida . ".php");
    else
        require("modely/" . $trida . ".php");
}

// Registrace callbacku
spl_autoload_register("autoloadFunkce");

// Připojení k databázi
$serverName = $_SERVER['SERVER_NAME'];

if ($serverName == "127.0.0.1" || $serverName == "localhost") {
    Db::pripoj("localhost", "root", "", "shang");
} else {
    Shang:chyba("Chyba databáze!", "V souboru index.php se nepodařilo připojit k databázi, web je přesunut na nový hosting nebo byly přihlašovací údaje k databázi změněny.");
}


// Vytvoření routeru a zpracování parametrů od uživatele z URL
$smerovac = new SmerovacKontroler();
$smerovac->log("nasrat");
$smerovac->zpracuj($_SERVER['REQUEST_URI']);

// Vyrenderování šablony
$smerovac->vypisPohled();       
