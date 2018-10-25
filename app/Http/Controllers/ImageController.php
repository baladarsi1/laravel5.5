<?php

namespace App\Http\Controllers;
use App\Services\ImageService;
use App\Services\UserImageService;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $userUploadPath = 'images/';

    /** @var  imageService */
    protected $imageService;

    /** @var  userImageService */
    protected $userImageService;

    public function __construct(ImageService $imageService, UserImageService $userImageService)
    {
        $this->imageService = $imageService;
        $this->userImageService = $userImageService;
    }

    private function getImagePath()
    {
        return public_path($this->userUploadPath);
    }

    public function store(Request $request)
    {
        try
        {
            if($request->get('image'))
            {
                $image = $request->get('image');
                $imageName = getImageNameFromBrowserRequest($image);
                $this->imageService->createImage($request->get('image'),$imageName,$this->getImagePath());
                $this->userImageService->createUserImage($request->user()->id,$imageName);
            }

            return response()->json(['success' => 'You have successfully uploaded an image'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getUserImages(Request $request)
    {
        try
        {
            return $this->userImageService->getAllUserImages($request->user());
        }
        catch (\Exception $e)
        {
            \Log::error('user Image Errors' , [$e->getMessage()]);
        }
    }


}
