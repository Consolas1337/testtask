<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;
    
    protected $table = 'product_order';

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


    public function childs()
    {
        return $this->hasMany(Comments::class, 'parent_id', 'id');
    }
}
