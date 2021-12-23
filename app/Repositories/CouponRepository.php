<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CouponRepository
{
    protected $coupon;
    protected $role;
    protected $email;
    protected $companyId;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function setCompanyId($company)
    {
        $this->companyId = $company;
    }

    /**
     * Get all coupons with profile
     *
     * @return Coupon[]|\LaravelIdea\Helper\App\Models\_IH_Coupon_C
     */

    public function getAll()
    {
        return $this->coupon->get();
    }

    /**
     * Count coupons
     *
     * @return integer
     */

    public function count()
    {
        return $this->coupon->count();
    }

    /**
     * Count coupons registered between dates
     *
     * @return integer
     */

    public function countDateBetween($start_date, $end_date)
    {
        return $this->coupon->createdAtDateBetween(['start_date' => $start_date, 'end_date' => $end_date])->count();
    }

    /**
     * Find coupon by Id
     *
     * @param integer $id
     * @return User|User[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\LaravelIdea\Helper\App\Models\_IH_User_C|\LaravelIdea\Helper\App\Models\_IH_User_QB|\LaravelIdea\Helper\App\Models\_IH_User_QB[]
     */

    public function findOrFail($id = null)
    {
        $coupon = $this->coupon->find((int)$id);

        if (!$coupon || ($coupon->compnay_id !== $this->companyId)) {
            throw ValidationException::withMessages(['message' => trans('coupon.could_not_find'), 'back' => true]);
        }

        return $coupon;
    }

    /**
     * Paginate all todos using given params.
     *
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function paginate($params = array())
    {
        $sort_by = $params['sort_by'] ?? 'created_at';
        $order = $params['order'] ?? 'desc';
        $page_length = $params['page_length'] ?? config('config.page_length');
        $companyId = $this->companyId;

        $query = $this->coupon->where('company_id', $companyId);

        $query->orderBy($sort_by, $order);

        return $query->paginate($page_length);
    }

    public function create($params, $register = 0)
    {
        return $this->coupon->forceCreate($this->formatParams($params));
    }

    /**
     * Prepare given params for inserting into database.
     *
     * @param array $params
     * @param string $type
     * @return array
     */

    private function formatParams($params)
    {
        return [
            'company_id' => $this->companyId,
            'type' => $params['type'] ?? 1,
            'min_sum' => $params['min_sum'] ?? 0,
            'description' => $params['description'] ?? '-',
            'sale' => $params['sale'] ?? 0,
            'is_enabled' => $params['is_enabled'] ?? 0,
            'price_total' => $params['price_total'] ?? 0,
            'price_company' => $params['price_company'] ?? 0
        ];
    }

    /**
     * Update given coupon.
     *
     * @param Coupon $coupon
     * @param array $params
     *
     * @return Coupon
     */
    public function update(Coupon $coupon, $params = array())
    {
        $coupon->update($params);

        return $coupon;
    }

    /**
     * Delete coupon.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Coupon $coupon)
    {
        return $coupon->delete();
    }

    /**
     * Delete multiple coupons.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->coupon->whereIn('id', $ids)->delete();
    }
}
