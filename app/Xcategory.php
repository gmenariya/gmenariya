<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Xcategory extends Model
{
    use SoftDeletes;

    public $table = 'xcategories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function testmodules()
    {
        return $this->hasMany(Testmodule::class, 'category_id', 'id');
    }

    public function testposts()
    {
        return $this->belongsToMany(Testpost::class);
    }
}
