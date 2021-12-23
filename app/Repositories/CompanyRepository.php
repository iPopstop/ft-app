<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use LaravelIdea\Helper\App\Models\_IH_Company_C;

class CompanyRepository
{
    protected $company;
    protected $role;
    protected $email;
    protected $companyId;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function setCompanyId($company)
    {
        $this->companyId = $company;
    }

    /**
     * Get all companys with profile
     *
     * @return Company[]|_IH_Company_C
     */

    public function getAll()
    {
        return $this->company->where('company_id', $this->companyId)->get();
    }

    /**
     * Count companys
     *
     * @return integer
     */

    public function count()
    {
        return $this->company->count();
    }

    /**
     * Count companys registered between dates
     *
     * @return integer
     */

    public function countDateBetween($start_date, $end_date)
    {
        return $this->company->createdAtDateBetween(['start_date' => $start_date, 'end_date' => $end_date])->count();
    }

    /**
     * Find company by Id
     *
     * @param integer $id
     * @return _IH_Company_C|Builder[]|Company|\LaravelIdea\Helper\App\Models\_IH_User_QB[]|User[]
     */

    public function findOrFail($id = null)
    {
        $company = $this->company->with(['positions' => function ($p) {
            $p->withCount('employees');
        }])->find((int)$id);

        if (!$company) {
            throw ValidationException::withMessages(['message' => trans('company.could_not_find'), 'back' => true]);
        }

        return $company;
    }

    /**
     * Paginate all todos using given params.
     *
     * @param array $params
     * @return LengthAwarePaginator
     */

    public function paginate($params = array())
    {
        $sort_by = $params['sort_by'] ?? 'created_at';
        $order = $params['order'] ?? 'desc';
        $page_length = $params['page_length'] ?? config('config.page_length');
        $created_at_start_date = $params['created_at_start_date'] ?? null;
        $created_at_end_date = $params['created_at_end_date'] ?? null;

        $query = $this->company->createdAtDateBetween([
            'start_date' => $created_at_start_date,
            'end_date' => $created_at_end_date
        ]);

        if ($this->companyId) {
            $query->where('company_id', $this->companyId);
        }

        $query->orderBy($sort_by, $order);

        return $query->paginate($page_length);
    }

    /**
     * Create a new company.
     *
     * @param array $params
     * @return Todo
     */

    public function create($params, $register = 0)
    {
        return $this->company->forceCreate($this->formatParams($params, 'register'));
    }

    /**
     * Prepare given params for inserting into database.
     *
     * @param array $params
     * @param string $type
     * @return array
     */

    private function formatParams($params, $action = 'create')
    {
        $values = [
            'email' => $params['email'] ?? null,
            'first_name' => $params['first_name'] ?? null,
            'last_name' => $params['last_name'] ?? null,
            'middle_name' => $params['middle_name'] ?? null,
        ];

        return $values;
    }

    /**
     * Update given company.
     *
     * @param User $company
     * @param array $params
     *
     * @return User
     */
    public function update(Company $company, $params = array())
    {
        $company->update($params);
        return $company;
    }

    /**
     * Delete company.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Company $company)
    {
        return $company->delete();
    }

    /**
     * Delete multiple companys.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->company->whereIn('id', $ids)->delete();
    }
}
