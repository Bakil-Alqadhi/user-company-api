<?php 

namespace App\Interfaces\Api\V1;

interface CommentRepositoryInterface  {
    public function getAllComments();
    public function storeComment($data);
    public function getCommentById($comment);
    public function updateComment($data, $comment);
}