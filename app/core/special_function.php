<?php
function rus_date($database_date, $only_date = false, $full_name_month = false)
{
    $date_and_time = '';

    $short_month_array = ['01' => 'янв',
                          '02' => 'фев',
                          '03' => 'мар',
                          '04' => 'апр',
                          '05' => 'мая',
                          '06' => 'июн',
                          '07' => 'июл',
                          '08' => 'авг',
                          '09' => 'сен',
                          '10' => 'окт',
                          '11' => 'ноя',
                          '12' => 'дек'];

    $full_month_array = ['01' => 'января',
                         '02' => 'февраля',
                         '03' => 'марта',
                         '04' => 'апреля',
                         '05' => 'мая',
                         '06' => 'июня',
                         '07' => 'июля',
                         '08' => 'августа',
                         '09' => 'сентября',
                         '10' => 'октября',
                         '11' => 'ноября',
                         '12' => 'декабря'];

    $working_month_array = $full_name_month == true ? $full_month_array : $short_month_array;


    $temp_array = explode(' ', $database_date);

    $date = explode('-', $temp_array[0]);
    $date[2] = (int)$date[2];

    $time = explode(':', $temp_array[1]);
    $time = $time[0] . ':' . $time[1];

    if (date("Y") - $date[0] == 0) {

        if (date("m") - $date[1] == 0) {

            if (date("d") - $date[2] == 0) {
                $date_and_time .= 'сегодня в ';
            } elseif (date("d") - $date[2] == 1) {
                $date_and_time .= 'вчера в ';
            } else {
                $date_and_time .= $date[2] . ' ' . $working_month_array[$date[1]] . ' в ';
            }

        }
        else {

            $date_and_time .= $date[2] . ' ' . $working_month_array[$date[1]] . ' в ';

        }

        $date_and_time .= $time;

    }
    else {

        $date_and_time = $date[2] . ' ' . $working_month_array[$date[1]] . ' ' . $date[0];

    }







    return $date_and_time;
}
function parser_text_with_BBCode_into_html($text) {

    //count open tags
    $count_tag_b = preg_match_all('[\[b\]]', $text);
    $count_tag_i = preg_match_all('[\[i\]]', $text);
    $count_tag_u = preg_match_all('[\[u\]]', $text);
    $count_tag_s = preg_match_all('[\[s\]]', $text);
    $count_tag_h1 = preg_match_all('[\[h1\]]', $text);
    $count_tag_h2 = preg_match_all('[\[h2\]]', $text);
    $count_tag_h3 = preg_match_all('[\[h3\]]', $text);
    $count_tag_url = preg_match_all('[\[url=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]', $text);
    //count close tags
    $count_tag_c_b = preg_match_all('[\[\/b\]]', $text);
    $count_tag_c_i = preg_match_all('[\[\/i\]]', $text);
    $count_tag_c_u = preg_match_all('[\[\/u\]]', $text);
    $count_tag_c_s = preg_match_all('[\[\/s\]]', $text);
    $count_tag_c_h1 = preg_match_all('[\[\/h1\]]', $text);
    $count_tag_c_h2 = preg_match_all('[\[\/h2\]]', $text);
    $count_tag_c_h3 = preg_match_all('[\[\/h3\]]', $text);
    $count_tag_c_url = preg_match_all('[\[\/url\]]', $text);

    //bbcode open tags
    $tag_b = '[b]';
    $tag_i = '[i]';
    $tag_u = '[u]';
    $tag_s = '[s]';
    $tag_h1 = '[h1]';
    $tag_h2 = '[h2]';
    $tag_h3 = '[h3]';
    //bbcode close tags
    $tag_c_b = '[/b]';
    $tag_c_i = '[/i]';
    $tag_c_u = '[/u]';
    $tag_c_s = '[/s]';
    $tag_c_h1 = '[/h1]';
    $tag_c_h2 = '[/h2]';
    $tag_c_h3 = '[/h3]';
    $tag_c_url = '[/url]';

    $array_counts_open_tags = [$count_tag_b, $count_tag_i, $count_tag_u, $count_tag_s, $count_tag_h1, $count_tag_h2, $count_tag_h3, $count_tag_url];
    $array_counts_close_tags = [$count_tag_c_b, $count_tag_c_i, $count_tag_c_u, $count_tag_c_s, $count_tag_c_h1, $count_tag_c_h2, $count_tag_c_h3, $count_tag_c_url];
    $array_open_tags = [$tag_b, $tag_i, $tag_u, $tag_s, $tag_h1, $tag_h2, $tag_h3];
    $array_close_tags = [$tag_c_b, $tag_c_i, $tag_c_u, $tag_c_s, $tag_c_h1, $tag_c_h2, $tag_c_h3, $tag_c_url];

    for ($i = 0;$i < 8;$i++) {
        if ($array_counts_open_tags[$i] != $array_counts_close_tags[$i]) {
            for ($j = 0;$j < abs($array_counts_open_tags[$i] - $array_counts_close_tags[$i]);$j++) {
                $text .= $array_close_tags[$i];
            }
        }
    }

    // ФОТОЧКИ ОБР
    preg_match_all('[\[img=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]', $text, $img, PREG_OFFSET_CAPTURE);
    for ($i = 0;$i < count($img[0]);$i++) {
        $img[0][$i][0] = "<img src=\"" . substr($img[0][$i][0], 11, count($img[0][$i][0]) - 8) . "\">";
    }
    $i = 0;
    while (preg_match('[\[img=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]', $text, $matches, PREG_OFFSET_CAPTURE)) {
        $text = substr_replace($text, $img[0][$i][0], $matches[0][1], strlen($matches[0][0]));
        $i++;
    }
    //ССЫЛКИ ОБР
    preg_match_all('[\[url=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]', $text, $img, PREG_OFFSET_CAPTURE);
    for ($i = 0;$i < count($img[0]);$i++) {
        $img[0][$i][0] = "<a href=\"" . substr($img[0][$i][0], 11, count($img[0][$i][0]) - 8) . "\">";
    }
    $i = 0;
    while (preg_match('[\[url=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]', $text, $matches, PREG_OFFSET_CAPTURE)) {
        $text = substr_replace($text, $img[0][$i][0], $matches[0][1], strlen($matches[0][0]));
        $i++;
    }

    $pattern_bbcode = [ '[\[b\]]', '[\[\/b\]]',
                        '[\[i\]]', '[\[\/i\]]',
                        '[\[u\]]', '[\[\/u\]]',
                        '[\[s\]]', '[\[\/s\]]',
                        '[\[img=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]',
                        '[\[url=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]', '[\[\/url\]]',
                        '[\[h1\]]', '[\[\/h1\]]',
                        '[\[h2\]]', '[\[\/h2\]]',
                        '[\[h3\]]', '[\[\/h3\]]'
    ];


    $html_tags = [  '<b>', '</b>',
                    '<i>', '</i>',
                    '<u>', '</u>',
                    '<s>', '</s>',
                    '<img src="/images/office-small.jpg">',
                    '<a>', '</a>',
                    '<h1>', '</h1>',
                    '<h2>', '</h2>',
                    '<h3>', '</h3>'
    ];

    ksort($pattern_bbcode);
    ksort($html_tags);

    

    return preg_replace($pattern_bbcode, $html_tags, $text); 


}
function connect_db() {
    require 'app/core/connection.php';
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) die($conn->connect_error);
    return $conn;
}
function sanitizeString($str)
{
//        $str = strip_tags($str);
    $str = htmlspecialchars($str);
    $str = str_replace(array("\r\n", "\r", "\n"), "<br>", $str);

    return $str;
}

