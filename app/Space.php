<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the tasks in a space.
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }
}
