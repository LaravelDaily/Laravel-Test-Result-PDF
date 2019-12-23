<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOptionRequest;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Option;
use App\Question;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('option_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $options = Option::all();

        return view('admin.options.index', compact('options'));
    }

    public function create()
    {
        abort_if(Gate::denies('option_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Question::all()->pluck('question_text', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.options.create', compact('questions'));
    }

    public function store(StoreOptionRequest $request)
    {
        $option = Option::create($request->all());

        return redirect()->route('admin.options.index');
    }

    public function edit(Option $option)
    {
        abort_if(Gate::denies('option_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Question::all()->pluck('question_text', 'id')->prepend(trans('global.pleaseSelect'), '');

        $option->load('question');

        return view('admin.options.edit', compact('questions', 'option'));
    }

    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->update($request->all());

        return redirect()->route('admin.options.index');
    }

    public function show(Option $option)
    {
        abort_if(Gate::denies('option_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $option->load('question');

        return view('admin.options.show', compact('option'));
    }

    public function destroy(Option $option)
    {
        abort_if(Gate::denies('option_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $option->delete();

        return back();
    }

    public function massDestroy(MassDestroyOptionRequest $request)
    {
        Option::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
