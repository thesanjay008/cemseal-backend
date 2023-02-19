<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DasboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'				=> (string)$this->id,
            'custom_order_id'	=> (string)$this->custom_order_id,
            'table_id'			=> (string)$this->table_id,
            'status'			=> (string)$this->status,
        ];
    }
}
