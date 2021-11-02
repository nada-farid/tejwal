<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFollowingRequest;
use App\Http\Requests\StoreFollowingRequest;
use App\Http\Requests\UpdateFollowingRequest;
use App\Models\Following;
use App\Models\Guide;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FollowingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('following_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $followings = Following::with(['guide', 'user'])->get();

        return view('admin.followings.index', compact('followings'));
    }

    public function create()
    {
        abort_if(Gate::denies('following_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.followings.create', compact('guides', 'users'));
    }

    public function store(StoreFollowingRequest $request)
    {
        $following = Following::create($request->all());

        return redirect()->route('admin.followings.index');
    }

    public function edit(Following $following)
    {
        abort_if(Gate::denies('following_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $following->load('guide', 'user');

        return view('admin.followings.edit', compact('guides', 'users', 'following'));
    }

    public function update(UpdateFollowingRequest $request, Following $following)
    {
        $following->update($request->all());

        return redirect()->route('admin.followings.index');
    }

    public function show(Following $following)
    {
        abort_if(Gate::denies('following_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $following->load('guide', 'user');

        return view('admin.followings.show', compact('following'));
    }

    public function destroy(Following $following)
    {
        abort_if(Gate::denies('following_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $following->delete();

        return back();
    }

    public function massDestroy(MassDestroyFollowingRequest $request)
    {
        Following::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
