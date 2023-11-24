<?php 
namespace App\Repositories\Api\V1;

use App\Interfaces\Api\V1\CommentRepositoryInterface;
use App\Models\Comment;
use App\Http\Resources\Api\V1\CommentResource;


class CommentRepository implements CommentRepositoryInterface  {

    public function getAllComments(){
        // return CommentResource::collection(Comment::all());
        return Comment::paginate(5);
    }

    public function storeComment($data){
        $comment = Comment::create($data);

        return new CommentResource($comment);
    }

    public function getCommentById($comment) {
        return new CommentResource($comment);
    }

    public function updateComment($data, $comment) {

        $comment->fill($data);
        $comment->save();
        return new CommentResource($comment);
        
    }

}