<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'item',
        'justification',
        'status',
        'requested_by',
        'action_by',
        'workflow_id'
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function actionUser()
    {
        return $this->belongsTo(User::class, 'action_by');
    }
}
