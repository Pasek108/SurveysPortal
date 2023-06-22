<?php

namespace App\Http\Controllers;

use App\Models\QuestionType;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class SurveyController extends Controller
{
    // index - show all
    // show - show single
    // create - show form to create
    // store - store what created
    // edit - show form to edit
    // update - update what edited
    // destroy - delete

    public function index()
    {
        return view('home', ['surveys' => Survey::all()]);
    }

    public function show(Survey $survey)
    {
        return view('surveys.survey', ['survey' => $survey]);
    }

    public function create()
    {
        return view('surveys.create', ['tags' => Tag::all(), 'types' => QuestionType::all()]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'title' => 'required|alpha_dash', //Must be a number and length of value is 8
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return response()->json('aaaa');
        } else {
            return response()->json('bbbb');
            dd($validator->errors()->all());
        }

        $dupa = $request->all();
        return response()->json($dupa['title']);

        $survey = Survey::all();
        return to_route('survey.show', ['survey' => $survey->id]);
    }

    public function search(Request $request)
    {
        $surveys = Survey::latest('surveys.created_at')->filter(request(['tag', 'search']))->paginate(6);

        return view('surveys.search', ['surveys' => $surveys]);
    }

    public function top6()
    {
        $surveys = Survey::all();

        $popular_value = [];
        $popular_surveys = [];
        $lastest_surveys = [];

        for ($k = 0; $k < count($surveys); $k++) {
            $survey = $surveys[$k];

            // calc number of respondents
            $respondents_sum = 0;
            if ($survey->questions[0] ?? false) $respondents_sum = count($survey->questions[0]->answers);
            $survey->respondents = $respondents_sum;

            // calc users rating
            $rating_sum = 0;
            foreach ($survey->ratings as $rating) $rating_sum += $rating['rating'];
            $rating_sum /= (count($survey->ratings) > 0 ? count($survey->ratings) : 1);
            $survey->users_ratings = number_format((float)round($rating_sum, 2), 2, '.', '');

            // save lastest
            if ($k > count($surveys) - 7) array_push($lastest_surveys, $survey);

            // save the most popular
            array_push($popular_surveys, $survey);

            // sort the most popular by (respondents * rating)
            array_push($popular_value, $respondents_sum * $rating_sum);

            for ($i = 0; $i < count($popular_value); $i++) {
                if ($respondents_sum * $rating_sum > $popular_value[$i]) {
                    for ($j = count($popular_value) - 1; $j > $i; $j--) {
                        $popular_value[$j] = $popular_value[$j - 1];
                        $popular_surveys[$j] = $popular_surveys[$j - 1];
                    }

                    $popular_value[$i] = $respondents_sum * $rating_sum;
                    $popular_surveys[$i] = $survey;
                    break;
                }
            }
        }

        return view('home', ['popular' => array_slice($popular_surveys, 0, 6), 'latest' => array_slice($lastest_surveys, 0, 6)]);
    }
}
