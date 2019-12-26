<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreTestRequest;
use App\Option;

class TestsController extends Controller
{
    public function index()
    {
        $categories = Category::with(['categoryQuestions' => function ($query) {
                $query->inRandomOrder()
                    ->with(['questionOptions' => function ($query) {
                        $query->inRandomOrder();
                    }]);
            }])
            ->whereHas('categoryQuestions')
            ->get();

        return view('client.test', compact('categories'));
    }

    public function store(StoreTestRequest $request)
    {
        $options = collect($request->input('questions'))->flatten()->toArray();
        $options = Option::whereIn('id', $options)->get();
        $questions = $options->mapWithKeys(function ($option) {
            return [$option->question->id => [
                        'option_id' => $option->id,
                        'points' => $option->points
                    ]
                ];
            })->toArray();

        $result = auth()->user()->userResults()->create([
            'total_points' => $options->sum('points')
        ]);
        $result->questions()->sync($questions);

        return redirect()->route('client.home')->withStatus("Test result: $result->total_points points");
    }
}
