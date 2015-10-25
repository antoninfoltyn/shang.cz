<?php

// Controller pro zpracování článku

class FotogalerieKontroler extends Kontroler
{
    public function zpracuj($parametry)
    {

        $this->hlavicka = array(
            'titulek' => 'MusicOlomouc - Program',
            'klicova_slova' => 'program, termín, MusicOlomouc, festival',
            'popis' => 'Program festivalu MusicOlomouc'
        );

        include ('config.php');

        // Pokud neexistuje další položka z URL
        if (empty($parametry[0])) {


            // Nastavení šablony
            $this->pohled = $this->data['jazyk'] . '_seznam-fotogalerie';


        // Pokud existuje položka z URL
        } elseif (file_exists('fotogalerie/' . $parametry[0])) {

            $jazyk = $this->data['jazyk'];

            if ($jazyk == 'cs') {

                if ($parametry[0] == '2014-orchestr-berg-a-mladi-cesti-skladatele') $nazevClanku = 'Orchestr Berg a mladí čeští skladatelé';
                elseif ($parametry[0] == '2014-ivan-myslikovjan-saxofon-elektronika') $nazevClanku = 'Ivan Myslikovjan & saxofon & elektronika';
                elseif ($parametry[0] == '2014-rok-ceske-hudby-a-soudoba-tvorba') $nazevClanku = 'Rok české hudby & soudobá tvorba';
                elseif ($parametry[0] == '2014-monika-knoblochova-prazsti-pevci') $nazevClanku = 'Monika Knoblochová, Pražští pěvci & Stanislav Mistr';
                elseif ($parametry[0] == '2014-praesenz-a-prostor-versus-hruba-hmota') $nazevClanku = 'Praesenz & Prostý prostor versus hrubá hmota';
                elseif ($parametry[0] == '2014-affetto-a-akademici-z-moravy') $nazevClanku = 'Affetto & Akademici z Moravy';
                elseif ($parametry[0] == '2013-dan-barta-a-robert-balzar-trio') $nazevClanku = 'Dan Bárta a Robert Balzar trio';
                elseif ($parametry[0] == '2013-koncert-k-440-vyroci-univerziry-palackeho') $nazevClanku = 'Koncert k 440. výročí Univerzity Palackého';
                elseif ($parametry[0] == '2013-pierrot-lunaire-a-mladi-cesti-autori') $nazevClanku = 'Pierot Lunaire a mladí čeští autoři';
                elseif ($parametry[0] == '2013-stamicovo-kvarteto-hraje-gubajdulinu') $nazevClanku = 'Stamicovo kvarteto hraje Gubajdulinu';
                elseif ($parametry[0] == '2013-trombon-solo-a-tuba-solo') $nazevClanku = 'Trombón sólo a tuba sólo';
                elseif ($parametry[0] == '2013-zahajeni-5-rocniku-festivalu-mo') $nazevClanku = 'Zahájení 5. ročníku festivalu MusicOlomouc';

            } elseif ($jazyk == 'en') {

                if ($parametry[0] == '2014-orchestr-berg-a-mladi-cesti-skladatele') $nazevClanku = 'Berg Orchestra § Young Czech Composers';
                elseif ($parametry[0] == '2014-ivan-myslikovjan-saxofon-elektronika') $nazevClanku = 'Ivan Myslikovjan § Saxophone § Electronics';
                elseif ($parametry[0] == '2014-rok-ceske-hudby-a-soudoba-tvorba') $nazevClanku = 'Year of Czech Music § Contemporary Output';
                elseif ($parametry[0] == '2014-monika-knoblochova-prazsti-pevci') $nazevClanku = 'Monika Knoblochová, Prague Singers';
                elseif ($parametry[0] == '2014-praesenz-a-prostor-versus-hruba-hmota') $nazevClanku = 'Praesenz § Simple Space versus Heavy Matter';
                elseif ($parametry[0] == '2014-affetto-a-akademici-z-moravy') $nazevClanku = 'Praesenz § Simple Space versus Heavy Matter';
                elseif ($parametry[0] == '2013-dan-barta-a-robert-balzar-trio') $nazevClanku = 'Dan Bárta § Robert Balzar Trio';
                elseif ($parametry[0] == '2013-koncert-k-440-vyroci-univerziry-palackeho') $nazevClanku = 'Composers of Palacký University ';
                elseif ($parametry[0] == '2013-pierrot-lunaire-a-mladi-cesti-autori') $nazevClanku = 'Pierot Lunaire a mladí čeští autoři';
                elseif ($parametry[0] == '2013-stamicovo-kvarteto-hraje-gubajdulinu') $nazevClanku = 'The Stamic Quartet plays Gubaidulina';
                elseif ($parametry[0] == '2013-trombon-solo-a-tuba-solo') $nazevClanku = 'Trombone solo § tuba solo';
                elseif ($parametry[0] == '2013-zahajeni-5-rocniku-festivalu-mo') $nazevClanku = 'Ateliér ´90 Praha';

            }


            $this->data['nazev'] = $nazevClanku;
            $this->data['url'] = $parametry[0];

            // Nastavení šablony
            $this->pohled = $this->data['jazyk'] . '_fotogalerie';

        } else {
            $this->presmeruj('chyba');
        }





    }
}
