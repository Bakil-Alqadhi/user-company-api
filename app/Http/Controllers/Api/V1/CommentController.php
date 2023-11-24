<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Api\V1\CommentRepositoryInterface;

use App\Models\Comment;
use App\Http\Resources\Api\V1\CommentResource;
use App\Http\Requests\Api\V1\CommentRequest;



class CommentController extends Controller
{
    private CommentRepositoryInterface  $commentRepository;
    public function __construct(CommentRepositoryInterface  $commentRepository)
    {

        $this->commentRepository = $commentRepository;
    }

    public function index() 
    {
        return response()->json(
            [
                'data' => $this->commentRepository->getAllComments()
            ],
            200
        );
    }
    
    
    public function store(CommentRequest $request) 
    {
       

        return response()->json(
            [
                'data' => $this->commentRepository->storeComment($request->validated())
            ],
            201
        );
        
    }

    public function show(Comment $comment) 
    {
        return response()->json(
            [
                'data' => $this->commentRepository->getCommentById($comment)
            ],
            200
        );

    }

    public function update(CommentRequest $request, Comment $comment)
    {
        
        try {
            return response()->json(
                [
                    'message' => "Comment's data updated successfully",
                    'data' => $this->commentRepository->updateComment($request->validated(), $comment)
                ],
                200
            );
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);   
        }     
    }

    public function destroy(Comment $comment)
    {
        try{
            $comment->delete();

            return response()->json(['message' => 'Comment deleted successfully'], 200);
        } catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);   
        }
    }
}
