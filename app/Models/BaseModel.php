<?php
/**
 * Created by PhpStorm.
 * User: alberto
 * Date: 07/02/18
 * Time: 09:06
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class BaseModel extends Model
{
//    use Uuid;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}