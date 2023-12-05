<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NotificationReceipt extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;

    public $keyType = 'string';

    protected $fillable = [
        'type',
        'value',
    ];
}
