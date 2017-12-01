<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
                        'title',
                        'subtitle',
                        'price',
                        'user_id'
                    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
