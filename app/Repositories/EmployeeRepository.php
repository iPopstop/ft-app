<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class EmployeeRepository
{
    protected $employee;
    protected $role;
    protected $email;
    protected $companyId;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function setCompanyId($company)
    {
        $this->companyId = $company;
    }

    /**
     * Get all employees with profile
     *
     * @return Employee[]|\LaravelIdea\Helper\App\Models\_IH_Employee_C
     */

    public function getAll()
    {
        return $this->employee->get();
    }

    /**
     * Count employees
     *
     * @return integer
     */

    public function count()
    {
        return $this->employee->count();
    }

    /**
     * Count employees registered between dates
     *
     * @return integer
     */

    public function countDateBetween($start_date, $end_date)
    {
        return $this->employee->createdAtDateBetween(['start_date' => $start_date, 'end_date' => $end_date])->count();
    }

    /**
     * Find employee by Id
     *
     * @param integer $id
     * @return Employee|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\LaravelIdea\Helper\App\Models\_IH_Employee_C|\LaravelIdea\Helper\App\Models\_IH_Employee_QB|\LaravelIdea\Helper\App\Models\_IH_User_QB[]|User[]
     */

    public function findOrFail($id = null)
    {
        $employee = $this->employee->with('position')->withCount([
            'tips' => function ($t) {
                $t->where(
                    'created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString()
                );
            },
        ])->find((int)$id);

        if (!$employee) {
            throw ValidationException::withMessages(['message' => trans('employee.could_not_find'), 'back' => true]);
        }

        $employee->sum_tips = number_format(($employee->tips()->sum('sum_tips') ?? 0), 2);
        $employee->append('avg_tips');

        return $employee;
    }

    /**
     * Find employee by Email
     *
     * @param email $email
     * @return Employee
     */

    public function findByEmail($email = null)
    {
        return $this->employee->filterByEmail($email)->first();
    }


    public function findByNumber($number = null)
    {
        return $this->employee->filterByNumber($number)->first();
    }

    /**
     * List employee except authenticated employee by name & email
     *
     * @param string $token
     * @return array
     */

    public function listByNameAndEmailExceptAuthUser()
    {
        return $this->employee->where('id', '!=', \Auth::user()->id)->get()->pluck('name_with_email', 'id')->all();
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
        $email = $params['email'] ?? null;
        $created_at_start_date = $params['created_at_start_date'] ?? null;
        $created_at_end_date = $params['created_at_end_date'] ?? null;
        $companyId = $this->companyId;

        $query = $this->employee->where('company_id', $companyId)->filterByEmail($email)->createdAtDateBetween([
            'start_date' => $created_at_start_date,
            'end_date' => $created_at_end_date
        ]);

        $query->orderBy($sort_by, $order);

        $list = $query->paginate($page_length);

        $list->each(function ($employee) {
            $employee->append('avg_tips');
        });

        return $list;
    }

    public function paginateTips($id, $params = array())
    {
        $sort_by = $params['sort_by'] ?? 'created_at';
        $order = $params['order'] ?? 'desc';
        $page_length = $params['page_length'] ?? config('config.page_length');

        $query = Tip::where('employee_id', $id)->with(['user']);

        $query->orderBy($sort_by, $order);

        return $query->paginate($page_length);
    }

    /**
     * Create a new employee.
     *
     * @param array $params
     * @return Todo
     */

    public function create($params)
    {
        return $this->employee->forceCreate($this->formatParams($params, 'create'));
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
            'company_id' => $this->companyId,
            'position_id' => $params['position_id'] ?? null
        ];
        if ($action === 'create') {
            $values[] = ['mobile_number' => $params['mobile_number']];
        }
        return $values;
    }

    /**
     * Assign role to employee.
     *
     * @param $employee
     * @param integer $role_id
     * @param string $action
     * @return null
     */

    private function assignRole($employee, $role_id, $action = 'attach')
    {
        if ($action === 'attach') {
            $employee->assignRole($this->role->listNameById($role_id));
        } else {
            $employee->roles()->sync($role_id);
        }
    }

    /**
     * Update given employee.
     *
     * @param User $employee
     * @param array $params
     *
     * @return User
     */
    public function update(Employee $employee, $params = array())
    {
        if (isset($params['role_id']) && $employee->hasRole(config('system.default_role.admin'))) {
            $this->assignRole($employee, $params['role_id'], 'sync');
        }

        return $employee;
    }

    /**
     * Delete employee.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Employee $employee)
    {
        return $employee->delete();
    }

    /**
     * Delete multiple employees.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->employee->whereIn('id', $ids)->delete();
    }
}
