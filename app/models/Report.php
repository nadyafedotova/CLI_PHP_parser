<?php

namespace App;

class Report
{
    // Запись найденых даных в файл CSV.
    public function reportCSV($date, $adres)
    {
        $fp = fopen($adres, 'a');
        foreach ($date as $string) {
            $dates[] = $string . "\n";
        }
        fputcsv($fp, $dates);
        fclose($fp);
    }

    public function viewsReportCSV($domain)
    {
    // Валидация домена.
        $corect_domain = preg_match('#http#', $domain);

        if ($corect_domain !== 0) {
            $segments = explode('/', $domain);
            $domain = $segments[2];
        } else {
            $segments = explode('/', $domain);
            $domain = $segments[0];
        }

    // Поиск файла отчета ссылок.
        $fl_link = ROOT . '/report_files/' . $domain . '_List_Links.csv';
        if (file_exists($fl_link)) {
            $f_link = fopen($fl_link, 'r');
            $arr_link = fgetcsv($f_link);
            fclose($f_link);

            echo "\n\nНайдено ссылок: " . count($arr_link) .
                "\nОтчет со списком ссылок, по указанном домене: " . $fl_link;
        } else {
            echo "\n\nНе найдено, файлов отчета, со списком ссылок, по указанном домене!\n";
        }

    // Поиск файла отчета изображений.
        $fl_img = ROOT . '/report_files/' . $domain . '_List_Image.csv';
        if (file_exists($fl_img)) {
            $f_image = fopen($fl_img, 'r');
            $arr_img = fgetcsv($f_image);
            fclose($f_image);

            echo "\n\nНайдено изображений: " . count($arr_img) .
                "\nОтчет со списком изображений, по указанном домене: " . $fl_img . "\n";
            exit();
        } else {
            echo "\nНе найдено, файлов отчета, со списком изображений, по указанном домене!\n";
            exit();
        }
    }

}