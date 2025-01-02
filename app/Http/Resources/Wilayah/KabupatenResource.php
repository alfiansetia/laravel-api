<?php

namespace App\Http\Resources\Wilayah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KabupatenResource extends JsonResource
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
            'type'              => $this->type,
            'code'              => $this->code,
            'full_code'         => $this->full_code,
            'name'              => $this->name,
            'provinsi_id'       => $this->provinsi_id,
            'kecamatan_count'   => $this->when(
                isset($this->kecamatan_count),
                $this->kecamatan_count
            ),
            'provinsi'          => new ProvinsiResource($this->whenLoaded('provinsi'))
        ];
    }
}
