<?php

namespace App\Http\Controllers\Api\Wilayah;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wilayah\KelurahanResource;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    public function index(Request $request)
    {
        $limit = $this->get_limit($request);
        $data = Kelurahan::query()
            ->filter($request)
            ->paginate($limit)
            ->withQueryString();
        return KelurahanResource::collection($data);
    }

    public function show(string $id)
    {
        $data = Kelurahan::with('kecamatan.kabupaten.provinsi')->find($id);
        if (!$data) {
            return $this->send_response_not_found();
        }
        return $this->send_response('', new KelurahanResource($data));
    }
}
