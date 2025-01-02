<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    //
    protected $guarded = ['id'];
    protected $table = 'provinsi';
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class);
    }
}
