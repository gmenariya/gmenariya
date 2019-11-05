@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.testpost.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.testposts.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.testpost.fields.title') }}</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($testpost) ? $testpost->title : '') }}">
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testpost.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                <label for="slug">{{ trans('cruds.testpost.fields.slug') }}</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', isset($testpost) ? $testpost->slug : '') }}">
                @if($errors->has('slug'))
                    <p class="help-block">
                        {{ $errors->first('slug') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testpost.fields.slug_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                <label for="category">{{ trans('cruds.testpost.fields.category') }}*</label>
                <select name="category_id" id="category" class="form-control select2" required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (isset($testpost) && $testpost->category ? $testpost->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <p class="help-block">
                        {{ $errors->first('category_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('xcaregories') ? 'has-error' : '' }}">
                <label for="xcaregory">{{ trans('cruds.testpost.fields.xcaregory') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="xcaregories[]" id="xcaregories" class="form-control select2" multiple="multiple" required>
                    @foreach($xcaregories as $id => $xcaregory)
                        <option value="{{ $id }}" {{ (in_array($id, old('xcaregories', [])) || isset($testpost) && $testpost->xcaregories->contains($id)) ? 'selected' : '' }}>{{ $xcaregory }}</option>
                    @endforeach
                </select>
                @if($errors->has('xcaregories'))
                    <p class="help-block">
                        {{ $errors->first('xcaregories') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testpost.fields.xcaregory_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection