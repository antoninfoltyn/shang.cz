<html>
<head>

<!-- ... -->

    <script language="javascript" type="text/javascript">
        function nastavMenu() {
            var odrolovani = document.body.scrollTop;
            if (odrolovani > 25) {
                document.getElementById('head').style.height = '70px';
                document.getElementById('logo-nadpis').style.fontSize = '30px';
                document.getElementById('logo-kocka').style.height = '86px';
                document.getElementById('logo-kocka').style.width = '92px';
                document.getElementById('menu-polozky').style.marginTop = '6px';
            }else {
                document.getElementById('head').style.height = '94px';
                document.getElementById('logo-nadpis').style.fontSize = '45px';
                document.getElementById('logo-kocka').style.height = '114px';
                document.getElementById('logo-kocka').style.width = '120px';
                document.getElementById('menu-polozky').style.marginTop = '18px';
            }
        }
    </script>

</head>

<body onscroll="nastavMenu()">

<div id="head">

<!-- ... -->

</body>
</html>
