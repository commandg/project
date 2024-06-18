<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class HelperFunctions
{
    public static function deleteItem($model, $id)
    {
        $model::where('id', $id)->delete();

    }


}