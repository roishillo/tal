<?php

namespace App\Support;

class ApiErrorCodes
{
    const UNKNOWN_ERROR = -1;

    const ALL_ERRORS = [
        'LOGIN_ERRORS' => [
            'INVALID_CREDENTIALS'    => 1001,
            'INVALID_TOKEN'          => 1002,
            'UNKNOWN_ERROR'          => 1005,
        ],
        'EDUCANDS_ERRORS' => [
            'INVALID_EDUCAND_ID' => 1003,
            'EDUCANT_WITHOUT_TRACK' => 1004,
            'INVALID_TASK_ID' => 1006
        ]
    ];

    public static function getError($category, $name): int
    {
        return self::ALL_ERRORS[$category][$name] ?? self::UNKNOWN_ERROR;
    }
}