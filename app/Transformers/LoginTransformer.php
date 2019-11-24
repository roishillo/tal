<?php

namespace App\Transformers;

use League\Fractal;

class LoginTransformer extends Fractal\TransformerAbstract
{
    public static function transform($token, $result)
    {

        try {
            return [
                'token' => (string)$token,
                'admin' => $result[0],
                'educands' => $result[1],
            ];
        }
        catch (\Exception $exception) {
            return 'error';
        }
    }
}