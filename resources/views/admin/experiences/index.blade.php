@extends('layouts.admin')
@section('content')
@can('experience_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.experiences.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.experience.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.experience.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Experience">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.experience.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.experience.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.experience.fields.years_of_experience') }}
                        </th>
                        <th>
                            {{ trans('cruds.experience.fields.guide') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($experiences as $key => $experience)
                        <tr data-entry-id="{{ $experience->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $experience->id ?? '' }}
                            </td>
                            <td>
                                {{ $experience->city ?? '' }}
                            </td>
                            <td>
                                {{ $experience->years_of_experience ?? '' }}
                            </td>
                            <td>
                                {{ $experience->guide->user->email ?? '' }}
                            </td>
                            <td>
                                @can('experience_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.experiences.show', $experience->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('experience_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.experiences.edit', $experience->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('experience_delete')
                                    <form action="{{ route('admin.experiences.destroy', $experience->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('experience_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.experiences.massDestroy') }}",
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
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Experience:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection