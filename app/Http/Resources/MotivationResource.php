<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MotivationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'motivation' => $this->motivation,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
        ];
    }

    public function motivations($request)
    {
        return [

            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'role' => $this->role,
            'job' => $this->job,
            'motivation' => $this->motivation,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
            # code...
        ];
    }
    public function motivation($request)
    {
        return [

            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'role' => $this->role,
            'job' => $this->job,
            'motivation' => $this->motivation,
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
            # code...
        ];
    }
}
