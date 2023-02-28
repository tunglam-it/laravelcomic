<?php

namespace App\Components;

use Illuminate\Support\Facades\File;

class HandleImage
{
    public function uploadImage($request, $fieldName, $folderName)
    {
        if($request->hasFile($fieldName)){
            $image = $request->$fieldName;
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move('storage/uploads/'.$folderName.'/',$name);
            return $name;
        }
        return null;
    }

    //$model là tên ảnh đc lưu trong db bảng comic
    public function removeImage($request, $folderName, $model)
    {
        $path = public_path('storage/uploads/'.$folderName.'/'.$model);
        if(File::exists($path)){
            unlink($path);
        }
    }
}
