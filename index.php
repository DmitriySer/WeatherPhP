<?php
class Pogoda
{
    public function Water()
{
    $url = "https://yandex.ru/pogoda/?";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);

    preg_match('#id="main_title">(.*?)<\/h1>#', $data, $matchesCity);
    preg_match('#Текущая\sтемпература\s(.*?),#', $data, $matchesC);
    preg_match('#{"day-anchor":{"anchor":6}}\'>(.*?)<\/div><div\sclass="term#',$data, $matchesS);
    preg_match('#class="wind-speed">(.*?)<\/span>\s<span\sclass="fact__unit">(.*?)\s<abbr\sclass="\sicon-abbr"\stitle=".*?>(.*?)<\/abbr>#',$data,$matchesV);
    preg_match('#icon_humidity-white\sterm__fact-icon"\saria-hidden="true"><\/i>(.*?)<\/div>#',$data,$matchesVl);

    $weather = [
        'Место' => $matchesCity[1],
        'Температура' => $matchesC[1],
        'Состояние' => $matchesS[1],
        'Ветер' => $matchesV[1].' '.$matchesV[2].' '.$matchesV[3],
        'Влажность' => $matchesVl[1],
    ];
    return $weather;
}
}

$obj = new Pogoda();

print_r($obj->Water());

