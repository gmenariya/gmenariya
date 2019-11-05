@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.testmodule.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.testmodules.update", [$testmodule->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('textx') ? 'has-error' : '' }}">
                <label for="textx">{{ trans('cruds.testmodule.fields.textx') }}*</label>
                <input type="text" id="textx" name="textx" class="form-control" value="{{ old('textx', isset($testmodule) ? $testmodule->textx : '') }}" required>
                @if($errors->has('textx'))
                    <p class="help-block">
                        {{ $errors->first('textx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.textx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('emailx') ? 'has-error' : '' }}">
                <label for="emailx">{{ trans('cruds.testmodule.fields.emailx') }}*</label>
                <input type="email" id="emailx" name="emailx" class="form-control" value="{{ old('emailx', isset($testmodule) ? $testmodule->emailx : '') }}" required>
                @if($errors->has('emailx'))
                    <p class="help-block">
                        {{ $errors->first('emailx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.emailx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('textareack') ? 'has-error' : '' }}">
                <label for="textareack">{{ trans('cruds.testmodule.fields.textareack') }}</label>
                <textarea id="textareack" name="textareack" class="form-control ckeditor">{{ old('textareack', isset($testmodule) ? $testmodule->textareack : '') }}</textarea>
                @if($errors->has('textareack'))
                    <p class="help-block">
                        {{ $errors->first('textareack') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.textareack_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('tetareanock') ? 'has-error' : '' }}">
                <label for="tetareanock">{{ trans('cruds.testmodule.fields.tetareanock') }}</label>
                <textarea id="tetareanock" name="tetareanock" class="form-control ">{{ old('tetareanock', isset($testmodule) ? $testmodule->tetareanock : '') }}</textarea>
                @if($errors->has('tetareanock'))
                    <p class="help-block">
                        {{ $errors->first('tetareanock') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.tetareanock_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('passwordx') ? 'has-error' : '' }}">
                <label for="passwordx">{{ trans('cruds.testmodule.fields.passwordx') }}</label>
                <input type="password" id="passwordx" name="passwordx" class="form-control">
                @if($errors->has('passwordx'))
                    <p class="help-block">
                        {{ $errors->first('passwordx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.passwordx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('radiox') ? 'has-error' : '' }}">
                <label>{{ trans('cruds.testmodule.fields.radiox') }}</label>
                @foreach(App\Testmodule::RADIOX_RADIO as $key => $label)
                    <div>
                        <input id="radiox_{{ $key }}" name="radiox" type="radio" value="{{ $key }}" {{ old('radiox', $testmodule->radiox) === (string)$key ? 'checked' : '' }}>
                        <label for="radiox_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('radiox'))
                    <p class="help-block">
                        {{ $errors->first('radiox') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('selectx') ? 'has-error' : '' }}">
                <label for="selectx">{{ trans('cruds.testmodule.fields.selectx') }}</label>
                <select id="selectx" name="selectx" class="form-control">
                    <option value="" disabled {{ old('selectx', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Testmodule::SELECTX_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('selectx', $testmodule->selectx) === (string)$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('selectx'))
                    <p class="help-block">
                        {{ $errors->first('selectx') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('checkboxx') ? 'has-error' : '' }}">
                <label for="checkboxx">{{ trans('cruds.testmodule.fields.checkboxx') }}</label>
                <input name="checkboxx" type="hidden" value="0">
                <input value="1" type="checkbox" id="checkboxx" name="checkboxx" {{ (isset($testmodule) && $testmodule->checkboxx) || old('checkboxx', 0) === 1 ? 'checked' : '' }}>
                @if($errors->has('checkboxx'))
                    <p class="help-block">
                        {{ $errors->first('checkboxx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.checkboxx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('integerx') ? 'has-error' : '' }}">
                <label for="integerx">{{ trans('cruds.testmodule.fields.integerx') }}</label>
                <input type="number" id="integerx" name="integerx" class="form-control" value="{{ old('integerx', isset($testmodule) ? $testmodule->integerx : '') }}" step="1">
                @if($errors->has('integerx'))
                    <p class="help-block">
                        {{ $errors->first('integerx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.integerx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('floatx') ? 'has-error' : '' }}">
                <label for="floatx">{{ trans('cruds.testmodule.fields.floatx') }}</label>
                <input type="number" id="floatx" name="floatx" class="form-control" value="{{ old('floatx', isset($testmodule) ? $testmodule->floatx : '') }}" step="0.01" max="100">
                @if($errors->has('floatx'))
                    <p class="help-block">
                        {{ $errors->first('floatx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.floatx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('moneyx') ? 'has-error' : '' }}">
                <label for="moneyx">{{ trans('cruds.testmodule.fields.moneyx') }}</label>
                <input type="number" id="moneyx" name="moneyx" class="form-control" value="{{ old('moneyx', isset($testmodule) ? $testmodule->moneyx : '') }}" step="0.01">
                @if($errors->has('moneyx'))
                    <p class="help-block">
                        {{ $errors->first('moneyx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.moneyx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('datepickerx') ? 'has-error' : '' }}">
                <label for="datepickerx">{{ trans('cruds.testmodule.fields.datepickerx') }}</label>
                <input type="text" id="datepickerx" name="datepickerx" class="form-control date" value="{{ old('datepickerx', isset($testmodule) ? $testmodule->datepickerx : '') }}">
                @if($errors->has('datepickerx'))
                    <p class="help-block">
                        {{ $errors->first('datepickerx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.datepickerx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('datetimepickerx') ? 'has-error' : '' }}">
                <label for="datetimepickerx">{{ trans('cruds.testmodule.fields.datetimepickerx') }}</label>
                <input type="text" id="datetimepickerx" name="datetimepickerx" class="form-control datetime" value="{{ old('datetimepickerx', isset($testmodule) ? $testmodule->datetimepickerx : '') }}">
                @if($errors->has('datetimepickerx'))
                    <p class="help-block">
                        {{ $errors->first('datetimepickerx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.datetimepickerx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('timepickerx') ? 'has-error' : '' }}">
                <label for="timepickerx">{{ trans('cruds.testmodule.fields.timepickerx') }}</label>
                <input type="text" id="timepickerx" name="timepickerx" class="form-control timepicker" value="{{ old('timepickerx', isset($testmodule) ? $testmodule->timepickerx : '') }}">
                @if($errors->has('timepickerx'))
                    <p class="help-block">
                        {{ $errors->first('timepickerx') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.timepickerx_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('file_singlex') ? 'has-error' : '' }}">
                <label for="file_singlex">{{ trans('cruds.testmodule.fields.file_singlex') }}</label>
                <div class="needsclick dropzone" id="file_singlex-dropzone">

                </div>
                @if($errors->has('file_singlex'))
                    <p class="help-block">
                        {{ $errors->first('file_singlex') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.file_singlex_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('file_multix') ? 'has-error' : '' }}">
                <label for="file_multix">{{ trans('cruds.testmodule.fields.file_multix') }}</label>
                <div class="needsclick dropzone" id="file_multix-dropzone">

                </div>
                @if($errors->has('file_multix'))
                    <p class="help-block">
                        {{ $errors->first('file_multix') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.file_multix_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                <label for="category">{{ trans('cruds.testmodule.fields.category') }}</label>
                <select name="category_id" id="category" class="form-control select2">
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (isset($testmodule) && $testmodule->category ? $testmodule->category->id : old('category_id')) == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <p class="help-block">
                        {{ $errors->first('category_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('categoryxes') ? 'has-error' : '' }}">
                <label for="categoryx">{{ trans('cruds.testmodule.fields.categoryx') }}
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="categoryxes[]" id="categoryxes" class="form-control select2" multiple="multiple">
                    @foreach($categoryxes as $id => $categoryx)
                        <option value="{{ $id }}" {{ (in_array($id, old('categoryxes', [])) || isset($testmodule) && $testmodule->categoryxes->contains($id)) ? 'selected' : '' }}>{{ $categoryx }}</option>
                    @endforeach
                </select>
                @if($errors->has('categoryxes'))
                    <p class="help-block">
                        {{ $errors->first('categoryxes') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.testmodule.fields.categoryx_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.fileSinglexDropzone = {
    url: '{{ route('admin.testmodules.storeMedia') }}',
    maxFilesize: 2, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="file_singlex"]').remove()
      $('form').append('<input type="hidden" name="file_singlex" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_singlex"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($testmodule) && $testmodule->file_singlex)
      var file = {!! json_encode($testmodule->file_singlex) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_singlex" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedFileMultixMap = {}
Dropzone.options.fileMultixDropzone = {
    url: '{{ route('admin.testmodules.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file_multix[]" value="' + response.name + '">')
      uploadedFileMultixMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMultixMap[file.name]
      }
      $('form').find('input[name="file_multix[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($testmodule) && $testmodule->file_multix)
          var files =
            {!! json_encode($testmodule->file_multix) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file_multix[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@stop