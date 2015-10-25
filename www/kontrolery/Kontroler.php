<?php

// Výchozí kontroler
abstract class Kontroler
{
    protected $dataProKontroler = '';
    // Pole, jehož indexy jsou poté viditelné v šabloně jako běžné proměnné
    protected $data = array();
    // Název šablony bez přípony
    protected $pohled = "";
    // Hlavička HTML stránky
    protected $hlavicka = array();

    // Vyrenderuje pohled
    public function vypisPohled()
    {
        if ($this->pohled)
        {
            // Předej proměnné vloženému pohledu (prostě je tady vypiš a v pohledu niže je můžeš použít)
            extract($this->data);

            // Definice adresy pohledu
            $pohled = "pohledy/" . $this->pohled . ".php";

            // Kontrola existence pohledu, pokud pohled není nalezen -> chyba
            if(!file_exists( $pohled)) $this->presmeruj('chyba/');

            require($pohled);
    }
    }

    // Přesměruje na dané URL
    public function presmeruj($url)
    {
        include ('config.php');

        if ($multiJazycnost == true) { $url = $multiJazycnostVychoziJazyk . "/" . $url; }

        header("Location: $url");
        header("Connection: close");
        exit;


    }

    // Zapiš do logu
    public function log($zapis)
    {
        $soubor = fopen("./log.php", "a");
        $zapis = date("Y-m-d H:i:s") . " " . $zapis . " " . "<br> \n";
        fwrite($soubor, $zapis);
        fclose($soubor);
    }



    // Hlavní metoda controlleru
    abstract function zpracuj($parametry);

}
