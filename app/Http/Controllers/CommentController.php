<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Tip;
use App\Models\User;
use App\Repositories\CommentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    protected $request;
    protected $repo;

    public function __construct(Request $request, CommentRepository $repo)
    {
        $this->repo = $repo;
        $this->request = $request;
    }

    public function index()
    {
        $this->repo->registerEmployee(auth()->user());
        $info = $this->repo->paginate($this->request->all());
        $plus = $this->repo->countPlus();
        $minus = $this->repo->countMinus();
        return $this->ok(compact('info', 'plus', 'minus'));
    }

    public function store(Request $request)
    {
        if (!$request->has('message') || (mb_strlen($request->get('message')) < 2)) {
            return view('problem.comment');
        }
        $params = $this->request->all();
        $tip = null;
        if ($request->has('tip_id')) {
            $tip = Tip::find((int)$request->tip_id);
            $params['employee_id'] = $tip->employee_id;
        }
        $comment = $this->repo->create($params);
        $tip?->update(['comment_id' => $comment->id]);
        return view('success.comment');
    }

    public function show($id)
    {
        $comment = $this->repo->findOrFail($id);
        return $this->ok($comment);
    }

    public function reply($id, Request $request)
    {
        $comment = $this->repo->findOrFail($id);
        $user = User::find($comment->user_id);
        if (!$user || !$user->email) {
            return $this->error(['message' => trans('comment.no_email')]);
        }
        $reply = $this->repo->reply($comment, $this->request->all());
        // Здесь должна быть отправка на почту, но мы не успели
        //Mail::to($comment->email)->send();
        return $this->success(['message' => trans('comment.replied')]);
    }

    public function destroy($id)
    {
        $comment = $this->repo->findOrFail($id);
        $this->repo->delete($comment);
        $this->success(['message' => trans('comment.deleted')]);
    }
}
