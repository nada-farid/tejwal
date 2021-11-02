<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGuideRequest;
use App\Http\Requests\StoreGuideRequest;
use App\Http\Requests\UpdateGuideRequest;
use App\Models\Guide;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuideController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('guide_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::with(['user'])->get();

        return view('admin.guides.index', compact('guides'));
    }

    public function create()
    {
        abort_if(Gate::denies('guide_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.guides.create', compact('users'));
    }

    public function store(StoreGuideRequest $request)
    {
        $guide = Guide::create($request->all());

        return redirect()->route('admin.guides.index');
    }

    public function edit(Guide $guide)
    {
        abort_if(Gate::denies('guide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guide->load('user');

        return view('admin.guides.edit', compact('users', 'guide'));
    }

    public function update(UpdateGuideRequest $request, Guide $guide)
    {
        $guide->update($request->all());

        return redirect()->route('admin.guides.index');
    }

    public function show(Guide $guide)
    {
        abort_if(Gate::denies('guide_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guide->load('user');

        return view('admin.guides.show', compact('guide'));
    }

    public function destroy(Guide $guide)
    {
        abort_if(Gate::denies('guide_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guide->delete();

        return back();
    }

    public function massDestroy(MassDestroyGuideRequest $request)
    {
        Guide::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
