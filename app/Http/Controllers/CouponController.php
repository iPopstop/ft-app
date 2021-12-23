<?php

namespace App\Http\Controllers;

use App\Repositories\CouponRepository;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $request;
    protected $repo;

    public function __construct(Request $request, CouponRepository $repo)
    {
        $this->repo = $repo;
        $this->request = $request;
    }

    public function index()
    {
        $this->repo->setCompanyId(auth()->user()->company_id);
        $coupons = $this->repo->paginate($this->request->all());
        return $this->ok($coupons);
    }

    public function store(Request $request)
    {
        $this->repo->setCompanyId(auth()->user()->company_id);
        $this->repo->create($this->request->all());
        return $this->success(['message' => trans('coupon.created')]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $this->repo->setCompanyId(auth()->user()->company_id);
        $coupon = $this->repo->findOrFail($id);
        $this->repo->delete($coupon);
        return $this->success(['message' => trans('coupon.deleted')]);
    }
}
