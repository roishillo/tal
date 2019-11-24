<?php

namespace App\Repositories\Admin;

use League\Fractal;

class AdminTransformer extends Fractal\TransformerAbstract
{
    public static function transform($admin)
    {
        try {
            return [
                'id' => (int)$admin->id,
                'name' => (string)$admin->first_name,
                'email' => (string)$admin->email,
                'phone' => (string)$admin->phone,
            ];
        }
        catch (\Exception $exception) {
            return 'error';
        }
    }
}