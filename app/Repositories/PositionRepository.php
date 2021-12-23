<?php

namespace App\Repositories;

use App\Models\Position;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use LaravelIdea\Helper\App\Models\_IH_Position_C;

class PositionRepository
{
    protected $position;
    protected $role;
    protected $email;
    protected $companyId;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function setCompanyId($company)
    {
        $this->companyId = $company;
    }

    /**
     * Get all positions with profile
     *
     * @return Position[]|_IH_Position_C
     */

    public function getAll()
    {
        return $this->position->where('company_id', $this->companyId)->get();
    }

    /**
     * Count positions
     *
     * @return integer
     */

    public function count()
    {
        return $this->position->count();
    }

    /**
     * Count positions registered between dates
     *
     * @return integer
     */

    public function countDateBetween($start_date, $end_date)
    {
        return $this->position->createdAtDateBetween(['start_date' => $start_date, 'end_date' => $end_date])->count();
    }

    /**
     * Find position by Id
     *
     * @param integer $id
     * @return User|User[]|Builder|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\LaravelIdea\Helper\App\Models\_IH_User_C|\LaravelIdea\Helper\App\Models\_IH_User_QB|\LaravelIdea\Helper\App\Models\_IH_User_QB[]
     */

    public function findOrFail($id = null)
    {
        $position = $this->position->find((int)$id);

        if (!$position) {
            throw ValidationException::withMessages(['message' => trans('position.could_not_find'), 'back' => true]);
        }

        return $position;
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

        $query = $this->position->with(['user', 'employee'])->createdAtDateBetween([
            'start_date' => $created_at_start_date,
            'end_date' => $created_at_end_date
        ]);

        $query->where('company_id', $this->companyId);

        $query->orderBy($sort_by, $order);

        return $query->paginate($page_length);
    }

    public function create($params)
    {
        return $this->position->forceCreate($this->formatParams($params, 'register'));
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
        return [
            'email' => $params['email'] ?? null,
            'first_name' => $params['first_name'] ?? null,
            'last_name' => $params['last_name'] ?? null,
            'middle_name' => $params['middle_name'] ?? null,
        ];
    }

    /**
     * Update given position.
     *
     * @param Position $position
     * @param array $params
     *
     * @return User
     */
    public function update(Position $position, $params = array())
    {
        $position->update($params);

        return $position;
    }

    /**
     * Delete position.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Position $position)
    {
        return $position->delete();
    }

    /**
     * Delete multiple positions.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->position->whereIn('id', $ids)->delete();
    }
}
