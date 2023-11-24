<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Api\V1\UserResource;
use App\Http\Resources\Api\V1\CompanyResource;


class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($request->is('api/v1/comments') || $request->is('api/v1/comments/*')){
            return [
                'id' => $this->id,
                'content' => $this->content,
                'rating' => $this->rating,
                'user' => new UserResource($this->user),
                'company' => new CompanyResource($this->company),
            ];
        }  else {
            return [
                'id' => $this->id,
                'content' => $this->content,
                'rating' => $this->rating,
                'user' => new UserResource($this->user),
            ];
        }
       
    }
    public function with(Request $request)
    {
        return [
            'pagination' => [
                'total' => $this->resource->total(),
                'count' => $this->resource->count(),
                'per_page' => $this->resource->perPage(),
                'current_page' => $this->resource->currentPage(),
                'total_pages' => $this->resource->lastPage(),
            ],
        ];
    }
}
