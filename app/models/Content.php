<?php

namespace App;

class Content
{
    public $url;


    /*
     * 
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /*
     *
     * Получение URL сайта.
     */
    public function siteContent()
    {

        // Ограничение: минимальная длина ссылки 4 символа.
        if (strlen($this->url) < 4) {
            echo "\n\nСcылка введена не верно!";
            exit();
        }

        $correctURL = preg_match('#http#', $this->url);

        if ($correctURL == 0) {
            $this->url = 'http://' . $this->url;
        }


    // Определяем домен
        $segment = explode('/', $this->url);
        define('DOMAIN', $segment[2]);


    // Получение всех данных со страницы.
        $curl = curl_init(); // Иницыализация библиотеки CURL

        curl_setopt($curl, CURLOPT_URL, $this->url); // Указываем адрес страницы.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Позволяет сохранить ответ сервера в переменную а не выводить на экран.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // Позволяет переходить по редиректам.

        $site = curl_exec($curl);

        return $site;
    }
}