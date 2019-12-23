<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Http\Resources\Admin\OptionResource;
use App\Option;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('option_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OptionResource(Option::with(['question'])->get());
    }

    public function store(StoreOptionRequest $request)
    {
        $option = Option::create($request->all());

        return (new OptionResource($option))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Option $option)
    {
        abort_if(Gate::denies('option_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new OptionResource($option->load(['question']));
    }

    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->update($request->all());

        return (new OptionResource($option))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Option $option)
    {
        abort_if(Gate::denies('option_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $option->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
