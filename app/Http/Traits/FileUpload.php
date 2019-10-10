<?php
namespace App\Http\Traits;

trait FileUpload {

    public function imageUpload($folderName, $file, $fileName,$old_icon_link = null){
        if($old_icon_link){
            $this->deleteOldImage($folderName,$old_icon_link);
        }
        $file->move(public_path($folderName), $fileName);
        $filePath = env('APP_URL').'/'.$folderName.'/'.$fileName;
        return $filePath;
    }

    public function deleteOldImage($folderName,$old_icon_link){
        $link_array = explode('/',$old_icon_link);
        $icon_name = end($link_array);
        $path = public_path()."/".$folderName."/".$icon_name;
        if(file_exists( $path))
            unlink($path);
    }
}