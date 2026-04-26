<?php
function randomString($length = 3) {
    $randomString = '';
    $characters = implode("", array_merge(range('a', 'z'), range('A', 'Z')));
    $charLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $charLength - 1)];
    }
    return $randomString;
}

function Encode($output) {
    $randomFunc = randomString();
    $randomOut = randomString();
    $randomNum = randomString();
    $randomVal = mt_rand(999999, 99999999);

    $return = '<!-- /*  Ordz HTML Encoder 
 *  Reverse engineering of this file is strictly prohibited. 
 *  File protected by copyright law and provided under license. 
 */  -->
<script>
    var ' . $randomOut . ' = "";
    var ' . $randomNum . ' = [';

    foreach(str_split($output) as $x){
        $encodedChar = base64_encode(randomString() . (ord($x) + $randomVal) . randomString());
        $return .= '"' . $encodedChar . '", ';
        if (mt_rand(0, 1)){
            $return .= "\n";
        }
    }
    $return = rtrim($return, ', ');

    $return .= '];
    ' . $randomNum . '.forEach(function ' . $randomFunc . '(value) {
        ' . $randomOut . ' += String.fromCharCode(parseInt(atob(value).replace(/\D/g,\'\')) - ' . $randomVal . ');
    });
    document.write(decodeURIComponent(escape(' . $randomOut . ')));
</script>';

    return $return;
}

ob_start("Encode");
?>
