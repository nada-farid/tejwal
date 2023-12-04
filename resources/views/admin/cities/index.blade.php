@extends('layouts.admin')
@section('content')
    @can('city_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.cities.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.city.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.city.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-City">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.city.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.city.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.city.fields.active') }}
                            </th>
                            <th>
                                {{ trans('cruds.city.fields.country') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $key => $city)
                            <tr data-entry-id="{{ $city->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $city->id ?? '' }}
                                </td>
                                <td>
                                    {{ $city->name ?? '' }}
                                </td>
                                <td>
                                    <label class="c-switch c-switch-pill c-switch-success">
                                        <input onchange="update_statuses(this,'active')" value="{{ $city->id }}"
                                            type="checkbox" class="c-switch-input"
                                            {{ $city->active ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                    </label>
                                </td>
                                <td>
                                    {{ $city->country->name ?? '' }}
                                </td>
                                <td>
                                    @can('city_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.cities.show', $city->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('city_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.cities.edit', $city->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('city_delete')
                                        <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST"
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
            $.post('{{ route('admin.cities.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status, type:type}, function(data){
                if(data == 1){
                    showAlert('success', 'Success', '');
                }else{
                    showAlert('danger', 'Something went wrong', '');
                }
            });
        }

        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-City:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
