<?php

namespace App\Exports;

use App\Models\EBuyerSurvey;
use App\Models\EBuyerSurveyAnswer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SupplierSurveyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {

        return EBuyerSurveyAnswer::where('language','en_supplier')->get(['question1','question2','question3','question4','question5','question6','question7','question8','question9','question10','question11','question12','question13','question14','question15','question16','question17','question18','question19','question20','question21','question22','question23','question24','question25','question26','question27','question28','question29','question30','question31','question32','question33','question34','question35','question36','question37','question38','question39','question40','question41','question42','question43','question44','question45','language',]);
    }

    public function headings(): array
    {
        $questions = EBuyerSurvey::all('question_s_en');
        $ques = [];
        foreach($questions as $qs)
        {
            $ques[] = $qs->question_s_en;
        }
        $ques[] = 'Email ID';
        $ques[] = 'language';
        return $ques;
    }
}
