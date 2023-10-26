<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShiftModel extends Model
{
    //Инициализация переменных
    private string $src;
    private string $key;

    public function __construct($src, $key){
        $this->src = $src;
        $this->key = $key;
    }

    //Шифрование
    public function Encode(){

        //Шифрование RC4
        $res = $this->RC4($this->src, $this->key);

        //Шифрование Baset64 для коректного отображения
        return base64_encode($res);
    }

    //Дешифрование
    public function Decode(){

        //Дешифрование Base64
        $this->src = trim(base64_decode($this->src));

        //Дешифрование RC4
        return $this->RC4($this->src, $this->key);
    }

    //RC4
    public function RC4($str, $key){

        $s = array();
        for ($i = 0; $i < 256; $i++) {
            $s[$i] = $i;
        }
        $j = 0;
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
        }
        $i = 0;
        $j = 0;
        $res = '';
        for ($y = 0; $y < strlen($str); $y++) {
            $i = ($i + 1) % 256;
            $j = ($j + $s[$i]) % 256;
            $x = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $x;
            $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
        }
        
        return $res;
    }
}

