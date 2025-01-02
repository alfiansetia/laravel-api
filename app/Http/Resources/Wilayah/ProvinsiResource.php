<?php

namespace App\Http\Resources\Wilayah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinsiResource extends JsonResource
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
            'name'              => $this->name,
            'kabupaten_count'   => $this->when(
                isset($this->kabupaten_count),
                $this->kabupaten_count
            ),
        ];
    }
}
