<?php
//$sqlhostname = "localhost";
//$sqluser = "myuser";
//$sqlpass = "123";
//$connectsql = mysql_connect($sqlhostname, $sqluser, $sqlpass) or die("�� ���� ����������� � MySQL.");
//mysql_select_db('test') or die("�� ���� ������������ � ����.");
//mysql_query("SET NAMES 'cp1251'");
//mysql_query("SET CHARACTER SET 'cp1251'");


$server = 'mtx-crm-sd';
$database = 'sd1307_MSCRM';
$connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database";
$connect = odbc_connect($connection_string,"","");
if ($connect) {
    //echo "���������� �����������.";
} else{
    die("���������� �� ����� ���� �����������.");
}
$queryodbc = 'SELECT vw_RSSPerformance.���, vw_RSSPerformance.�����, vw_RSSPerformance.������, vw_RSSPerformance.������,
vw_RSSPerformance."������ ����� ��", vw_RSSPerformance.���, vw_RSSPerformance.���������, vw_RSSPerformance."��� ������",
vw_RSSPerformance."����� ������", vw_RSSPerformance."������ ��"
FROM sd1307_MSCRM.dbo.vw_RSSPerformance vw_RSSPerformance
WHERE (vw_RSSPerformance."��� ������">=2013) AND (vw_RSSPerformance."����� ������">=1) AND (vw_RSSPerformance."������ ��"=\'�����������\')';
//echo $queryodbc; die;
//vw_RSSPerformance."����� ���������"

$result = odbc_exec($connect, $queryodbc);

$querydel = "DELETE FROM `test`.`DSinWork` WHERE `DSinWork`.`�` = 0";
$resdel = mysql_query($querydel, $connectsql);

while($rowvacation = odbc_fetch_array($result)) {
    $val1 = mysql_real_escape_string($rowvacation['���']);
    $val2 = mysql_real_escape_string($rowvacation['�����']);
    $val3 = mysql_real_escape_string($rowvacation['�������']);
    $val4 = mysql_real_escape_string($rowvacation['������']);
    $val5 = mysql_real_escape_string($rowvacation['������']);
    $val6 = mysql_real_escape_string($rowvacation['������ ����� ��']);
    $val7 = mysql_real_escape_string($rowvacation['���']);
    $val8 = mysql_real_escape_string($rowvacation['���������']);
    $val9 = mysql_real_escape_string($rowvacation['��� ������']);
    $val10 = mysql_real_escape_string($rowvacation['����� ������']);
    $val11 = mysql_real_escape_string($rowvacation['������ ��']);

    $query = "INSERT INTO `DSinWork`(`���`, `�����`, `�������`, `������`, `������`, `������_�����_��`, `���`, `���������`,
                                  `��� ������`, `����� ������`, `������ ��`)
            VALUES ('" .$val1 . "', '" .$val2 . "', '" .$val3 . "', '" .$val4 . "', '" .$val5 . "', '" .$val6 . "',
            '" .$val7 . "', '" .$val8 . "', '" .$val9 . "', '" .$val10 . "', '" .$val11 . "')";
    //echo $query;
    //echo '<br>';



    $res = mysql_query($query, $connectsql);
}
/*
echo '<script type="text/javascript">';
echo 'setTimeout(function() { window.location.href="../test2.php"; },300000)'; // ��������� ���� �� � ������������ �� ��� �� ���������
echo '</script>';

echo '<script type="text/javascript">';
echo 'window.location.href="' .$referer . '";'; // ������������� �� �������� �����������
echo '</script>';



*/

?>
