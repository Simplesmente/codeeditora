<?php

namespace CodeEduBook\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Bootstrapper\Interfaces\TableInterface;

class Category extends Model implements Transformable, TableInterface
{
    use TransformableTrait,SoftDeletes;

    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    /**
    * A list of headers to be used when a table is displayed
    *
    * @return array
    */
    public function getTableHeaders()
    {
        return [ 'ID','Nome'];
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
        if ($header === 'Nome') {
            return $this->name;
        }
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }


    public function getNameTrashedAttribute()
    {
      return $this->trashed() ? "{$this->name} (Inativa)": $this->name;
    }
}
