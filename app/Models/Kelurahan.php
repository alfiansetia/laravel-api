<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Kelurahan extends Model
{
    //
    protected $guarded = ['id'];
    protected $table = 'kelurahan';
    public $timestamps = false;

    protected $casts = [
        'id'            => 'integer',
        'code'          => 'string',
        'full_code'     => 'string',
        'pos_code'      => 'string',
        'name'          => 'string',
        'kecamatan_id'  => 'integer',
    ];

    public function scopeFilter($query, Request $request)
    {
        $filters = $request->only(['name', 'code', 'full_code', 'pos_code', 'kecamatan_id', 'order_asc', 'order_desc']);
        $columns = ['id', 'name', 'code', 'full_code', 'pos_code', 'kecamatan_id'];
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (isset($filters['code'])) {
            $query->where('code', $filters['code']);
        }
        if (isset($filters['full_code'])) {
            $query->where('full_code', $filters['full_code']);
        }
        if (isset($filters['pos_code'])) {
            $query->where('pos_code', $filters['pos_code']);
        }
        if (isset($filters['kecamatan_id'])) {
            $query->where('kecamatan_id', $filters['kecamatan_id']);
        }
        if (isset($filters['order_asc']) && in_array($filters['order_asc'], $columns)) {
            $query->orderBy($filters['order_asc'], 'asc');
        }
        if (isset($filters['order_desc']) && in_array($filters['order_desc'], $columns)) {
            $query->orderBy($filters['order_desc'], 'desc');
        }
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
