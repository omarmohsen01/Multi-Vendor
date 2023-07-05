<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'name','parent_id','decription','image','status','slug'
    ];

    public function scopeActive(Builder $builder)
    {
        $builder->where('status','=','active');
    }

    public function scopeFilter(Builder $builder,$filters)
    {
        $builder->when($filters['name']??false,function($builder,$value){
            $builder->where('categories.name','LIKE',"%{$value}%");
        });
        $builder->when($filters['status']??false,function($builder,$value){
            $builder->where('categories.status','=',$value);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'category_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id')->withDefault(
            [
                'name'=>'-'
            ]
        );
    }
}