@extends('layouts.admin')
@section('content')
@can('testmodule_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.testmodules.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.testmodule.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.testmodule.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Testmodule">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.testmodule.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.testmodule.fields.textx') }}
                        </th>
                        <th>
                            {{ trans('cruds.testmodule.fields.emailx') }}
                        </th>
                        <th>
                            {{ trans('cruds.testmodule.fields.checkboxx') }}
                        </th>
                        <th>
                            {{ trans('cruds.testmodule.fields.datepickerx') }}
                        </th>
                        <th>
                            {{ trans('cruds.testmodule.fields.file_singlex') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testmodules as $key => $testmodule)
                        <tr data-entry-id="{{ $testmodule->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $testmodule->id ?? '' }}
                            </td>
                            <td>
                                {{ $testmodule->textx ?? '' }}
                            </td>
                            <td>
                                {{ $testmodule->emailx ?? '' }}
                            </td>
                            <td>
                                {{ $testmodule->checkboxx ? trans('global.yes') : trans('global.no') }}
                            </td>
                            <td>
                                {{ $testmodule->datepickerx ?? '' }}
                            </td>
                            <td>
                                @if($testmodule->file_singlex)
                                    <a href="{{ $testmodule->file_singlex->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('testmodule_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.testmodules.show', $testmodule->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('testmodule_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.testmodules.edit', $testmodule->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('testmodule_delete')
                                    <form action="{{ route('admin.testmodules.destroy', $testmodule->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('testmodule_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.testmodules.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  $('.datatable-Testmodule:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection