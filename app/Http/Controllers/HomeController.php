<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShiftModel;

class HomeController extends Controller
{
    private $ShiftModel;

    public function Shift(Request $request){

        //Проверка исходного текста
        if($request->post('src') == ''){return back();}
        
        //проверка длинны ключа
        if($request->post('key_len') != 128 && $request->post('key_len') != 256){return back();}
        
        //Проверка нажатой кнопки
        if($request->post('button') != 'Encode' && $request->post('button') != 'Decode'){return back();}
        
        //Инициализация переменных
        $src = $request->post('src');
        $key_len = $request->post('key_len');
        $button = $request->post('button');

        //Если шифруем текст
        if($button == 'Encode'){
            //Генерация секретного ключа
            $key = openssl_random_pseudo_bytes($key_len / 8);
            //Запись ключа в сессию
            $request->session()->put('key', $key);
        }
        //Если дешифруем текст, достаём ключ из сессии
        else{$key = $request->session()->get('key');}

        //Инициализация объекта ShiftModel
        $this->ShiftModel = new ShiftModel($src, $key);

        //Вызов соответствующего метода
        $res = $this->ShiftModel->$button();

        //Вывод результата
        echo $res;
        
        

    }
}
