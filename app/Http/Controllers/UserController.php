<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createAccount(Request $request){
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['regex:/^0[1-9][0-9]{7,8}$/'],
            'type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if(request('cropedImage') != null){
            $base64 = explode(',', request('cropedImage'))[1];
            $image = base64_decode($base64);
            $photo = imagecreatefromstring($image);

            $name=time().$request->first_name.'_'.$request->last_name.'_profile_pic.png';
            $destinationPath='img/'.$name;
            imagepng($photo, $destinationPath, 9);
            $photo='img/'.$name;
        }else{
            if ($request->sex == 'Female'){
                $photo = 'img/woman_profile_icon.png';
            }
            else{
                $photo = 'img/man_profile_icon.png';
            }
        }

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'photo' => $photo,
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/trainer/dashboard');
    }

    public function submitImage(Request $request, $id)
    {
        if($request->cropedImage != null){
            $base64 = explode(',', request('cropedImage'))[1];
            $image = base64_decode($base64);
            $photo = imagecreatefromstring($image);

            $name=time().$request->first_name.'_'.$request->last_name.'_profile_pic.png';
            $destinationPath='img/'.$name;
            imagepng($photo, $destinationPath, 9);
            $photo='img/'.$name;
        }

        $user = User::find($id);

        $user->photo = $photo;

        $user->save();

        return back();
    }
}
