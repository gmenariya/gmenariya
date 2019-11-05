@extends('layouts.admin')
@section('content')
@can('testpost_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.testposts.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.testpost.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.testpost.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Testpost">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.testpost.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.testpost.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.testpost.fields.slug') }}
                        </th>
                        <th>
                            {{ trans('cruds.testpost.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.testpost.fields.xcaregory') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testposts as $key => $testpost)
                        <tr data-entry-id="{{ $testpost->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $testpost->id ?? '' }}
                            </td>
                            <td>
                                {{ $testpost->title ?? '' }}
                            </td>
                            <td>
                                {{ $testpost->slug ?? '' }}
                            </td>
                            <td>
                                {{ $testpost->category->name ?? '' }}
                            </td>
                            <td>
                                @foreach($testpost->xcaregories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('testpost_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.testposts.show', $testpost->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('testpost_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.testposts.edit', $testpost->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('testpost_delete')
                                    <form action="{{ route('admin.testposts.destroy', $testpost->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('testpost_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.testposts.massDestroy') }}",
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
    pageLength: 100,
  });
  $('.datatable-Testpost:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection