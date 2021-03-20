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

        // Результат валидации
        $resultValidate = $this->validation($year);

        // Если есть ошибки, возвращаем
        if (is_string($resultValidate)) {
            return $resultValidate;
        }

        return JsonResponse::render(
            ResponseConstants::LEAP_YEAR_RESPONSE_CODE
        );
    }

    /**
     * Выполняет валидацию полей
     * @param $year
     * @return string|bool
     */
    private function validation($year): string|bool
    {
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

        return true;
    }

    #[Pure]
    /**
     * Проверка на високосный год
     * @param int $year
     * @return bool
     */
    private function isLeapYear(int $year): bool
    {
        return (bool) date(
            "L", mktime(0, 0, 0, 7, 7, $year)
        );
    }
}