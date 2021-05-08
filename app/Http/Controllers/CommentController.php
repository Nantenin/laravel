<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Comment;
use App\Notifications\NewCommentPosted;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Subject $subject){
        request()->validate([
            'content' => 'required|min:5'
        ]);

        $comment = new Comment();
        $comment->content = request('content');
        $comment->user_id = auth()->user()->id;

        $subject->comments()->save($comment);

        //Notification
        $subject->user->notify(new NewCommentPosted($subject, auth()->user()));

        return redirect()->route('subjects.show', $subject);
    }

    public function storeCommentReplay(Comment $comment){
       request()->validate([
           'replayComment' => 'required|min:3'
       ]);

       $commentReplay = new Comment;
       $commentReplay->content = request('replayComment');
       $commentReplay->user_id = auth()->user()->id;

       $comment->comments()->save($commentReplay);

       return redirect()->back();
    }

    public function markedAsSolution(Subject $subject, Comment $comment)
    {
        if (auth()->user()->id === $subject->user_id) {

            $subject->solution = $comment->id;
            $subject->save();

            return response()->json(['success' => ['success' => 'Marqué comme solution']], 200);

        } else {
            return response()->json(['errors' => ['error' => 'Utilisateur non valide']], 401);
        }
    }
}
