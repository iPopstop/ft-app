<?php

namespace App\Http\Controllers;

use App\Repositories\PositionRepository;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected $request;
    protected $repo;

    public function __construct(Request $request, PositionRepository $repo)
    {
        $this->repo = $repo;
        $this->request = $request;
    }

    public function index()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function list()
    {
        $this->repo->setCompanyId(auth()->user()->company_id);
        $list = $this->repo->getAll();
        return $this->ok($list);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
