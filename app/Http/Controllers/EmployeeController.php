<?php

namespace App\Http\Controllers;

use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $request;
    protected $repo;

    public function __construct(Request $request, EmployeeRepository $repo)
    {
        $this->repo = $repo;
        $this->request = $request;
    }

    public function index()
    {
        $this->repo->setCompanyId(auth()->user()->company_id);
        $employees = $this->repo->paginate($this->request->all());
        return $this->ok($employees);
    }

    public function store(Request $request)
    {
        $this->repo->create($this->request->all());
        return $this->success(['message' => trans('employee.created')]);
    }

    public function show($id)
    {
        $employee = $this->repo->findOrFail($id);
        return $this->ok($employee);
    }


    public function tips($id, Request $request)
    {
        $tips = $this->repo->paginateTips($id, $this->request->all());
        return $this->ok($tips);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $employee = $this->repo->findOrFail($id);
        $this->repo->delete($employee);
        return $this->success(['message' => 'Сотрудник удалён']);
    }
}
