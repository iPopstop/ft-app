<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\Tip;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use LaravelIdea\Helper\App\Models\_IH_Comment_C;
use LaravelIdea\Helper\App\Models\_IH_Comment_QB;

class CommentRepository
{
    protected $comment;
    protected $role;
    protected $email;
    protected $employee;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function registerEmployee($employee)
    {
        $this->employee = $employee;
    }

    /**
     * Get all comments with profile
     *
     * @return Comment[]|_IH_Comment_C
     */

    public function getAll()
    {
        return $this->comment->get();
    }

    /**
     * Count comments
     *
     * @return integer
     */

    public function count()
    {
        return $this->comment->count();
    }

    public function countPlus()
    {
        return $this->comment->whereHas('employee', function ($e) {
            $e->where('company_id', $this->employee->company_id ?? null);
        })->where('rate', '>', 3)->count();
    }

    public function countMinus()
    {
        return $this->comment->whereHas('employee', function ($e) {
            $e->where('company_id', $this->employee->company_id ?? null);
        })->where('rate', '<', 4)->count();
    }

    /**
     * Count comments registered between dates
     *
     * @return integer
     */

    public function countDateBetween($start_date, $end_date)
    {
        return $this->comment->createdAtDateBetween(['start_date' => $start_date, 'end_date' => $end_date])->count();
    }

    /**
     * Find comment by Id
     *
     * @param integer $id
     * @return _IH_Comment_C|Builder|Builder[]|Comment|Collection|Model|_IH_Comment_QB|\LaravelIdea\Helper\App\Models\_IH_User_QB[]|User[]
     */

    public function findOrFail($id = null)
    {
        $comment = $this->comment->with(['employee', 'user'])->find((int)$id);

        if (!$comment) {
            throw ValidationException::withMessages(['message' => trans('comment.could_not_find'), 'back' => true]);
        }

        if ($comment->user_id && $comment->has('user')) {
            $tips = $comment->user->tips()->where('user_id', $comment->user_id)->whereHas('employee', function ($e) use ($comment) {
                $e->where('company_id', $comment->employee->company_id);
            })->get();
            $comment['user']['tips'] = $tips->sum('sum_tips');
        }

        return $comment;
    }


    public function reply(Comment $comment, $params = [])
    {
        $reply = ['answer' => $params['reply'], 'answered_at' => now()];
        $comment->update($reply);
        return $reply;
    }

    /**
     * Find comment by Email
     *
     * @param email $email
     * @return User
     */

    public function findByEmail($email = null)
    {
        return $this->comment->filterByEmail($email)->first();
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
        $email = $params['email'] ?? null;
        $rate = $params['rate'] ?? null;
        $created_at_start_date = $params['created_at_start_date'] ?? null;
        $created_at_end_date = $params['created_at_end_date'] ?? null;

        $query = $this->comment->with(['user', 'employee'])->filterByEmail($email)->createdAtDateBetween([
            'start_date' => $created_at_start_date,
            'end_date' => $created_at_end_date
        ]);

        if ($rate) {
            if ($rate === '+') {
                $query->where('rate', '>', 3);
            } else {
                $query->where('rate', '<', 4);
            }
        }

        if ($this->employee) {
            $query->whereHas('employee', function ($e) {
                $e->where('company_id', $this->employee->company_id);
            });
        }

        $query->orderBy($sort_by, $order);

        return $query->paginate($page_length);
    }

    /**
     * Create a new comment.
     *
     * @param array $params
     * @return Todo
     */

    public function create($params)
    {
        return $this->comment->forceCreate($this->formatParams($params));
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
            'user_id' => $params['user_id'] ?? null,
            'employee_id' => $params['employee_id'] ?? null,
            'rate' => $params['rate'] ?? 1,
            'message' => $params['message'] ?? null,
        ];
    }

    /**
     * Assign role to comment.
     *
     * @param $comment
     * @param integer $role_id
     * @param string $action
     * @return null
     */

    private function assignRole($comment, $role_id, $action = 'attach')
    {
        if ($action === 'attach') {
            $comment->assignRole($this->role->listNameById($role_id));
        } else {
            $comment->roles()->sync($role_id);
        }
    }

    /**
     * Update given comment.
     *
     * @param User $comment
     * @param array $params
     *
     * @return User
     */
    public function update(Comment $comment, $params = array())
    {
        if (isset($params['role_id']) && $comment->hasRole(config('system.default_role.admin'))) {
            $this->assignRole($comment, $params['role_id'], 'sync');
        }

        return $comment;
    }

    /**
     * Delete comment.
     *
     * @param integer $id
     * @return bool|null
     */
    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    /**
     * Delete multiple comments.
     *
     * @param array $ids
     * @return bool|null
     */
    public function deleteMultiple($ids)
    {
        return $this->comment->whereIn('id', $ids)->delete();
    }
}
