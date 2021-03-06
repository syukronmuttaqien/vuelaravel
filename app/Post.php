<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['date_created', 'title', 'description', 'keywords','data_source', 'articles', 'data_saved'];
    public $timestamps = false;
    protected $primaryKey = 'id_data';
}
