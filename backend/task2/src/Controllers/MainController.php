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
     * Searches for and returns an array of words starting with a prefix as JSON
     * @return string
     */
    public function searchWordsByPrefix(): string
    {
        $prefix = htmlspecialchars(trim($_POST['prefix']));

        if (empty($prefix)) {
            return JsonResponse::render(
                ResponseConstants::PREFIX_INPUT_ERROR_RESPONSE_CODE
            );
        }

        if (empty($_POST['words'])) {
            return JsonResponse::render(
                ResponseConstants::WORDS_INPUT_ERROR_RESPONSE_CODE
            );
        }

        // Array of words
        $words = explode(',', $_POST['words']);

        // An array of words starting with a prefix
        $result = $this->getWordsByPrefix($prefix, $words);

        return JsonResponse::render(
            ResponseConstants::GET_WORDS_RESPONSE_CODE,
            $result
        );
    }

    /**
     * Returns an array of words starting with a prefix
     * @param string $prefix
     * @param array $words
     * @return array
     */
    private function getWordsByPrefix(string $prefix, array $words): array
    {
        $filteredWords = array_filter($words, function ($word) use ($prefix) {
            $word = htmlspecialchars(trim($word));
            return str_starts_with($word, $prefix);
        });

        return array_values($filteredWords);
    }
}