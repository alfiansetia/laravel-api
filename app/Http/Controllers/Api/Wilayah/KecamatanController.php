<?php

namespace App\Http\Controllers\Api\Wilayah;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wilayah\KecamatanResource;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $limit = $this->get_limit($request);
        $data = Kecamatan::query()
            ->withCount('kelurahan')
            ->filter($request)
            ->paginate($limit)
            ->withQueryString();
        return KecamatanResource::collection($data);
    }

    public function show(string $id)
    {
        $data = Kecamatan::with('kabupaten.provinsi')->withCount('kelurahan')->find($id);
        if (!$data) {
            return $this->send_response_not_found();
        }
        return $this->send_response('', new KecamatanResource($data));
    }
}
