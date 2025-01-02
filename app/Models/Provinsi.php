<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Provinsi extends Model
{
    protected $guarded = ['id'];
    protected $table = 'provinsi';
    public $timestamps = false;

    protected $casts = [
        'id'                => 'integer',
        'code'              => 'string',
        'name'              => 'string',
        'kabupaten_count'   => 'integer'
    ];

    public function scopeFilter($query, Request $request)
    {
        $filters = $request->only(['name', 'code', 'order_asc', 'order_desc']);
        $columns = ['id', 'name', 'code'];
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['code'])) {
            $query->where('code', $filters['code']);
        }
        if (isset($filters['order_asc']) && in_array($filters['order_asc'], $columns)) {
            $query->orderBy($filters['order_asc'], 'asc');
        }
        if (isset($filters['order_desc']) && in_array($filters['order_desc'], $columns)) {
            $query->orderBy($filters['order_desc'], 'desc');
        }
    }

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class);
    }
}
