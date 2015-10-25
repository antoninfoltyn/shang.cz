<!DOCTYPE html>
<html lang="cs">
<head>
    <base href="http://<?php echo $serverName; ?>" />
    <meta charset="UTF-8" />
    <title><?= $titulek ?></title>
    <meta name="description" content="<?= $popis ?>" />
    <meta name="keywords" content="<?= $klicova_slova ?>" />
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/styly.css" type="text/css"/>
	  <link rel="stylesheet" href="css/lightbox.css">
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

</head>

<body>

<div id="header">

    <header class="container">
        <a href="http://<?php echo $serverName; ?>/en/"><div id="header-lang"><img src="img/header/en.png"></div></a>
        <a href="http://www.facebook.com/pages/MusicOlomouc/190275294347598?fref=ts" target="_blank"><div id="header-facebook"><img src="img/header/fb.png"></div></a>

        <a href="http://<?php echo $serverName; ?>"><h1><span style="visibility: hidden">MusicOlomouc</span><img src="img/header/header-logo.png" alt="MusicOlomouc - Mezinárodní festival soudobé hudby" id="header-logo-img"><br clear="both" /></h1></a>
    </header>

    <nav class="container">
        <ul>
            <li ><a <?= $mUvod ?>href="<?php if (isset($o)) echo $o; else echo '/'; ?>">O festivalu</a></li>
            <li><a <?= $mProgram ?>href="<?= $o ?>program/">Program</a></li>
            <li><a <?= $mVstupenky ?>href="<?= $o ?>vstupenky/">Vstupenky</a></li>
            <li><a <?= $mFotogalerie ?>href="<?= $o ?>fotogalerie/">Fotogalerie</a></li>
            <li><a <?= $mPartneri ?>href="<?= $o ?>partneri/">Partneři</a></li>
            <li><a <?= $mRecenze ?>href="<?= $o ?>recenze/">Recenze</a></li>
            <li><a <?= $mArchiv ?>href="<?= $o ?>archiv/">Archiv</a></li>
            <li class="end"><a <?= $mKontakt ?>href="<?= $o ?>kontakt/">Kontakt</a></li>
        </ul>
    </nav>
    <div class="cleaner"><hr /></div>

</div>

<article  class="container">
    <?= $test ?>
    <?php

    $this->kontroler->vypisPohled();
    
    ?>

</article>

<div id="footer">

    <footer class="container">

        <div class="copy">
            Copyright © 2009 - 2015 MusicOlomouc
        </div>
        <div class="webmaster">

        </div>

        <div class="cleaner"><hr /></div>

    </footer>

</div>

</body>
</html>
