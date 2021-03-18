<?php

namespace App;

/**
 * Class JsonResponse
 * @package App
 */
class JsonResponse
{
    /**
     * Render json
     * @param $result
     * @param $data
     * @param int $status
     * @return string
     */
    public static function render($result, $data = '', $status = 200): string
    {
        return json_encode([
            'status' => $status,
            'result' => $result,
            'data' => $data,
        ]);
    }
}