<?php

// Controller pro zpracování článku

class ArchivKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'MusicOlomouc - Archiv';

        // Nastavení šablony
        $this->pohled = $this->data['jazyk'] . '_archiv';

    }
}
