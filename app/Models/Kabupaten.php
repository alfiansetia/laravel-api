<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Kabupaten extends Model
{
    //
    protected $guarded = ['id'];
    protected $table = 'kabupaten';
    public $timestamps = false;

    protected $casts = [
        'id'                => 'integer',
        'code'              => 'string',
        'full_code'         => 'string',
        'type'              => 'string',
        'name'              => 'string',
        'provinsi_id'       => 'integer',
        'kecamatan_count'   => 'integer'
    ];

    public function scopeFilter($query, Request $request)
    {
        $filters = $request->only(['name', 'type', 'full_code', 'provinsi_id', 'code', 'order_asc', 'order_desc']);
        $columns = ['id', 'name', 'code', 'full_code', 'provinsi_id', 'type'];
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }
        if (isset($filters['code'])) {
            $query->where('code', $filters['code']);
        }
        if (isset($filters['full_code'])) {
            $query->where('full_code', $filters['full_code']);
        }
        if (isset($filters['provinsi_id'])) {
            $query->where('provinsi_id', $filters['provinsi_id']);
        }
        if (isset($filters['order_asc']) && in_array($filters['order_asc'], $columns)) {
            $query->orderBy($filters['order_asc'], 'asc');
        }
        if (isset($filters['order_desc']) && in_array($filters['order_desc'], $columns)) {
            $query->orderBy($filters['order_desc'], 'desc');
        }
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }
}
