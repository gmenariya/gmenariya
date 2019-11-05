@extends('layouts.admin')
@section('content')
@can('xcategory_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.xcategories.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.xcategory.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.xcategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Xcategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.xcategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.xcategory.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.xcategory.fields.slug') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($xcategories as $key => $xcategory)
                        <tr data-entry-id="{{ $xcategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $xcategory->id ?? '' }}
                            </td>
                            <td>
                                {{ $xcategory->name ?? '' }}
                            </td>
                            <td>
                                {{ $xcategory->slug ?? '' }}
                            </td>
                            <td>
                                @can('xcategory_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.xcategories.show', $xcategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('xcategory_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.xcategories.edit', $xcategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('xcategory_delete')
                                    <form action="{{ route('admin.xcategories.destroy', $xcategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('xcategory_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.xcategories.massDestroy') }}",
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
    order: [[ 2, 'asc' ]],
    pageLength: 25,
  });
  $('.datatable-Xcategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection