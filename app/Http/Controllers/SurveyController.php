<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{
    // index - show all
    // show - show single
    // create - show form to create
    // store - store what created
    // edit - show form to edit
    // update - update what edited
    // destroy - delete

    public function index() {
        return view('pages.home', ['surveys' => Survey::all()]);
    }

    public function show(Survey $survey) {
        return view('pages.surveys.survey', ['survey_data' => $survey]);
    }

    public function create() {
        return view('pages.surveys.create');
    }

    public function search(Request $request) {
        $surveys = Survey::latest('surveys.created_at')->filter(request(['tag', 'search']))->paginate(6);

        return view('pages.surveys.search', ['surveys' => $surveys]);
    }

    public function top6() {
        $surveys = Survey::all();
        $respondents = [];
        $top_surveys = [];

        foreach ($surveys as $survey) {
            $respondents_sum = 0;
            if ($survey->questions[0] ?? false) $respondents_sum = count($survey->questions[0]->answers);

            $survey->respondents = $respondents_sum;
            array_push($respondents, $respondents_sum);
            array_push($top_surveys, $survey);

            for ($i = 0; $i < count($respondents); $i++) {
                if ($respondents_sum > $respondents[$i]) {
                    for ($j = count($respondents) - 1; $j > $i; $j--) {
                        $respondents[$j] = $respondents[$j - 1];
                        $top_surveys[$j] = $top_surveys[$j - 1];
                    }
                    $respondents[$i] = $respondents_sum;
                    $top_surveys[$i] = $survey;
                    break;
                }
            }
        }

        return view('pages.home', ['surveys' => array_slice($top_surveys, 0, 6)]);
    }
}
