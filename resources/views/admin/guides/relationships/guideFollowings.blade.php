
<div class="card">
    <div class="card-header">
        {{ trans('cruds.following.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-guideFollowings">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.following.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.following.fields.guide') }}
                        </th>
                        <th>
                            {{ trans('cruds.following.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($followings as $key => $following)
                        <tr data-entry-id="{{ $following->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $following->id ?? '' }}
                            </td>
                            <td>
                                {{ $following->guide->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $following->tourist->user->email ?? '' }}
                            </td>
                            <td>
                                @can('following_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.followings.show', $following->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('following_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.followings.edit', $following->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('following_delete')
                                    <form action="{{ route('admin.followings.destroy', $following->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
