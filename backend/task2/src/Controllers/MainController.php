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
     * Ищет и возвращает массив слов, начинающихся с префикса, в формате JSON.
     * @return string
     */
    public function searchWordsByPrefix(): string
    {
        $prefix = htmlspecialchars(trim($_POST['prefix']));

        // Результат валидации
        $resultValidate = $this->validation($prefix, $_POST['words']);

        // Если есть ошибки, возвращаем
        if (is_string($resultValidate)) {
            return $resultValidate;
        }

        // Массив слов
        $words = explode(',', $_POST['words']);

        // Массив слов, начинающийся с префикса
        $filteredWords = $this->getWordsByPrefix($prefix, $words);

        return JsonResponse::render(
            ResponseConstants::SUCCESS_RESPONSE_CODE,
            $filteredWords
        );
    }

    /**
     * Выполняет валидацию полей
     * @param string $prefix
     * @param string $words
     * @return string|bool
     */
    private function validation(string $prefix, string $words): string|bool
    {
        // Проверка на пустое поле префикса
        if (empty($prefix)) {
            return JsonResponse::render(
                ResponseConstants::PREFIX_INPUT_ERROR_RESPONSE_CODE
            );
        }

        // Проверка на пустое поле для ввода слов
        if (empty($words)) {
            return JsonResponse::render(
                ResponseConstants::WORDS_INPUT_ERROR_RESPONSE_CODE
            );
        }

        return true;
    }

    /**
     * Возвращает массив слов, начинающихся с префикса
     * @param string $prefix
     * @param array $words
     * @return array
     */
    private function getWordsByPrefix(string $prefix, array $words): array
    {
        // Callback фильтрации
        $callback = function ($word) use ($prefix) {
            $word = htmlspecialchars(
                trim($word)
            );
            return mb_stripos($word, $prefix) === 0;
        };

        // Массив отфильтрованных слов
        $filteredWords = array_filter($words, $callback);
        return array_values($filteredWords);
    }
}