<?php

namespace App\Http\Resources\Wilayah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KelurahanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'                => $this->id,
            'code'              => $this->code,
            'full_code'         => $this->full_code,
            'name'              => $this->name,
            'pos_code'          => $this->pos_code,
            'kecamatan_id'      => $this->kecamatan_id,
            'kecamatan'         => new KecamatanResource($this->whenLoaded('kecamatan'))
        ];
    }
}
