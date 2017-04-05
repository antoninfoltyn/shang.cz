<?php

class Htaccess
{

    public static function nastav()
    {
/////////////////////////////////////////////////////////////////////////////////////////
// Zde z serverové proměnné $SERVER[] zjišťujeme podsložku (pokud je v ní server umístěn)

$documentRoot = "www";

// Pokud je script na localhostu a kořenová složka webu je jiná než standardně "www", je předán název této složky. Na produkci se spoléhá na to že kořenová složka bude www.
if ($_SERVER['SERVER_NAME'] == "localhost") {
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
$documentRoot = explode('/', $documentRoot);
$documentRoot = array_pop($documentRoot);
}

$scriptFilename = $_SERVER['SCRIPT_FILENAME'];

$scriptFilename = str_replace("///","//",$scriptFilename); //nahrazuje lomítka jedním (v proměnné SCRIPT_FILENAME jich může být více)
$scriptFilename = str_replace("//","/",$scriptFilename); // -//-
$scriptFilename = strstr($scriptFilename, $documentRoot); // Ořeže řetězec o vše před www

// Pokud se nejen poslední podsložka jmenuje www ale je jich více ořeže se vše před posledním www
while(2<=substr_count($scriptFilename, $documentRoot)){
    $scriptFilename = substr($scriptFilename, 1);
    $scriptFilename = strstr($scriptFilename, $documentRoot);
}

$podslozka = mb_substr($scriptFilename, mb_strlen($documentRoot)+1);

$podslozkaHelp = $podslozka;
$podslozkaHelp = explode('/', $podslozkaHelp);
$podslozkaHelp = array_pop($podslozkaHelp);

// TATO PROMENA LZE VYUZIT POKUD JE POTREBA VEDET V JAKE PODSLOZCE JSME
$podslozka = str_replace($podslozkaHelp,"",$podslozka);

// Pokud je podsložka definována v configuračním souboru dosadí se
$podslozkaDefinovanaVSouboru = "";
if (Shang::config("podslozka") != "") {
    $podslozka = Shang::config("podslozka");
    $podslozkaDefinovanaVSouboru = " Podsložka definována v configuračním souboru nesouhlasí se sloužkou v .htaccess.";
}

///////////////////////////////////////////////////////
// Dále zjišťujeme zda je soubor .htacces v pořádku


$vygenerovatHtaccess = false;

if (file_exists(".htaccess")) {
    $souborHtaccessu = fopen(".htaccess", "r");
    $obsahHtaccessu = fread($souborHtaccessu, 500);
    fclose($souborHtaccessu);

    if (mb_strpos($obsahHtaccessu, '/index.php')) {

        $poziceVyskytuIndexu = mb_strpos($obsahHtaccessu, '/index.php');
        $zopakovat = true;
        $pocetZnakuPredIndexem = 1;
        do {
            if (mb_substr($obsahHtaccessu, $poziceVyskytuIndexu - $pocetZnakuPredIndexem, 1) == " ") {
                $zopakovat = false;
            }
            $pocetZnakuPredIndexem++;
        }
        while($zopakovat == true);

        $podslozkaNastavenaVHtaccessu = mb_substr($obsahHtaccessu, $poziceVyskytuIndexu-$pocetZnakuPredIndexem+3, $pocetZnakuPredIndexem-2);

        if ($podslozkaNastavenaVHtaccessu != $podslozka) {
            $chyba = "Podsložka nastavená v htaccessu se nerovná podsložce kde je umístěn web, systém se pokusil o jeho opravu.";
            $vygenerovatHtaccess = true;
        }
    } else {
        $chyba = "Soubor .htaccess neobsahuje řetezec index.php, systém se pokusil o jeho opravu.";
        $vygenerovatHtaccess = true;
    }

} else {
    $chyba = "Soubor .htacces neexistuje, systém se pokusil o jeho vytvoření.";
    $vygenerovatHtaccess = true;
}

////////////////////////////////////////////////////////////////////////
// Pokud soubor .htaccess není v pořádku nebo neexistuje vytvoří se:


if ($vygenerovatHtaccess == true) {
    $text =
        "RewriteEngine On" . "\r\n" .
        "RewriteCond %{REQUEST_FILENAME} !-f" . "\r\n" .
        "RewriteCond %{REQUEST_FILENAME} !-d" . "\r\n" .
        "RewriteRule !\.(css|js|icon|zip|rar|png|jpg|gif|pdf)$ /" . $podslozka . "index.php [L]";

    $soubor = fopen(".htaccess", "w");
    fwrite($soubor, $text);
    fclose($soubor);

    $chyba .= $podslozkaDefinovanaVSouboru;
    Shang::chyba("Problém se souborem .htaccces", $chyba);
}


}



}
