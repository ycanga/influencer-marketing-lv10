<?php

namespace App\Http\Controllers\Traits;

class GeneralFunctionsTrait
{
    public function saveImage($image, $folderName)
    {
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images/'.$folderName), $imageName);
        return $imageName;
    }
}
