<?php

namespace App\Http\Controllers\Traits;

class GeneralFunctionsTrait
{
    public function saveImage($image, $folderName)
    {
        $imageName = time().'.'.$image->extension();
        $image = $image->move(public_path('images/'.$folderName), $imageName);
        return $imageName;
    }

    public function updateUserAvatar($user, $image)
    {
        $imageName = $this->saveImage($image, 'user-avatar');
        $user->photo = 'images/user-avatar/'.$imageName;
        $user->save();

        return true;
    }
}
