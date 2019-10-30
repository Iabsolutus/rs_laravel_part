<?php


namespace App\Repositories;


use App\Dsinwork;

class OdbcRepository
{

    private static function connect()
    {
        // устанавлеваем соединение с сервером odbc
        $server = 'mtx-crm-sd';
        $database = 'sd1307_MSCRM';
        $connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$database;";
        $connect = odbc_connect($connection_string,"","");

        if ($connect) {
            //echo "Соединение установлено.";
        } else{
            die("Соединение не может быть установлено.");
        }

        return $connect;
    }

    /**
     * Функция получения информации о ДС в работе с базы CRM
     * Перезапись всей локальной таблицы Dsinwork
     * @return $rows
     */
    public static function getDS()
    {

        $connect = self::connect();

        $queryodbc = 'SELECT vw_RSSPerformance.ФИО, vw_RSSPerformance.Город, vw_RSSPerformance.Филиал, vw_RSSPerformance.Сервис,
            vw_RSSPerformance."Полный номер ДС" AS Полный_номер_ДС, vw_RSSPerformance.ЦВЗ, vw_RSSPerformance.Заголовок, vw_RSSPerformance."Год начала",
            vw_RSSPerformance."Месяц начала", vw_RSSPerformance."Статус ДС"
            FROM sd1307_MSCRM.dbo.vw_RSSPerformance vw_RSSPerformance
            WHERE (vw_RSSPerformance."Год начала">=2013) AND (vw_RSSPerformance."Месяц начала">=1) AND (vw_RSSPerformance."Статус ДС"=\'Выполняется\')';

        $queryodbc = iconv("UTF-8", "CP1251", $queryodbc); // изминение кодировке в строке запроса на сервер odbc

        $result = odbc_exec($connect, $queryodbc); // отправляем запрос на сервер odbc


        //переобразования полученой информации в масив
        $rows = [];
        while($row = odbc_fetch_array($result)) {
            $rows[] = $row;
        };

        odbc_close($connect); // закрыть соединение

        $rows = self::iconvArray($rows, 'CP1251', 'UTF-8'); // изминение кодировке в масиве

        return $rows;

    }

    /**
     * @param $inputArray - входящий моногоуровневый масив
     * @param string $oldEncoding - кодировка масива при входе
     * @param string $newEncoding - кодировка масива при выходе
     * @return array - моногоуровневый масив в новой кодировке
     */
    protected static function iconvArray($inputArray, $oldEncoding = 'CP1251', $newEncoding = 'UTF-8'){
        $outputArray=[];
        if ($newEncoding != ''){
            if (!empty($inputArray)){
                foreach ($inputArray as $key => $element){
                    if (!is_array($element)){
                        $element=iconv($oldEncoding, $newEncoding, $element);
                        $key=iconv($oldEncoding, $newEncoding, $key);
                    } else {
                        $element=self::iconvArray($element);
                    }
                    $outputArray[$key]=$element;
                }
            }
        }
        return $outputArray;
    }



    public function scopeLaravel($query)
    {

    }

    
}