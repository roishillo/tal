<?php

namespace App\Models\Transformers;

//use App\Support\Duration;
use Illuminate\Support\Collection;
use League\Fractal;

abstract class BaseTransformerAbstract extends Fractal\TransformerAbstract
{
//    abstract public function transform($item): array;
//
    protected function date($date): string
    {
        return empty($date) ? '' : date(DATE_ISO8601, strtotime($date));
    }
//
////    protected function duration($duration): int
////    {
////        return empty($duration) ? 0 : (new Duration($duration))->getAllSeconds();
////    }
//
//    protected function transformChild($item, string $transformerClass, ...$data): array
//    {
//        $transformer = new $transformerClass();
//
//        if ($item instanceof Collection) {
//            return $item->map(function ($item) use ($transformer, $data) {
//                $params = array_merge([$item], $data);
//
//                return call_user_func_array([$transformer, 'transform'], $params);
//            })->toArray();
//        } else {
//            $params = array_merge([$item], $data);
//
//            return call_user_func_array([$transformer, 'transform'], $params);
//        }
//    }
//
//    protected function roundFloat($number)
//    {
//        return $number ? round($number, 2) : null;
//    }
}