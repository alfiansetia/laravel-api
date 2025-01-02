<?php

namespace App\Http\Resources\Wilayah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KecamatanResource extends JsonResource
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
            'kabupaten_id'      => $this->kabupaten_id,
            'kelurahan_count'   => $this->when(
                isset($this->kelurahan_count),
                $this->kelurahan_count
            ),
            'kabupaten'          => new KabupatenResource($this->whenLoaded('kabupaten'))
        ];
    }
}
