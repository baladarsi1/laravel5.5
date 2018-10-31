<?php

namespace App\Http\Controllers;
use App\Services\ImageService;
use App\Services\UserImageService;

use Illuminate\Http\Request;

use Validator;

class ImageController extends Controller
{
    private $userStoragePath = 'uploads';
    private $userUploadPath = 'images';

    /** @var  imageService */
    protected $imageService;

    /** @var  userImageService */
    protected $userImageService;

    public function __construct(ImageService $imageService, UserImageService $userImageService)
    {
        $this->imageService = $imageService;
        $this->userImageService = $userImageService;
    }

    public function store(Request $request)
    {
        try
        {
            if (count($request->images))
            {
                foreach ($request->images as $image)
                {
                    $uploadImage = $this->imageService->createImage($image,$this->userStoragePath,$this->userUploadPath);
                    $this->userImageService->createUserImage($request->user()->id,$uploadImage);
                }
            }

            return response()->json(['success' => 'You have successfully uploaded an image'], 200);
        }
        catch (\Exception $e)
        {
            \Log::error('user Image upload Errors' , [$e->getMessage()]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserImage($id)
    {
        return $this->userImageService->getUserImage($id)->image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserImage(Request $request, $id)
    {

        $image = $this->userImageService->getUserImage($id);
        $oldImageName = $image->image_name;
        $newImageName = $request->input('updatedImageName');
        try
        {
            $this->userImageService->updateUserImage($id,$newImageName);
            $this->imageService->editImage($this->getImagePath(),$oldImageName,$newImageName);

            return response()->json(['data' => 'You have successfully uploaded an image'], 200);
        }
        catch (\Exception $e)
        {
            \Log::error('update image' , [$e]);
            return response()->json(['error' => $e->getMessage()], 400);
        }

    }

    public function deleteUserImage(Request $request, $id)
    {
        try
        {
            $this->userImageService->deleteUserImage($id);

            return response()->json(['data' => 'You have successfully deleted an image'], 200);
        }
        catch (\Exception $e)
        {
            \Log::error('update image' , [$e]);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function shareImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'shareEmail' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => "Please enter a valid email address"], 400);
        }

        $imageShareEmail = $request->input('shareEmail');

        try
        {
            $this->userImageService->shareUserImage($id,$imageShareEmail);

            return response()->json(['data' => 'You have successfully shared an image'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 400);
        }


    }

}
