<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = ['text'];

    protected $dates = ['deleted_at'];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the spaces of a task.
     */
    public function spaces()
    {
        return $this->belongsToMany('App\Space');
    }

}
