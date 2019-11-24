<?php

namespace App\Support;

//use Repositories\Pokemon\PokemonInterface;

use App\Models\Entities\Educand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiModelCheckService
{

    const MODEL_ARRAY = [
        'Educand' => 'eduncad not found'
    ];


    public function checkModel($model)
    {
       // dd($model);
        //return $request->route('educand');

    }
}