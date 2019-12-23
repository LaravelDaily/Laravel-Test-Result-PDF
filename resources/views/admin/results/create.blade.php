@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.result.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.results.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.result.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total_points">{{ trans('cruds.result.fields.total_points') }}</label>
                <input class="form-control {{ $errors->has('total_points') ? 'is-invalid' : '' }}" type="number" name="total_points" id="total_points" value="{{ old('total_points') }}" step="1">
                @if($errors->has('total_points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.total_points_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="questions">{{ trans('cruds.result.fields.questions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('questions') ? 'is-invalid' : '' }}" name="questions[]" id="questions" multiple>
                    @foreach($questions as $id => $questions)
                        <option value="{{ $id }}" {{ in_array($id, old('questions', [])) ? 'selected' : '' }}>{{ $questions }}</option>
                    @endforeach
                </select>
                @if($errors->has('questions'))
                    <div class="invalid-feedback">
                        {{ $errors->first('questions') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.result.fields.questions_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection