<?php

namespace App\Exports;

use App\Models\EBuyerSurveyAnswer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AnswersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return EBuyerSurveyAnswer::all();
    }
/*
 * , WithHeadings
    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }
*/
}
