<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'api_keys';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['user_id', 'created_at', 'updated_at'];
}
