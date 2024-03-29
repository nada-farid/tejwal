@extends('layouts.admin')
@section('content')
    @can('country_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.countries.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.country.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.country.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Country">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.country.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.active') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.phone_number') }}
                            </th>
                            <th>
                                {{ trans('cruds.country.fields.phone_code') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $key => $country)
                            <tr data-entry-id="{{ $country->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $country->id ?? '' }}
                                </td>
                                <td>
                                    {{ $country->name ?? '' }}
                                </td>
                                <td>
                                    <label class="c-switch c-switch-pill c-switch-success">
                                        <input onchange="update_statuses(this,'active')" value="{{ $country->id }}"
                                            type="checkbox" class="c-switch-input"
                                            {{ $country->active ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                    </label>
                                </td>
                                <td>
                                    {{ $country->phone_number ?? '' }}
                                </td>
                                <td>
                                    {{ $country->phone_code ?? '' }}
                                </td>
                                <td>
                                    @can('country_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.countries.show', $country->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('country_edit')
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.countries.edit', $country->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('country_delete')
                                        <form action="{{ route('admin.countries.destroy', $country->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
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
        
        function update_statuses(el,type){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('admin.countries.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status, type:type}, function(data){
                if(data == 1){
                    showAlert('success', 'Success', '');
                }else{
                    showAlert('danger', 'Something went wrong', '');
                }
            });
        }

        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('country_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.countries.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Country:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
