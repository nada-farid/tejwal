

<div class="card">
    <div class="card-header">
        {{ trans('cruds.favorite.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-tripFavorites">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.favorite.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.favorite.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.favorite.fields.trip') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorites as $key => $favorite)
                        <tr data-entry-id="{{ $favorite->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $favorite->id ?? '' }}
                            </td>
                            <td>
                                {{ $favorite->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $favorite->trip->description ?? '' }}
                            </td>
                            <td>
                                @can('favorite_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.favorites.show', $favorite->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('favorite_delete')
                                    <form action="{{ route('admin.favorites.destroy', $favorite->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
