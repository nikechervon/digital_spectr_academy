<?php

namespace App\Constants;

/**
 * Class ResponseConstants
 * @package App\Constants
 */
final class ResponseConstants
{
    // Response code if prefix field is empty
    const PREFIX_INPUT_ERROR_RESPONSE_CODE = 1001;

    // Response code if words field is empty
    const WORDS_INPUT_ERROR_RESPONSE_CODE = 1002;

    // Response code if all fields is not empty
    const GET_WORDS_RESPONSE_CODE = 1003;
}