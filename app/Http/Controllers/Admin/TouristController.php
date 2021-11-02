<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTouristRequest;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use App\Models\Tourist;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TouristController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tourist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tourists = Tourist::with(['user'])->get();

        return view('admin.tourists.index', compact('tourists'));
    }

    public function create()
    {
        abort_if(Gate::denies('tourist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tourists.create', compact('users'));
    }

    public function store(StoreTouristRequest $request)
    {
        $tourist = Tourist::create($request->all());

        return redirect()->route('admin.tourists.index');
    }

    public function edit(Tourist $tourist)
    {
        abort_if(Gate::denies('tourist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tourist->load('user');

        return view('admin.tourists.edit', compact('users', 'tourist'));
    }

    public function update(UpdateTouristRequest $request, Tourist $tourist)
    {
        $tourist->update($request->all());

        return redirect()->route('admin.tourists.index');
    }

    public function show(Tourist $tourist)
    {
        abort_if(Gate::denies('tourist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tourist->load('user');

        return view('admin.tourists.show', compact('tourist'));
    }

    public function destroy(Tourist $tourist)
    {
        abort_if(Gate::denies('tourist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tourist->delete();

        return back();
    }

    public function massDestroy(MassDestroyTouristRequest $request)
    {
        Tourist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
