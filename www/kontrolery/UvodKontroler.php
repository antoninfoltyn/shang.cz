<?php

// Controller pro zpracování článku

class UvodKontroler extends Kontroler
{

    public function zpracuj($parametry)
    {
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'MusicOlomouc';

        // Nastavení pohledu
        $this->pohled = $this->data['jazyk'] . '_uvod';

    }
}
