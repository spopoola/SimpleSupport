<?php

namespace App\Http\Controllers\Account;

use App\Avatar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class AvatarController extends Controller
{
    protected $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function store()
    {
        $this->validate(request(), [
            'file' => 'required|image',
        ]);

        $path = request()->file('file')->store('avatars');

        $image = Avatar::create([
            'user_id' => auth()->user()->id,
            'path' => $path,
            'thumbnail' => $this->resize(request()->file, $path, 150, 150),
        ]);

        return response([
            'data' => [
                'id' => $image->id,
                'path' => $image->thumbnail(),
            ]
        ], 200);
    }

    private function resize($image, $path, $width = null, $height = null)
    {
        $new_path = str_replace(basename($path), $width . 'x' . $height . '_' . basename($path), $path);
        $this->imageManager->make($image)
            ->orientate()
            ->fit($width, $height, function ($c) {
                $c->aspectRatio();
            })
            ->save(storage_path('app/public') . '/' . $new_path);

        return $new_path;
    }
}
