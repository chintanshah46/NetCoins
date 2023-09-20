<?php

namespace App\Helpers;

use Ramsey\Uuid\Uuid;

class Helper{

    public static function generateUUID(){
        return Uuid::uuid4()->toString();
    }

}