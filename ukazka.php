    private function parsujURL($parametry)
    {
        // Odstranění bílých znaků a "/" kolem adresy
        $delka = trim($parametry["serverPhpSelf"], "/");
        $delka = trim($delka);
        $delka = explode("/", $delka);
        $delka = count($delka)-1;

    // Odstranění bílých znaků a "/" kolem adresy
        $url = trim($parametry["serverRequestUri"], "/");
        $url = trim($url);

        // Rozbití řetězce podle lomítek
        $url = explode("/", $url);

        // Ořezání polí které nepatří do URL (pro funkčnost webu v podsložkách atd.)
        $rozdelenaCesta = array_splice($url, $delka);

        return $rozdelenaCesta;
    }
