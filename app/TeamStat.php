<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamStat extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teams_stats';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];
}
