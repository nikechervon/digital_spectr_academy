<?php

namespace App\Controllers;

use App\Constants\ResponseConstants;
use App\Exceptions\InputErrorException;
use App\Exceptions\NotLeapYearException;
use App\Renderable;
use JetBrains\PhpStorm\Pure;
use App\JsonResponse;

/**
 * Class MainController
 * @package App\Controllers
 */
class YearController
{
    /**
     * Проверяет введенные данные и возвращает ответ в формате JSON
     * @return string
     */
    public function check(): string
    {
        try {
            // Введенный год
            $year = htmlspecialchars($_POST['year']);

            // Валидация
            $this->validation($year);

            // Возвращает ответ
            return JsonResponse::render(
                ResponseConstants::LEAP_YEAR_RESPONSE_CODE
            );

        } catch (\ErrorException $e) {

            // Рендеринг исключения
            return $this->renderException($e);
        }
    }

    /**
     * Выполняет валидацию и выдает исключения
     * @param $year
     * @throws InputErrorException
     * @throws NotLeapYearException
     * @return void
     */
    private function validation($year): void
    {
        // Проверка, что строка состоит только из цифр
        if (preg_match("/[\D]/", $year) || empty($year)) {
            throw new InputErrorException();
        }

        // Проверка на високосный год
        if (!$this->isLeap((int) $year)) {
            throw new NotLeapYearException();
        }
    }

    /**
     * Возвращает исключение
     * @param \Exception $exception
     * @return mixed
     */
    private function renderException(\Exception $exception): mixed
    {
        if ($exception instanceof Renderable) {
            return $exception->render();
        }

        return $exception->getMessage();
    }

    #[Pure]
    /**
     * Проверка на високосный год
     * @param int $year
     * @return bool
     */
    private function isLeap(int $year): bool
    {
        return (bool)date(
            "L", mktime(0, 0, 0, 7, 7, $year)
        );
    }
}