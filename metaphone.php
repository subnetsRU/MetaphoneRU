<?php
/*
    MetaphoneRU original JS version (c) Artur Charaev (aka Reaverart)
    Source: https://github.com/Reaverart/MetaphoneRU
    Demo: http://reaverart.github.io/MetaphoneRU/
*/
/*
    MetaphoneRU class (c) Nikolaev Dmitry (aka virus)
    Source: https://github.com/subnetsRU/MetaphoneRU
*/

error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', 'on');
mb_internal_encoding("UTF-8");
mb_regex_encoding('UTF-8');

class MetaphoneRU {
    function normalize ($token) {
        $token = mb_strtoupper($token);
        return mb_eregi_replace("Ъ|Ь|-", '',$token);
    }

    function removeDuplicates ($token) {
        return mb_eregi_replace("(.)\\1", '\1',$token,"i");
    }

    function IOtoI ($token) {
        return mb_eregi_replace("ЙО|ИО|ЙЕ|ИЕ", 'И',$token);
    }

    function OtoA ($token) {
        return mb_eregi_replace("О|Ы|Я", 'А',$token);
    }

    function EtoI ($token) {
        return mb_eregi_replace("Е|Ё|Э", 'И',$token);
    }

    function UtoY ($token) {
        return mb_eregi_replace("Ю", 'У',$token);
    }

    function BtoP ($token) {
        $token = mb_eregi_replace("Б(Б|В|Г|Д|Ж|З|Й|К|П|С|Т|Ф|Х|Ц|Ч|Ш|Щ)", 'П\1',$token);
        $token = mb_eregi_replace("Б$", 'П',$token);
        return $token;
    }

    function ZtoS ($token) {
        $token = mb_eregi_replace("З(Б|В|Г|Д|Ж|З|Й|К|П|С|Т|Ф|Х|Ц|Ч|Ш|Щ)", 'С\1',$token);
        $token = mb_eregi_replace("З$", 'С',$token);
        return $token;
    }

    function DtoT ($token) {
        $token = mb_eregi_replace("Д(Б|В|Г|Д|Ж|З|Й|К|П|С|Т|Ф|Х|Ц|Ч|Ш|Щ)", 'Т\1',$token);
        $token = mb_eregi_replace("Д$", 'Т',$token);
        return $token;
    }

    function VtoF ($token) {
        $token = mb_eregi_replace("В(Б|В|Г|Д|Ж|З|Й|К|П|С|Т|Ф|Х|Ц|Ч|Ш|Щ)", 'Ф\1',$token);
        $token = mb_eregi_replace("В$", 'Ф',$token);
        return $token;
    }

    function GtoK ($token) {
        $token = mb_eregi_replace("Г(Б|В|Г|Д|Ж|З|Й|К|П|С|Т|Ф|Х|Ц|Ч|Ш|Щ)", 'К\1',$token);
        $token = mb_eregi_replace("Г$", 'К',$token);
        return $token;
    }

    function TStoC ($token) {
        return mb_eregi_replace("ТС|ДС", 'Ц',$token);
    }

    function process($token) {
            $token = $this->normalize($token);
            $token = $this->removeDuplicates($token);
            $token = $this->IOtoI($token);
            $token = $this->OtoA($token);
            $token = $this->EtoI($token);
            $token = $this->UtoY($token);
            $token = $this->BtoP($token);
            $token = $this->ZtoS($token);
            $token = $this->DtoT($token);
            $token = $this->VtoF($token);
            $token = $this->GtoK($token);
            $token = $this->TStoC($token);
            $token = $this->removeDuplicates($token);

            return $token;
    }
}

$meta = new MetaphoneRU();
var_dump($meta->process("Арнольд")); //АРНАЛТ
var_dump($meta->process("Длинный")); //ДЛИНАЙ
var_dump($meta->process("йогурт")); //ИГУРТ
var_dump($meta->process("снегопад")); //СНИГАПАТ
var_dump($meta->process("город")); //ГАРАТ
var_dump($meta->process("абырвалг")); //АБАРВАЛК
var_dump($meta->process("незабываемый")); //НИЗАБАВАИМАЙ

?>