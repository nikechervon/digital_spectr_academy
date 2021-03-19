<?php

namespace App\Controllers;

use App\Constants\ResponseConstants;
use JetBrains\PhpStorm\Pure;
use App\JsonResponse;

/**
 * Class MainController
 * @package App\Controllers
 */
class MainController
{
    /**
     * Проверяет введенные данные и возвращает код ответа в формате JSON
     * @return string
     */
    public function validationYear(): string
    {
        $year = htmlspecialchars($_POST['year']);

        // Проверка, что строка состоит только из цифр
        if (preg_match("/[\D]/", $year) || empty($year)) {
            return JsonResponse::render(
                ResponseConstants::INPUT_ERROR_RESPONSE_CODE
            );
        }

        // Проверка на високосный год
        if (!self::isLeapYear((int)$year)) {
            return JsonResponse::render(
                ResponseConstants::NOT_LEAP_YEAR_RESPONSE_CODE
            );
        }

        return JsonResponse::render(
            ResponseConstants::LEAP_YEAR_RESPONSE_CODE
        );
    }

    #[Pure]
    /**
     * Проверка на високосный год
     * @param int $year
     * @return bool
     */
    private function isLeapYear(int $year): bool
    {
        $isLeapYear = date(
            "L",
            mktime(0, 0, 0, 7, 7, $year)
        );

        return (bool) $isLeapYear;
    }
}