



<?php
//уничтожаем куки
//setcookie('username', $_POST['username'], 0, "/");
//unset($_SESSION['user']);
//
//echo preg_match('[[a-z0-9A-Z-:/._]*]', 'http://www.bugaga.ru/uploads/posts/2016-02/1455210586_kartinki-21.jpg');
//echo "<br>";
//
//echo preg_match('[\[img=&quot;[a-z0-9A-Z-:/\[\]._]*&quot;\]]', '[img=&quot;http://www.bugaga.ru/uploads/posts/2016-02/1455210586_kartinki-21.jpg&quot;]', $m);
//
//echo "<br>";
//
//var_dump($m);
//echo "<br>";
//
//echo preg_match('[\[b\]]', 'df[b]');
//
//echo "<br>";
//
//
//echo preg_replace('[\[img=&quot;[a-z0-9A-Z-:/._]*&quot;\]]', 'hello', sanitizeString('[img="http://"]'));
//
//









// Задачка 551

$a0 = 1;// prev number

$n = 10**9;
$n2 = 10**8;
$n3 = 10**10;
$n4 = 10**12;
$n5 = 10**14;
$n6 = 10**15;
for ($i = 1;$i < 11;$i++) {
    $temp = (string)$a0;
    for ($j = 0;$j < strlen($temp);$j++)
        $a0 += $temp[$j];
}
//
//
//for ($i = $n;$i < $n2;$i++) {
//    $temp = (string)$a0;
//    for ($j = 0;$j < strlen($temp);$j++)
//        $a0 += $temp[$j];
//}

//for ($i = $n2;$i < $n3;$i++) {
//    $temp = (string)$a0;
//    for ($j = 0;$j < strlen($temp);$j++)
//        $a0 += $temp[$j];
//}



echo $a0;


//$g = 0;
//for ($i = 10**8;$i < $n;$i+=1000) {
//    $g++;
//}
//
//echo $g;