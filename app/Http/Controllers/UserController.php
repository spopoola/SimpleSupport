<?php

namespace App\Http\Controllers;

use App\Models\Account\Avatar;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use LasseRafn\InitialAvatarGenerator\InitialAvatar;

class UserController extends Controller
{
    public function index()
    {
        return fractal(User::orderBy('first_name', 'ASC')->get(), new UserTransformer)->toArray();
    }

    public function show(User $user)
    {
        return fractal($user, new UserTransformer)->toArray();
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
            ],
            'password' => 'required|confirmed|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $user = User::create(request()->only('email', 'password', 'first_name', 'last_name', 'job_title', 'mobile', 'signature'));

        return [
            "success" => "You have created " . str_plural($user->full_name) . " user!",
            "data" => [
                "user" => $user,
            ]
        ];
    }

    public function update(User $user)
    {
        $this->validate(request(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')
                    ->ignore($user->id)
            ],
            'password' => 'nullable|confirmed|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        if (!empty(request('password'))) {
            $user->password = bcrypt(request('password'));
            $user->save();
        }

        $user->update(request()->only('email', 'first_name', 'last_name', 'job_title', 'mobile', 'signature'));

        return [
            "success" => "You have updated " . str_plural($user->full_name) . " user!",
            "data" => [
                "user" => $user,
            ]
        ];
    }

    public function updateStatus(User $user)
    {
        $this->validate(request(), [
            'status' => 'required',
        ]);

        $user->update(request()->only('status'));

        return ["success" => str_plural($user->full_name) . " is now " . ($user->status ? 'enabled' : 'disabled') . "."];
    }

    public function updateProfile()
    {
        $user = auth()->user();

        $this->validate(request(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id)
            ],
            'password' => 'nullable|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar_id' => 'nullable',
        ]);

        if (request()->has('password')) {
            $user->update(['password' => bcrypt(request('password'))]);
        }

        if (request()->avatar_id !== null) {
            Avatar::where('user_id', $user->id)
                ->where('id', '!=', request()->avatar_id)
                ->get()
                ->each(function ($avatar) {
                    Storage::delete([
                        $avatar->path,
                        $avatar->thumbnail,
                    ]);
                    $avatar->delete();
                });
        }

        $user->update(request()->only('email', 'first_name', 'last_name', 'job_title', 'mobile', 'avatar_id'));

        return ['success' => 'Your profile has been updated!'];
    }

    public function avatar(User $user)
    {
        $avatar = new InitialAvatar();
        $image = $avatar->name($user->full_name)->size(150)->background('#005cb8')->cache()->generate();
        
        return $image->stream('png', 100);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return ["success" => "You have deleted " . str_plural($user->full_name) . " user!"];
    }
}
