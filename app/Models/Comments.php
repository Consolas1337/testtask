<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;
    
    protected $table = 'comments';

    protected $fillable = [
        'parent_id',
        'likes',
        'text',
        'user',
        'phone',
    ];

    protected $hidden = [
        'updated_at', 'deleted_at',
    ];


    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id')->with("childs");
    }
}
