<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFavoriteRequest;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Favorite;
use App\Models\Trip;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('favorite_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $favorites = Favorite::with(['user', 'trip'])->get();

        return view('admin.favorites.index', compact('favorites'));
    }

    public function create()
    {
        abort_if(Gate::denies('favorite_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.favorites.create', compact('users', 'trips'));
    }

    public function store(StoreFavoriteRequest $request)
    {
        $favorite = Favorite::create($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.favorites.index');
    }

    public function edit(Favorite $favorite)
    {
        abort_if(Gate::denies('favorite_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trips = Trip::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $favorite->load('user', 'trip');


        return view('admin.favorites.edit', compact('users', 'trips', 'favorite'));
    }

    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        $favorite->update($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.favorites.index');
    }

    public function show(Favorite $favorite)
    {
        abort_if(Gate::denies('favorite_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $favorite->load('user', 'trip');

        return view('admin.favorites.show', compact('favorite'));
    }

    public function destroy(Favorite $favorite)
    {
        abort_if(Gate::denies('favorite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $favorite->delete();

        return back();
    }

    public function massDestroy(MassDestroyFavoriteRequest $request)
    {
        Favorite::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
