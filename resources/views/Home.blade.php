<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="ASCII">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RC4</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <form action="/Shift" method="POST">

        <input type="text" placeholder="Исходное или зашифрованное сообщение" name="src">
        <div class="select">
            <select name="key_len">
                <option value="128">128</option>
                <option value="256">256</option>
            </select>
        </div>
        <div class="line">
            <button type="submit" name="button" value="Encode">Зашифровать</button>
            <button type="submit" name="button" value="Decode">Расшифровать</button>
        </div>


        @csrf
    </form>
</body>
</html>