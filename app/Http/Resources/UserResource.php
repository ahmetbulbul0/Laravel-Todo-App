<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "id" => $this->id,
            "fullName" => Str::ucfirst($this->full_name),
            "username" => $this->username,
            "password" => $this->password,
            "email" => $this->email,
            "type" => $this->type
        ];
    }
}
