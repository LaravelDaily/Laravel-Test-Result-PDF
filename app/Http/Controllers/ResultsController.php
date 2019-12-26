<?php

namespace App\Http\Controllers;

use App\Notifications\SendResultsPdfNotification;
use App\Result;
use Illuminate\Support\Facades\File;
use PDF;

class ResultsController extends Controller
{
    public function show($result)
    {
        $result = Result::whereHas('user', function ($query) {
                $query->whereId(auth()->user()->id);
            })->findOrFail($result);
        
        return view('client.results', compact('result'));
    }

    public function send($result)
    {
        $result = Result::whereHas('user', function ($query) {
                $query->whereId(auth()->user()->id);
            })->findOrFail($result);
        $pdf = PDF::loadView('client.pdf', compact('result'));
        $pdf->save(storage_path("$result->id.pdf"));

        auth()->user()->notify(new SendResultsPdfNotification($result));
        File::delete(storage_path("$result->id.pdf"));

        return redirect()->route('client.results.show', $result->id)->withStatus('Your test result has been sent successfully!');
    }
}
