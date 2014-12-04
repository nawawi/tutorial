<?php

function tarikh_hari_ini() {
    echo date('d/m/Y H:i:s A');
}

function tarikh_hari_ini2() {
    return date('d/m/Y H:i:s A');
}

function tarikh_hari_ini3($dateset) {
    return date($dateset);
}

class tarikh {

    public function __construct() {
        echo "OK<br>";
    }

    public function __destruct() {
        echo "<br>KO<br>";
    }

    private function tarikh_hari_ini() {
        echo date('d/m/Y H:i:s A');
    }

    function tarikh_hari_ini2() {
        return date('d/m/Y H:i:s A');
    }

    function tarikh_hari_ini3($dateset) {
        return date($dateset);
    }
}

/*tarikh_hari_ini();
echo "<br>";
$tt = tarikh_hari_ini2();
echo "$tt <br>";

$pp="d/M/Y h:i:s A";
$tt2 = tarikh_hari_ini3($pp);
echo "$tt2 <br>";*/

$tarikh = new tarikh();
//echo $tarikh->tarikh_hari_ini2();
echo tarikh::tarikh_hari_ini2();


?>
