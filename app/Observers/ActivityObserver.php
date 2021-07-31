<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityObserver
{
    /**
     * @return int|null
     */
    protected function getUserId(): ?int
    {
        return Auth::id() ?? 1;
    }

    /**
     * @param int $activityId
     * @param $model
     * @return mixed
     */
    protected function createActivityLog(int $activityId, $model)
    {
        return ActivityLog::create([
            'activity_id' => $activityId,
            'user_id'     => $this->getUserId(),
            'model_type'  => get_class($model),
            'model_id'    => $model->id,
            'content'     => json_encode($model)
        ]);
    }

    /**
     * @param $model
     * @return void
     */
    public function created($model)
    {
        $this->createActivityLog(ActivityLog::ACTIVITY_CREATE, $model);
    }

    /**
     * @param $model
     * @return void
     */
    public function updated($model)
    {
        $this->createActivityLog(ActivityLog::ACTIVITY_UPDATE, $model);
    }

    /**
     * @param $model
     * @return void
     */
    public function deleted($model)
    {
        $this->createActivityLog(ActivityLog::ACTIVITY_DELETE, $model);
    }
}
