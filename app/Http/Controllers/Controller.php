<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // move upload file
    public function moveUploadFile($file) {
        $thumbnail = rand(1,999).'-'.$file->getClientOriginalName();
        $path = 'uploads';
        $file->move($path, $thumbnail);
        return $thumbnail;
    }
}
