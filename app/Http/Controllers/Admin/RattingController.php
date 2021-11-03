<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRattingRequest;
use App\Http\Requests\StoreRattingRequest;
use App\Http\Requests\UpdateRattingRequest;
use App\Models\Guide;
use App\Models\Ratting;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RattingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ratting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rattings = Ratting::with(['guide', 'user'])->get();

        return view('admin.rattings.index', compact('rattings'));
    }

    public function create()
    {
        abort_if(Gate::denies('ratting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rattings.create', compact('guides', 'users'));
    }

    public function store(StoreRattingRequest $request)
    {
        $ratting = Ratting::create($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.rattings.index');
    }

    public function edit(Ratting $ratting)
    {
        abort_if(Gate::denies('ratting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ratting->load('guide', 'user');

        return view('admin.rattings.edit', compact('guides', 'users', 'ratting'));
    }

    public function update(UpdateRattingRequest $request, Ratting $ratting)
    {
        $ratting->update($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.rattings.index');
    }

    public function show(Ratting $ratting)
    {
        abort_if(Gate::denies('ratting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ratting->load('guide', 'user');

        return view('admin.rattings.show', compact('ratting'));
    }

    public function destroy(Ratting $ratting)
    {
        abort_if(Gate::denies('ratting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ratting->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyRattingRequest $request)
    {
        Ratting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
