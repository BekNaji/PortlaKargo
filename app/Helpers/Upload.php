<?php 
/**
 * 
 */
namespace App\Helpers;
class Upload
{
	
	public function uploadImage($query,$path)
    {
        $img_name = rand(1111,9999);
        $ext     = strtolower($query->getClientOriginalExtension());
        $img_full_name = $img_name.'.'.$ext; // like  123213.jpg
        $upload_path = 'images/'.$path;
        $image_url = $upload_path.$img_full_name;
        $success = $query->move($upload_path,$img_full_name);

        return $image_url;

    }
}