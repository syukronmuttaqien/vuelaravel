<?php

namespace App\Imports;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;

class PostsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //data yang dibutuhin di excel masukin ke sini
        return new Post([
            'dates'     => $row[0],
            'ron95'    => $row[1], 
            'ron97' => $row[2],
            'diesel' => $row[3]
        ]);
    }
}
