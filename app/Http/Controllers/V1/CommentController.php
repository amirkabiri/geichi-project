<?php

namespace App\Http\Controllers\V1;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth:user,barber', ['only' => ['update', 'store']]);
    }

    public function index(Shop $shop){
        $this->authorize('viewAny', Comment::class);

        return $shop->comments()->paginate();
    }

    public function show(Shop $shop, Comment $comment){
        $this->authorize('view', $comment);

        if($shop->id !== $comment->shop_id){
            abort(404);
        }

        return $comment;
    }

    public function update(Shop $shop, Comment $comment, Request $request){
        $this->authorize('update', $comment);

        $request->validate([
            'score' => 'integer|min:1|max:5'
        ]);

        $comment->update($request->only('message', 'score'));

        return new CommentResource($comment);
    }

    public function store(Shop $shop, Request $request){
        $this->authorize('create', Comment::class);

        $guard = currentGuard();

        $request->validate([
            'message' => 'required',
            'score' => 'required|integer|min:1|max:5',
        ]);
        if($guard === 'barber'){
            $request->validate([
                'parent' => 'required|exists:comments,id',
            ]);
        }

        $sender = Auth::guard($guard)->user();
        $comment = $sender->comments()->save(new Comment([
            'shop_id' => $shop->id,
            'sender_id' => $sender->id,
            'message' => $request->message,
            'score' => $request->score,
            'parent' => $guard === 'barber' ? $request->parent : null,
        ]));

        return new CommentResource($comment);
    }

    public function destroy(Shop $shop, Comment $comment){
        $this->authorize('delete', $comment);

        $comment->delete();
    }
}
