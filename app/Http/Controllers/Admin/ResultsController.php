<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyResultRequest;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use App\Question;
use App\Result;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResultsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('result_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $results = Result::all();

        return view('admin.results.index', compact('results'));
    }

    public function create()
    {
        abort_if(Gate::denies('result_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Question::all()->pluck('question_text', 'id');

        return view('admin.results.create', compact('users', 'questions'));
    }

    public function store(StoreResultRequest $request)
    {
        $result = Result::create($request->all());
        $result->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.results.index');
    }

    public function edit(Result $result)
    {
        abort_if(Gate::denies('result_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Question::all()->pluck('question_text', 'id');

        $result->load('user', 'questions');

        return view('admin.results.edit', compact('users', 'questions', 'result'));
    }

    public function update(UpdateResultRequest $request, Result $result)
    {
        $result->update($request->all());
        $result->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.results.index');
    }

    public function show(Result $result)
    {
        abort_if(Gate::denies('result_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $result->load('user', 'questions');

        return view('admin.results.show', compact('result'));
    }

    public function destroy(Result $result)
    {
        abort_if(Gate::denies('result_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $result->delete();

        return back();
    }

    public function massDestroy(MassDestroyResultRequest $request)
    {
        Result::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
