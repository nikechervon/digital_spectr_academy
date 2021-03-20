<?php

namespace App\Controllers;

use App\Constants\ResponseConstants;
use App\JsonResponse;

/**
 * Class MainController
 * @package App\Controllers
 */
class MainController
{
    /**
     * Возвращает строку ответа с кол-вом смузи, которые выпил каждый хипстер,
     * в формате JSON.
     * @return string
     */
    public function getSmoothiesCountForHipsters(): string
    {
        $hipstersCount = (int) htmlspecialchars($_POST['hipstersCount']);
        $smoothiesCount = (int) htmlspecialchars($_POST['smoothiesCount']);

        // Результат валидации
        $resultValidate = $this->validation($hipstersCount, $smoothiesCount);

        // Если есть ошибки, возвращаем
        if (is_string($resultValidate)) {
            return $resultValidate;
        }

        // Кол-во смузи для одного хипстера
        $smoothiesCountForHipster = floor($smoothiesCount / $hipstersCount);

        return JsonResponse::render(
            ResponseConstants::SUCCESS_RESPONSE_CODE,
            $smoothiesCountForHipster
        );
    }

    /**
     * Выполняет валидацию полей
     * @param int $hipstersCount
     * @param int $smoothiesCount
     * @return string|bool
     */
    private function validation(int $hipstersCount, int $smoothiesCount): string|bool
    {
        // Если не указано кол-во хипстеров
        if (empty($hipstersCount)) {
            return JsonResponse::render(
                ResponseConstants::HIPSTERS_INPUT_EMPTY_RESPONSE_CODE
            );
        }

        // Если указаны недопустимые символы в поле хипстеров
        if ($this->checkStringForForbiddenCharacters($hipstersCount)) {
            return JsonResponse::render(
                ResponseConstants::HIPSTERS_INPUT_ERROR_RESPONSE_CODE
            );
        }

        // Если не указано кол-во смузи
        if (empty($smoothiesCount)) {
            return JsonResponse::render(
                ResponseConstants::SMOOTHIES_INPUT_EMPTY_RESPONSE_CODE
            );
        }

        // Если указаны недопустимые символы в поле смузи
        if ($this->checkStringForForbiddenCharacters($smoothiesCount)) {
            return JsonResponse::render(
                ResponseConstants::SMOOTHIES_INPUT_ERROR_RESPONSE_CODE
            );
        }

        return true;
    }

    /**
     * Проверяет строку на запрещенные символы
     * @param string $string
     * @return bool
     */
    private function checkStringForForbiddenCharacters(string $string): bool
    {
        return preg_match("/[\D]/", $string);
    }
}