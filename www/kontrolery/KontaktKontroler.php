<?php

class KontaktKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {
        $this->hlavicka = array(
            'titulek' => 'MusicOlomouc - Kontakt',
            'klicova_slova' => 'kontakt, email, formulář',
            'popis' => 'Kontakt na organizátory festivalu MusicOlomouc.'
        );

        $this->pohled = $this->data['jazyk'] . '_kontakt';
    }
}
