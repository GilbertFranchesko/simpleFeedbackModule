<?php

namespace App\Services;


class PhotosSerializer
{

    public static $homePath = "/upload/";

    public static function serialize($filePath)
    {
        $photoListData = array(
            "photos" => array(
                array("path" => PhotosSerializer::$homePath.$filePath)
            )
        );

        return $photoListData;
    }

}