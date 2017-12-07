<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Book extends Model implements TableInterface
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

    /**
    * A list of headers to be used when a table is displayed
    *
    * @return array
    */
    public function getTableHeaders()
    {
        return [ 'ID','Titulo','Subtitulo','Preço'];
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
        if ($header === 'Subtitulo') {
            return $this->subtitle;
        }
        if ($header === 'Preço') {
            return $this->price;
        }
    }
}
