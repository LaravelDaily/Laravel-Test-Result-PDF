<?php

namespace App\Http\Controllers;

use App\Notifications\SendResultsPdfNotification;
use App\Result;
use Illuminate\Support\Facades\File;
use PDF;

class ResultsController extends Controller
{
    public function show($result_id)
    {
        $result = Result::whereHas('user', function ($query) {
                $query->whereId(auth()->id());
            })->findOrFail($result_id);
        
        return view('client.results', compact('result'));
    }

    public function send($result_id)
    {
        $result = Result::whereHas('user', function ($query) {
                $query->whereId(auth()->id());
            })->findOrFail($result_id);
        $filename = $result->id . '.pdf';
        $pdf = PDF::loadView('client.pdf', compact('result'));
        $pdf->save(storage_path($filename));

        auth()->user()->notify(new SendResultsPdfNotification($result));
        File::delete(storage_path($filename));

        return redirect()->route('client.results.show', $result->id)->withStatus('Your test result has been sent successfully!');
    }
}
