<?php

namespace App\Observers;

use App\Services\LedgerService;
use Illuminate\Database\Eloquent\Model;

class ModelLedgerObserver
{
    public function created(Model $model)
    {
        LedgerService::createBlock(
            payload: [
                'event' => 'created',
                'model' => class_basename($model),
                'data'  => $model->toArray(),
            ],
            relatedModel: [
                'model_type' => get_class($model),
                'model_id'   => $model->id,
            ]
        );
    }

    public function updated(Model $model)
    {
        LedgerService::createBlock(
            payload: [
                'event' => 'updated',
                'model' => class_basename($model),
                'change' => $model->getChanges(),
            ],
            relatedModel: [
                'model_type' => get_class($model),
                'model_id'   => $model->id,
            ]
        );
    }
}
