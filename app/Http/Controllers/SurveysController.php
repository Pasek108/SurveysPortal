<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surveys;

class SurveysController extends Controller
{
    // index - show all
    // show - show single
    // create - show form to create
    // store - store what created
    // edit - show form to edit
    // update - update what edited
    // destroy - delete

    public function index() {
        return view('home', ['surveys' => Surveys::all()]);
    }

    public function show(Surveys $survey) {
        return view('survey', ['survey_data' => $survey]);
    }
}
