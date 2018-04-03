<?php

namespace CodePub\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;

class Book extends Model implements Transformable, TableInterface
{
    use TransformableTrait,FormAccessible,SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'subtitle',
        'price',
        'user_id'
    ];

    public function formCategoriesAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
    * A list of headers to be used when a table is displayed
    *
    * @return array
    */
    public function getTableHeaders()
    {
        return [ 'ID','Titulo','Autor','Preço'];
    }

    /**
    * Get the value for a given header. Note that this will be the value
    * passed to any callback functions that are being used.
    *
    * @param string $header
    * @return mixed
    */
    public function getValueForHeader($header)
    {
        if ($header === 'ID') {
            return $this->id;
        }
        if ($header === 'Titulo') {
            return $this->title;
        }
        if ($header === 'Autor') {
            return $this->author->name;
        }
        if ($header === 'Preço') {
            return $this->price;
        }
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
