@extends('layouts.admin')
@section('content')
    @can('guide_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.guides.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.guide.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.guide.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Guide">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.user') }}
                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.driving_licence') }}
                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.car') }}
                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.degree') }}
                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.major') }}
                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.cost') }}
                            </th>
                            <th>
                                {{ trans('cruds.guide.fields.organization') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.approved') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guides as $key => $guide)
                            <tr data-entry-id="{{ $guide->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $guide->id ?? '' }}
                                </td>
                                <td>
                                    {{ $guide->user->email ?? '' }}
                                </td>
                                <td>

                                    {{ trans('global.driving.' . App\Models\Guide::DRIVING_LICENCE_RADIO[$guide->driving_licence]) ?? '' }}
                                </td>
                                <td>
                                    {{ trans('global.driving.' . App\Models\Guide::CAR_RADIO[$guide->car]) ?? '' }}
                                </td>
                                <td>
                                    {{ trans('global.degree.' . App\Models\Guide::DEGREE_RADIO[$guide->degree]) ?? '' }}
                                </td>
                                <td>
                                    {{ $guide->major ?? '' }}
                                </td>

                                <td>
                                    {{ $guide->cost ?? '' }}
                                </td>
                                <td>
                                    {{ $guide->organization->organization_name ?? '' }}
                                </td>
                                <td>  
                                    <label class="c-switch c-switch-pill c-switch-success">
                                        <input onchange="update_statuses(this,'approved')" value="{{ $guide->user_id }}"
                                            type="checkbox" class="c-switch-input"
                                            {{ $guide->user->approved ? 'checked' : null }}>
                                        <span class="c-switch-slider"></span>
                                    </label>
                                </td>
                                <td>
                                    @can('guide_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.guides.show', $guide->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('guide_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.guides.edit', $guide->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('guide_delete')
                                        <form action="{{ route('admin.guides.destroy', $guide->id) }}" method="POST"
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
            $.post('{{ route('admin.users.update_statuses') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status, type:type}, function(data){
                if(data == 1){
                    showAlert('success', 'Success', '');
                }else{
                    showAlert('danger', 'Something went wrong', '');
                }
            });
        }
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('guide_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.guides.massDestroy') }}",
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
                pageLength: 25,
            });
            let table = $('.datatable-Guide:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
