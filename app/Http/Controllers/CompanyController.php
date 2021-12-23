<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $request;
    protected $repo;

    public function __construct(Request $request, CompanyRepository $repo)
    {
        $this->repo = $repo;
        $this->request = $request;
    }

    public function index()
    {
        //
    }

    public function settings()
    {
        $info = $this->repo->findOrFail(auth()->user()->company_id);
        return $this->ok(compact('info'));
    }

    public function setSettings()
    {
        $info = $this->repo->findOrFail(auth()->user()->company_id);
        $this->repo->update($info, $this->request->all());

        return $this->success(['message' => trans('settings.updated')]);
    }
}
