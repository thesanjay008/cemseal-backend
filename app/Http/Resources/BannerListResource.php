<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerListResource extends JsonResource
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
            'id'		=> (string)$this->id,
            'title'		=> (string)$this->title,
			'image'		=> $this->image ? asset($this->image) : '',
			'time'		=> $this->timimg ? (string)$this->timimg : '5',
        ];
    }
}
