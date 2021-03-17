<?php

namespace App\Controller;

use JetBrains\PhpStorm\Pure;

/**
 * Class MainController
 * @package App\Controller
 */
class MainController
{
    /**
     * Подключает шаблон
     * @return void
     */
    public static function show(): void
    {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/task1/index.html';
    }

    /**
     * Проверяет введенные данные и возвращает коды сообщений
     * @return void
     */
    public static function validationYear(): void
    {
        $year = htmlspecialchars($_POST['year']);

        if (!preg_match("/[0-9]/", $year) || empty($year)) {
            echo 0;
        } elseif (!self::isLeapYear((int) $year)) {
            echo 1;
        } else {
            echo 2;
        }
    }

    #[Pure]
    /**
     * Проверяет високосный ли год
     * @param int $year
     * @return bool
     */
    private static function isLeapYear(int $year): bool
    {
        return (bool) date("L", mktime(0, 0, 0, 7, 7, $year));
    }
}