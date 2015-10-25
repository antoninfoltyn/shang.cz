<?php

// Router je speciální typ controlleru, který podle URL adresy zavolá
// správný controller a jím vytvořený pohled vloží do šablony stránky

class SmerovacKontroler extends Kontroler
{
    // Instance controlleru
    protected $kontroler;

    // Metoda převede pomlčkovou variantu controlleru na název třídy
    private function pomlckyDoVelbloudiNotace($text)
    {
        $veta = str_replace('-', ' ', $text);
        $veta = ucwords($veta);
        $veta = str_replace(' ', '', $veta);
        return $veta;
    }

    // Naparsuje URL adresu podle lomítek a vrátí pole parametrů
    private function parsujURL($url)
    {
        // Naparsuje jednotlivé části URL adresy do asociativního pole
        $naparsovanaURL = parse_url($url);
        // Odstranění počátečního lomítka
        $naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
        // Odstranění bílých znaků kolem adresy
        $naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
        // Rozbití řetězce podle lomítek
        $rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
        return $rozdelenaCesta;
    }



    // Naparsování URL adresy a vytvoření příslušného controlleru
    public function zpracuj($parametry)
    {
        $naparsovanaURL = $this->parsujURL($parametry);

        // Vložení configuračního souboru - do budoucna předělat na funkci
        include("config.php");

        if ($multiJazycnost == true)
        {
            // Pokud je URL prázdné je jazyk defaultní a include "UvodKontroler"
            if (empty($naparsovanaURL[0])) {
                $tridaKontroleru = 'UvodKontroler';
                $jazyk = $multiJazycnostVychoziJazyk;
            }



            // Pokud je zadán jen jazyk, kontrolujeme jej a include "UvodKontroler", jinak směrujeme na "chyba"
            elseif (empty($naparsovanaURL[1])) {

                $jazyk = array_shift($naparsovanaURL);

                // Kontrola existence jazyku
                if (!in_array($jazyk, $multiJazycnostJazyky)) {
                    $this->presmeruj('chyba');
                }

                $tridaKontroleru = 'UvodKontroler';
                $this->data['mUvod'] = 'class="active" ';

            }

        } else
        {
            // Pokud je vypnuta multijazyčnost a URL je prázdné, include "UvodKontroler"
            if (empty($naparsovanaURL[0]))
                $tridaKontroleru = 'UvodKontroler';
                $this->data['mUvod'] = 'class="active" ';
        }

        // pokud stále neexistuje $tridaKontoleru, tedy nenastala žádná z předchozích situací a URL je plné
        if (empty($tridaKontroleru)) {

            if ($multiJazycnost == true) {
                $jazyk = array_shift($naparsovanaURL);

            // Kontrola existence jazyku
            if (!in_array($jazyk, $multiJazycnostJazyky)) {
                $this->presmeruj('chyba/');
            }
        }

            // Proměnná k zviditelnění položky menu
            if (isset($naparsovanaURL[0])) {
                $menuZvyraznit = $naparsovanaURL[0];
            }

            // kontroler je již na 1. parametr URL
            $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';

        }

        // existuje kontroler?
        if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
            $this->kontroler = new $tridaKontroleru;
        else
            $this->presmeruj('chyba/');

        // předání jazyka kontroleru
        if ($multiJazycnost == true) {
            $this->kontroler->data['jazyk'] = $jazyk;
        } else {
            $this->kontroler->data['jazyk'] = $multiJazycnostVychoziJazyk;
        }

        // Předání další části URL pohledům
        for ($p = 0; $p < count($naparsovanaURL); ++$p){
            $url = 'url_'.$x = $p + 1;
            $this->data[$url] = $this->kontroler->data[$url] = $naparsovanaURL[$p];
        }

        // Volání controlleru
        $this->kontroler->zpracuj($naparsovanaURL);

        // Nastavení proměnných pro šablonu
        $this->data['titulek'] = $this->kontroler->hlavicka['titulek'];
        $this->data['popis'] = $this->kontroler->hlavicka['popis'];
        $this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
        $this->data['serverName'] = $_SERVER['SERVER_NAME'];





        // Zvyrazenění menu
        if (isset($menuZvyraznit)) {

            if ($menuZvyraznit == 'program') $this->data['mProgram'] = 'class="active" ';
            elseif ($menuZvyraznit == 'vstupenky') $this->data['mVstupenky'] = 'class="active" ';
            elseif ($menuZvyraznit == 'fotogalerie') $this->data['mFotogalerie'] = 'class="active" ';
            elseif ($menuZvyraznit == 'partneri') $this->data['mPartneri'] = 'class="active" ';
            elseif ($menuZvyraznit == 'recenze') $this->data['mRecenze'] = 'class="active" ';
            elseif ($menuZvyraznit == 'archiv') $this->data['mArchiv'] = 'class="active" ';
            elseif ($menuZvyraznit == 'kontakt') $this->data['mKontakt'] = 'class="active" ';

        }

        // Nastavení hlavní šablony
        $this->pohled = $jazyk . '_rozlozeni';
    }



}
