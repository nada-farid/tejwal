<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFollowingRequest;
use App\Http\Requests\StoreFollowingRequest;
use App\Http\Requests\UpdateFollowingRequest;
use App\Models\Following;
use App\Models\Guide;
use App\Models\User;
use App\Models\Tourist;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;


class FollowingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('following_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $followings = Following::with(['guide', 'Tourist'])->get();

        return view('admin.followings.index', compact('followings'));
    }

    public function create()
    {
        abort_if(Gate::denies('following_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = Tourist::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.followings.create', compact('guides', 'users'));
    }

    public function store(StoreFollowingRequest $request)
    {
        $following = Following::create($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.followings.index');
    }

    public function edit(Following $following)
    {
        abort_if(Gate::denies('following_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = Tourist::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $following->load('guide', 'Tourist');

        return view('admin.followings.edit', compact('guides', 'users', 'following'));
    }

    public function update(UpdateFollowingRequest $request, Following $following)
    {
        $following->update($request->all());
        
        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

  
        return redirect()->route('admin.experiences.show',  $following->id);
    }

    public function show(Following $following)
    {
        abort_if(Gate::denies('following_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $following->load('guide', 'Tourist');

        return view('admin.followings.show', compact('following'));
    }

    public function destroy(Following $following)
    {
        abort_if(Gate::denies('following_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $following->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyFollowingRequest $request)
    {
        Following::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
