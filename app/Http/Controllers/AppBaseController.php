<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Intervention\Image\Facades\Image;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

    // function for create image
    public function createImage($img_request, $img, $folder){
        if($img_request){
            // Filename with extension
            $filenameWithExt = $img->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $img->getClientOriginalExtension();
            // Filename to store
            $filenameToStor = $filename.'_'.time().'.'.$extension;
            //remove space if exist
            $filenameToStore = str_replace(' ','_', $filenameToStor);
            // resize image and save in folder
            $images = $img;
            Image::make($images)->resize(500, null, function ($constraint){$constraint->aspectRatio();})->save( public_path('/storage/' . $folder . '/' . $filenameToStore ) );

        } else {
            $filenameToStore = 'default.png';
        }

        return $filenameToStore;
    }

    // function for update images
    public function updateImage($img_request, $img, $folder){
        if($img_request){
            // Filename with extension
            $filenameWithExt = $img->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $img->getClientOriginalExtension();
            // Filename to store
            $filenameToStor = $filename.'_'.time().'.'.$extension;
            //remove space if exist
            $filenameToStore = str_replace(' ','_', $filenameToStor);
            // resize image and save in folder
            $images = $img;
            Image::make($images)->resize(500, null, function ($constraint){$constraint->aspectRatio();})->save( public_path('/storage/' . $folder . '/' . $filenameToStore ) );

        }
        return $filenameToStore;
    }
}
