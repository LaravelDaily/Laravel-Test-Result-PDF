@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.option.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.options.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.option.fields.id') }}
                        </th>
                        <td>
                            {{ $option->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.option.fields.question') }}
                        </th>
                        <td>
                            {{ $option->question->question_text ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.option.fields.option_text') }}
                        </th>
                        <td>
                            {{ $option->option_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.option.fields.points') }}
                        </th>
                        <td>
                            {{ $option->points }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.options.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection