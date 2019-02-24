<?php

namespace App\Imports;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostsImport implements ToModel
{   
    public function map($post): array
    {
        return [
            $invoice->invoice_number,
            Date::dateTimeToExcel($invoice->created_at),
            $invoice->total
        ];
    }

    public function model(array $row)
    {

        //data yang dibutuhin di excel masukin ke sini
        return new Post([
            'dates'     => $row['date'],
            'ron95'    => $row['RON95'], 
            'ron97' => $row['RON97'],
            'diesel' => $row['Diesel']
        ]);
    }
}
