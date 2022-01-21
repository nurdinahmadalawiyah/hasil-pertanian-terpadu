<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KolamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_ikan' => $this->nama_ikan,
            'deskripsi_ikan' => $this->deskripsi_ikan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
