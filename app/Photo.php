<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $path = '/img/users/';

    protected $fillable = ['file'];

    public function getFileAttribute($value){

        if(empty($value)){

            $value = 'default.png';
        }

        return $this->path . $value;
    }

    
}
