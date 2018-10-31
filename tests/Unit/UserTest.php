<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use App\Services\ImageService;
use App\User;
use App\FileUpload;



class UserTest extends TestCase
{
    /** @var  imageService */
    protected $imageService;

    public function setUp() {

        parent::setUp();

        $this->imageService = $this->app->make('App\Services\ImageService');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAvatarUpload()
    {
        Storage::fake('public');
        $this->imageService->createImage(UploadedFile::fake()->image('random.jpg'),'random.jpg', storage_path().'/framework/testing/disks/public/');

        // Assert the file was stored...
        Storage::disk('public')->assertExists('random.jpg');

        // Assert a file does not exist...
        Storage::disk('public')->assertMissing('missing.jpg');
    }
}
