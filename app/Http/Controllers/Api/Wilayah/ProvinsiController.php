<?php

namespace App\Http\Controllers\Api\Wilayah;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wilayah\ProvinsiResource;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function index(Request $request)
    {
        $limit = $this->get_limit($request);
        $data = Provinsi::query()
            ->withCount('kabupaten')
            ->filter($request)
            ->paginate($limit)
            ->withQueryString();
        return ProvinsiResource::collection($data);
    }


    public function show(string $id)
    {
        $data = Provinsi::withCount('kabupaten')->find($id);
        if (!$data) {
            return $this->send_response_not_found();
        }
        return $this->send_response('', new ProvinsiResource($data));
    }
}
