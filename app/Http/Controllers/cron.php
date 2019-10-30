<?php
//$sqlhostname = "localhost";
//$sqluser = "myuser";
//$sqlpass = "123";
//$connectsql = mysql_connect($sqlhostname, $sqluser, $sqlpass) or die("Не могу соединиться с MySQL.");
//mysql_select_db('test') or die("Не могу подключиться к базе.");
//mysql_query("SET NAMES 'cp1251'");
//mysql_query("SET CHARACTER SET 'cp1251'");


$server = 'mtx-crm-sd';
$database = 'sd1307_MSCRM';
$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
$connect = odbc_connect($connection_string,"","");
if ($connect) {
    //echo "Соединение установлено.";
} else{
    die("Соединение не может быть установлено.");
}
$queryodbc = 'SELECT vw_RSSPerformance.ФИО, vw_RSSPerformance.Город, vw_RSSPerformance.Филиал, vw_RSSPerformance.Сервис,
vw_RSSPerformance."Полный номер ДС", vw_RSSPerformance.ЦВЗ, vw_RSSPerformance.Заголовок, vw_RSSPerformance."Год начала",
vw_RSSPerformance."Месяц начала", vw_RSSPerformance."Статус ДС"
FROM sd1307_MSCRM.dbo.vw_RSSPerformance vw_RSSPerformance
WHERE (vw_RSSPerformance."Год начала">=2013) AND (vw_RSSPerformance."Месяц начала">=1) AND (vw_RSSPerformance."Статус ДС"=\'Выполняется\')';
//echo $queryodbc; die;
//vw_RSSPerformance."Время изменения"

$result = odbc_exec($connect, $queryodbc);

$querydel = "DELETE FROM `test`.`DSinWork` WHERE `DSinWork`.`№` = 0";
$resdel = mysql_query($querydel, $connectsql);

while($rowvacation = odbc_fetch_array($result)) {
    $val1 = mysql_real_escape_string($rowvacation['ФИО']);
    $val2 = mysql_real_escape_string($rowvacation['Город']);
    $val3 = mysql_real_escape_string($rowvacation['Аккаунт']);
    $val4 = mysql_real_escape_string($rowvacation['Филиал']);
    $val5 = mysql_real_escape_string($rowvacation['Сервис']);
    $val6 = mysql_real_escape_string($rowvacation['Полный номер ДС']);
    $val7 = mysql_real_escape_string($rowvacation['ЦВЗ']);
    $val8 = mysql_real_escape_string($rowvacation['Заголовок']);
    $val9 = mysql_real_escape_string($rowvacation['Год начала']);
    $val10 = mysql_real_escape_string($rowvacation['Месяц начала']);
    $val11 = mysql_real_escape_string($rowvacation['Статус ДС']);

    $query = "INSERT INTO `DSinWork`(`ФИО`, `Город`, `Аккаунт`, `Филиал`, `Сервис`, `Полный_номер_ДС`, `ЦВЗ`, `Заголовок`,
                                  `Год начала`, `Месяц начала`, `Статус ДС`)
            VALUES ('" .$val1 . "', '" .$val2 . "', '" .$val3 . "', '" .$val4 . "', '" .$val5 . "', '" .$val6 . "',
            '" .$val7 . "', '" .$val8 . "', '" .$val9 . "', '" .$val10 . "', '" .$val11 . "')";
    //echo $query;
    //echo '<br>';



    $res = mysql_query($query, $connectsql);
}
/*
echo '<script type="text/javascript">';
echo 'setTimeout(function() { window.location.href="../test2.php"; },300000)'; // обновляем базу дс и возвращаемся на ету же страничку
echo '</script>';

echo '<script type="text/javascript">';
echo 'window.location.href="' .$referer . '";'; // перенаправить на страницу авторизации
echo '</script>';



*/

?>
