@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.result.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.results.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.result.fields.id') }}
                        </th>
                        <td>
                            {{ $result->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.result.fields.user') }}
                        </th>
                        <td>
                            {{ $result->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.result.fields.total_points') }}
                        </th>
                        <td>
                            {{ $result->total_points }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.result.fields.questions') }}
                        </th>
                        <td>
                            @foreach($result->questions as $key => $questions)
                                <span class="label label-info">{{ $questions->question_text }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.results.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection