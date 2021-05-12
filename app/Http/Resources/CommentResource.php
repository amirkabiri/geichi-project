<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);

        if(isset($data['sender_type'])){
            $types = [
                'App\\Models\\User' => 'user',
                'App\\Models\\Barber' => 'barber',
            ];
            $data['sender_type'] = $types[$data['sender_type']] ?? $data['sender_type'];
        }

        return $data;
    }
}
