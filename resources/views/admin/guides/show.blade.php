@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.guide.title') }}
    </div>
    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <div class ="row">
            <div clas="col-md-3">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.id') }}
                        </th>
                        <td>
                            {{ $guide->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.brief_intro') }}
                        </th>
                        <td>
                            {{ $guide->brief_intro }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.driving_licence') }}
                        </th>
                        <td>
                            {{ trans('global.driving.'.App\Models\Guide::DRIVING_LICENCE_RADIO[$guide->driving_licence]) ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.car') }}
                        </th>
                        <td>
                            {{ trans('global.driving.'.App\Models\Guide::CAR_RADIO[$guide->car])  ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.degree') }}
                        </th>
                        <td>
                            {{ trans('global.degree.'. App\Models\Guide::DEGREE_RADIO[$guide->degree]) ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.major') }}
                        </th>
                        <td>
                            {{ $guide->major }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.user') }}
                        </th>
                        <td>
                            {{ $guide->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.guide.fields.cost') }}
                        </th>
                        <td>
                            {{ $guide->cost }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.guides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
<div class="col-md-8">
<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#guide_experiences" role="tab" data-toggle="tab">
                {{ trans('cruds.experience.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#guide_followings" role="tab" data-toggle="tab">
                {{ trans('cruds.following.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="guide_experiences">
            @includeIf('admin.guides.relationships.guideExperiences', ['experiences' => $guide->experience])
        </div>
        <div class="tab-pane" role="tabpanel" id="guide_followings">
            @includeIf('admin.guides.relationships.guideFollowings', ['followings' => $guide->follower])
        </div>
    </div>
</div>
</div>
</div>
@endsection