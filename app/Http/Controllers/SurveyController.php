<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Tag;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Fluent;
use Illuminate\Validation\Rule;

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

    public function edit(Survey $survey)
    {
        $survey->title;
        $survey->description;
        $survey->start_date;
        $survey->end_date;
        $survey->tags;
        $survey->questions;
        $survey->end_message;
        $survey->allow_not_logged;

        $survey_data = $survey->toJson();
        $survey_data = json_decode($survey_data, true);

        if ($survey_data['start_date'] != null) {
            $start_date = explode(' ', $survey_data['start_date']);
            $start_date[1] = explode(':', $start_date[1]);
            $start_date[1] = join(":", [$start_date[1][0], $start_date[1][1]]);
            $survey_data['start_date'] = join('T', $start_date);
        }

        if ($survey_data['end_date'] != null) {
            $end_date = explode(' ', $survey_data['end_date']);
            $end_date[1] = explode(':', $end_date[1]);
            $end_date[1] = join(":", [$end_date[1][0], $end_date[1][1]]);
            $survey_data['end_date'] = join('T', $end_date);
        }

        for ($i = 0; $i < count($survey_data['questions']); $i++) {
            $survey_data['questions'][$i]['type'] = QuestionType::where('id', $survey_data['questions'][$i]['type_id'])->first()->name;

            $survey_data['questions'][$i]['choices'] = [];
            $survey_data['questions'][$i]['range'] = ['from' => 0, 'to' => 0];

            $answers = Answer::where('question_id', $survey_data['questions'][$i]['id'])->get();

            if (count($answers) == 1) {
                $text = explode('-', $answers[0]->text);
                $survey_data['questions'][$i]['range']['from'] = $text[0];
                $survey_data['questions'][$i]['range']['to'] = $text[1];
            } else {
                foreach ($answers as $answer) array_push($survey_data['questions'][$i]['choices'], $answer->text);
            }
        }

        $survey_data = json_encode($survey_data);

        return view('surveys.create', [
            'tags' => Tag::all(),
            'types' => QuestionType::all(),
            'survey_data' => $survey_data,
            'survey_id' => $survey->id
        ]);
    }

    public function update(Request $request, Survey $survey)
    {
        $lastest_time = explode(":", date('H:i', strtotime($survey->updated_at)));
        $now_time = explode(":", date('H:i', strtotime("now")));

        if ($lastest_time[0] == $now_time[0] && $now_time[1] - $lastest_time[1] < 1) {
            return response()->json(['status' => 429, 'messages' => ["You can update a survey once every 1 minute"]]);
        }

        $data = $request->all();
        $rules = [
            'title'                     => ['required', 'string'],
            'description'               => ['nullable', 'string'],
            'start_date'                => ['nullable', 'date_format:Y-m-d H:i', 'after:now'],
            'end_date'                  => ['nullable', 'date_format:Y-m-d H:i'],
            'tags'                      => ['array'],
            'tags.*'                    => ['distinct', 'string'],
            'questions'                 => ['sometimes', 'array', 'between:1,60'],
            'questions.*.question'      => ['sometimes', 'required', 'string'],
            'questions.*.description'   => ['sometimes', 'nullable', 'string'],
            'questions.*.type'          => ['sometimes', 'required', 'string', Rule::in(["text", "range", "single choice", "multiple choice", "single choice or text", "multiple choice or text"])],
            'questions.*.range'         => ['sometimes', 'array:from,to'],
            'questions.*.choices.*'     => ['sometimes', 'distinct', 'string'],
            'admin_password'            => ['required', 'string'],
            'access_password'           => ['nullable', 'string'],
            'end_message'               => ['nullable', 'string'],
            'allow_not_logged'          => ['boolean'],
        ];

        $validator = Validator::make($data, $rules);
        $validator->sometimes('questions.*.choices', ['array', 'min:2'], function (Fluent $input, Fluent $item) { return ($item->type != "text" && $item->type != "range"); });

        if ($validator->passes()) {
            /* ----------- add survey ----------- */
            $survey_model = $survey;

            $survey_model->title = $data['title'];
            $survey_model->description = $data['description'];
            $survey_model->start_date = $data['start_date'];
            $survey_model->end_date = $data['end_date'];
            $survey_model->edit_password = $data['admin_password'];
            $survey_model->access_password = $data['access_password'];
            $survey_model->end_message = $data['end_message'];
            $survey_model->allow_not_logged = $data['allow_not_logged'];
            $survey_model->owner_id = auth()->user()->id;

            $survey_model->save();

            /* ----------- add tags ----------- */
            $existing_tags = $survey_model->tags()->get();
            foreach ($existing_tags as $tag) DB::table('surveys_tags')->where('survey_id', $survey_model->id)->where('tag_id', $tag->id)->delete();

            foreach ($data['tags'] as $tag) {
                $tag_id = Tag::where('name', $tag)->first();

                if ($tag_id != null) {
                    $tag_id = $tag_id->id;
                    $survey_model->tags()->attach($tag_id);
                }
            }

            /* ----------- add questions ----------- */
            $existing_questions = $survey_model->questions()->get();
            foreach ($existing_questions as $question) {
                DB::table('answers')->where('question_id', $question->id)->delete();
                DB::table('users_answers')->where('question_id', $question->id)->delete();
                DB::table('questions')->where('survey_id', $survey_model->id)->delete();
            }

            foreach ($data['questions'] as $question) {
                $question_model = new Question([
                    'question' => $question['question'],
                    'description' => $question['description'],
                    'type_id' => QuestionType::where('name', $question['type'])->first()->id
                ]);

                $survey_model->questions()->save($question_model);

                if ($question['type'] == "range") {
                    $answer = new Answer([
                        'text' => $question['range']['from'].'-'.$question['range']['to'],
                        'question_id' => $question_model->id,
                    ]);

                    $question_model->answers()->save($answer);
                } else if ($question['type'] != "text") {
                    foreach ($question['choices'] as $choice) {
                        $answer_model = new Answer([
                            'text' => $choice,
                            'question_id' => $question_model->id,
                        ]);

                        $question_model->answers()->save($answer_model);
                    }
                }
            }

            return response()->json([
                'status' => 201,
                'messages' => "Created succesully",
                'redirect' => route('survey.show', ['survey' => $survey_model->id])
            ]);
        } else return response()->json(['status' => 403, 'messages' => $validator->errors()->all()]);
    }

    public function store(Request $request)
    {
        $user_lastest_survey = Survey::where('owner_id', auth()->user()->id)->latest()->first();
        if ($user_lastest_survey != null) {
            $lastest_time = explode(":", date('H:i', strtotime($user_lastest_survey->created_at)));
            $now_time = explode(":", date('H:i', strtotime("now")));

            if ($lastest_time[0] == $now_time[0] && $now_time[1] - $lastest_time[1] < 5) {
                return response()->json(['status' => 429, 'messages' => ["You can add a survey once every 5 minutes"]]);
            }
        }

        $data = $request->all();
        $rules = [
            'title'                     => ['required', 'string'],
            'description'               => ['nullable', 'string'],
            'start_date'                => ['nullable', 'date_format:Y-m-d H:i', 'after:now'],
            'end_date'                  => ['nullable', 'date_format:Y-m-d H:i'],
            'tags'                      => ['array'],
            'tags.*'                    => ['distinct', 'string'],
            'questions'                 => ['sometimes', 'array', 'between:1,60'],
            'questions.*.question'      => ['sometimes', 'required', 'string'],
            'questions.*.description'   => ['sometimes', 'nullable', 'string'],
            'questions.*.type'          => ['sometimes', 'required', 'string', Rule::in(["text", "range", "single choice", "multiple choice", "single choice or text", "multiple choice or text"])],
            'questions.*.range'         => ['sometimes', 'array:from,to'],
            'questions.*.choices.*'     => ['sometimes', 'distinct', 'string'],
            'admin_password'            => ['required', 'string'],
            'access_password'           => ['nullable', 'string'],
            'end_message'               => ['nullable', 'string'],
            'allow_not_logged'          => ['boolean'],
        ];

        $validator = Validator::make($data, $rules);
        $validator->sometimes('questions.*.choices', ['array', 'min:2', 'max:30'], function (Fluent $input, Fluent $item) { return ($item->type != "text" && $item->type != "range"); });

        if ($validator->passes()) {
            /* ----------- add survey ----------- */
            $survey_model = new Survey;

            $survey_model->title = $data['title'];
            $survey_model->description = $data['description'];
            $survey_model->start_date = $data['start_date'];
            $survey_model->end_date = $data['end_date'];
            $survey_model->edit_password = $data['admin_password'];
            $survey_model->access_password = $data['access_password'];
            $survey_model->end_message = $data['end_message'];
            $survey_model->allow_not_logged = $data['allow_not_logged'];
            $survey_model->owner_id = auth()->user()->id;

            $survey_model->save();

            /* ----------- add tags ----------- */
            foreach ($data['tags'] as $tag) {
                $tag_id = Tag::where('name', $tag)->first();

                if ($tag_id != null) {
                    $tag_id = $tag_id->id;
                    $survey_model->tags()->attach($tag_id);
                }
            }

            /* ----------- add questions ----------- */
            foreach ($data['questions'] as $question) {
                $question_model = new Question([
                    'question' => $question['question'],
                    'description' => $question['description'],
                    'type_id' => QuestionType::where('name', $question['type'])->first()->id
                ]);

                $survey_model->questions()->save($question_model);

                if ($question['type'] == "range") {
                    $answer = new Answer([
                        'text' => $question['range']['from'].'-'.$question['range']['to'],
                        'question_id' => $question_model->id,
                    ]);

                    $question_model->answers()->save($answer);
                } else if ($question['type'] != "text") {
                    foreach ($question['choices'] as $choice) {
                        $answer_model = new Answer([
                            'text' => $choice,
                            'question_id' => $question_model->id,
                        ]);

                        $question_model->answers()->save($answer_model);
                    }
                }
            }

            return response()->json([
                'status' => 201,
                'messages' => "Created succesully",
                'redirect' => route('survey.show', ['survey' => $survey_model->id])
            ]);
        } else return response()->json(['status' => 403, 'messages' => $validator->errors()->all()]);
    }

    public function fill(Survey $survey)
    {
        return view('surveys.fill', ['survey' => $survey]);
    }

    public function send(Request $request, Survey $survey)
    {
        $data = $request->all();
        $rules = [
            'no_rating'                 => ['boolean'],
            'rating'                    => ['nullable', 'numeric'],
            'answers'                   => ['array'],
            'answers.*'                 => ['required', 'string'],
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            if (!$data['no_rating'] && intval($data['rating']) >= 0 && intval($data['rating']) <= 5) {
                $rating_model = new Rating([
                    'user_id' => auth()->user()->id,
                    'survey_id' => $survey->id,
                    'rating' => intval($data['rating'])
                ]);

                $rating_model->save();
            }

            /* ----------- add user answers ----------- */
            $questions = $survey->questions()->get();

            for ($i = 0; $i < count($questions); $i++) {
                $user_answer_model = new UserAnswer;
                $user_answer_model->user_id = auth()->user()->id;
                $user_answer_model->answer = $data['answers'][$i];
                $questions[$i]->userAnswers()->save($user_answer_model);
            }

            return response()->json(['status' => 201,'messages' => "Survey sent succesully"]);
        } else return response()->json(['status' => 403, 'messages' => $validator->errors()->all()]);
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

            $respondents = $rating = $survey->countRespondents($survey->id);
            $rating = $survey->getRating($survey->id);

            // save lastest
            if ($k > count($surveys) - 7) array_push($lastest_surveys, $survey);

            // save the most popular
            array_push($popular_surveys, $survey);

            // sort the most popular by (respondents * rating)
            array_push($popular_value, $respondents * floatval($rating));

            for ($i = 0; $i < count($popular_value); $i++) {
                if ($respondents * floatval($rating) > $popular_value[$i]) {
                    for ($j = count($popular_value) - 1; $j > $i; $j--) {
                        $popular_value[$j] = $popular_value[$j - 1];
                        $popular_surveys[$j] = $popular_surveys[$j - 1];
                    }

                    $popular_value[$i] = $respondents * floatval($rating);
                    $popular_surveys[$i] = $survey;
                    break;
                }
            }
        }

        return view('home', ['popular' => array_slice($popular_surveys, 0, 6), 'latest' => array_slice(array_reverse($lastest_surveys), 0, 6)]);
    }
}
