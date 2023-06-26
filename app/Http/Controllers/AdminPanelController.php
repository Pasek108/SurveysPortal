<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\Contact;
use App\Models\Question;
use App\Models\Report;
use App\Models\Survey;
use App\Models\Tag;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
    function dashboard(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        return view('admin-panel.dashboard', [
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }

    function reports(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        return view('admin-panel.reports', [
            'reports' => Report::latest()->orderBy('read', 'ASC')->paginate(10),
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }

    function markReportAsRead(Request $request, $id)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        $report = Report::find($id);
        $report->read = true;
        $report->save();

        return redirect('/admin-panel/reports');
    }

    function deleteReport(Request $request, $id)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        DB::table('reports')->where('id', $id)->delete();

        return redirect('/admin-panel/reports');
    }

    function contact(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        return view('admin-panel.contact', [
            'contact' => Contact::latest()->orderBy('read', 'ASC')->paginate(10),
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }

    function markContactAsRead(Request $request, $id)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        $contact = Contact::find($id);
        $contact->read = true;
        $contact->save();

        return redirect('/admin-panel/contact');
    }

    function deleteContact(Request $request, $id)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        DB::table('contact')->where('id', $id)->delete();

        return redirect('/admin-panel/contact');
    }

    function users(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        $user_id = (empty($request->get('user_id'))) ? 1 : $request->get('user_id');
        $sort_by = (empty($request->get('sort'))) ? 'id' : $request->get('sort');
        $order = (empty($request->get('order'))) ? 'ASC' : $request->get('order');
        $search = $request->get('search');

        if ($sort_by == 'role') $sort_by = 'role_id';

        $users = User::where('name', 'LIKE', '%' . $search . '%')->orderBy($sort_by, $order)->paginate(10, ['*'], 'users_page');

        $check_user = User::with('surveys')->find($user_id);
        $check_user_surveys = $check_user->surveys()->paginate(5, ['*'], 'check_user_surveys_page');

        $surveys_taken = 0;
        $user_answers = UserAnswer::all();

        $last_survey_id = 0;
        foreach ($user_answers as $answer) {
            if ($answer->user_id == intval($user_id) && $answer->question->survey->id != $last_survey_id) {
                $surveys_taken++;
                $last_survey_id = $answer->question->survey->id;
            }
        }

        return view('admin-panel.users', [
            'users' => $users,
            'check_user' => $check_user,
            'check_user_surveys' => $check_user_surveys,
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count(),
            'surveys_taken' => $surveys_taken,
        ]);
    }

    function bans(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        $sort_by = (empty($request->get('sort'))) ? 'id' : $request->get('sort');
        $order = (empty($request->get('order'))) ? 'ASC' : $request->get('order');
        $search = $request->get('search');

        if ($sort_by == 'user') $sort_by = 'user_id';

        $bans = null;

        if (!empty($search)) {
            $user_id = User::where('name', 'LIKE', '%' . $search . '%')->first()->id;
            $bans = Ban::where('user_id', $user_id)->orderBy($sort_by, $order)->paginate(10, ['*'], 'bans_page');
        }
        else $bans = Ban::orderBy($sort_by, $order)->paginate(10, ['*'], 'bans_page');

        return view('admin-panel.bans', [
            'bans' => $bans,
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }

    function surveys(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        $survey_id = (empty($request->get('survey_id'))) ? 1 : $request->get('survey_id');
        $sort_by = (empty($request->get('sort'))) ? 'id' : $request->get('sort');
        $order = (empty($request->get('order'))) ? 'ASC' : $request->get('order');
        $search = $request->get('search');

        if ($sort_by == 'role') $sort_by = 'role_id';

        $surveys = Survey::where('title', 'LIKE', '%' . $search . '%')->orderBy($sort_by, $order)->paginate(10, ['*'], 'surveys_page');

        $check_survey = Survey::with('questions')->find($survey_id);
        $check_survey_questions = $check_survey->questions()->paginate(5, ['*'], 'check_survey_questions_page');

        return view('admin-panel.surveys', [
            'surveys' => $surveys,
            'check_survey' => $check_survey,
            'check_survey_questions' => $check_survey_questions,
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }

    function questions(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        $sort_by = (empty($request->get('sort'))) ? 'id' : $request->get('sort');
        $order = (empty($request->get('order'))) ? 'ASC' : $request->get('order');
        $search = $request->get('search');

        if ($sort_by == 'type') $sort_by = 'type_id';

        $questions = Question::where('question', 'LIKE', '%' . $search . '%')->orderBy($sort_by, $order)->paginate(10, ['*'], 'questions_page');


        return view('admin-panel.questions', [
            'questions' => $questions,
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }

    function answers(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        return view('admin-panel.answers', [
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }

    function tags(Request $request)
    {
        if (request()->user()->role->name == 'user') return redirect('/');

        $sort_by = (empty($request->get('sort'))) ? 'id' : $request->get('sort');
        $order = (empty($request->get('order'))) ? 'ASC' : $request->get('order');
        $search = $request->get('search');

        if ($sort_by == 'user') $sort_by = 'user_id';

        $tags = Tag::where('name', 'LIKE', '%' . $search . '%')->orderBy($sort_by, $order)->paginate(10, ['*'], 'tags_page');

        return view('admin-panel.tags', [
            'tags' => $tags,
            'reports_count' => Report::where('read', false)->count(),
            'contact_count' => Contact::where('read', false)->count()
        ]);
    }
}
