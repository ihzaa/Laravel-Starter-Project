<?php

namespace App\Observers;

class UserStampObserver
{
    protected $userId = 0;

    public function __construct()
    {
        $user = auth()->user();
        if ($user) {
            $this->userId = $user->id;
        }
    }
    /**
     * Handle the User "created" event.
     *
     * @return void
     */
    public function creating($model)
    {
        $model->created_by = $this->userId;
        $model->updated_by = $this->userId;
        
    }

    /**
     * Handle the User "updated" event.
     *
     * @return void
     */
    public function updating($model)
    {
        $model->updated_by = $this->userId;
    }

    /**
     * Handle the User "deleted" event.
     *
     * @return void
     */
    public function deleting($model)
    {
        $model->deleted_by = $this->userId;
    }
}
