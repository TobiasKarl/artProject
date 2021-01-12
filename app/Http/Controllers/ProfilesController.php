<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
class ProfilesController extends Controller
{
    public function index($user)
    {   if(is_numeric($user)){
        $user = \App\Models\User::findOrFail($user);

    }else{
        $ids = \App\Models\User::select('id')->where('username', $user)->first();
        if($ids== null) {

            return redirect('/')
                           ->withErrors([['msg' => 'Could not find user, please try again!']])
                           ->withInput();
        }
        dd($ids);

        $user =    \App\Models\User::findOrFail($ids);

    }
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(2),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(2),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(2),
            function () use ($user) {
                return $user->following->count();
            });

        
        
        return view('profiles.index', [
        'user'=> $user,
        'follows'=> $follows,
        'postCount'=> $postCount,
        'followersCount'=> $followersCount,
        'followingCount'=> $followingCount,
        ]);
    }

    public function index3(Request $request)
    {
        $category = $request->input('category');
    
        //now get all user and services in one go without looping using eager loading
        //In your foreach() loop, if you have 1000 users you will make 1000 queries
        
        
      if(is_numeric($category)){
        return redirect('/')
        ->withErrors([['msg' => 'Could not find user, please try again!']])
        ->withInput();
    }else{
        $ids =\App\Models\User::select('id')->where('username', $category)->first();
        if($ids== null) {

            return redirect('/')
                           ->withErrors([['msg' => 'Could not find user, please try again!']])
                           ->withInput();
        }


        $user =    \App\Models\User::findOrFail($ids)->first();

    }
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });

        
        
        return view('profiles.index', [
        'user'=> $user,
        'follows'=> $follows,
        'postCount'=> $postCount,
        'followersCount'=> $followersCount,
        'followingCount'=> $followingCount,
        ]);
    }

    public function edit(\App\Models\User $user)
    {$this->authorize('update', $user -> profile);
        return view('profiles.edit',compact('user'));
    }
    public function update(\App\Models\User $user)
    {
        $this->authorize('update', $user -> profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);
        
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}