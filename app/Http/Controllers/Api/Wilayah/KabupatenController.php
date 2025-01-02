<?php

namespace App\Http\Controllers\Api\Wilayah;

use App\Http\Controllers\Controller;
use App\Http\Resources\Wilayah\KabupatenResource;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function index(Request $request)
    {
        $limit = $this->get_limit($request);
        $data = Kabupaten::query()
            ->withCount('kecamatan')
            ->filter($request)
            ->paginate($limit)
            ->withQueryString();
        return KabupatenResource::collection($data);
    }

    public function show(string $id)
    {
        $data = Kabupaten::with('provinsi')->withCount('kecamatan')->find($id);
        if (!$data) {
            return $this->send_response_not_found();
        }
        return $this->send_response('', new KabupatenResource($data));
    }
}
