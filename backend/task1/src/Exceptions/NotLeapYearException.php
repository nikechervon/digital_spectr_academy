<?php

namespace App\Exceptions;

use App\Constants\ResponseConstants;
use App\JsonResponse;
use App\Renderable;

/**
 * Class InputErrorException
 * @package App\Exceptions
 */
class NotLeapYearException extends \ErrorException implements Renderable
{
    /**
     * @return string
     */
    public function render(): string
    {
        return JsonResponse::render(
            ResponseConstants::NOT_LEAP_YEAR_RESPONSE_CODE
        );
    }
}