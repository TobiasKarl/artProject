<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{    protected $guarded = [];

    public function user(){
        return $this -> belongsTo(User::class);
    }
    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/spfqnc1xEsJbLhuakJSzPdufApM34mITGfXV081w.png';
        return '/storage/' . $imagePath;
    }
    public function followers(){
        return $this -> belongsToMany(User::class)->orderBy('created_at','DESC');

    }


}
