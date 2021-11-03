<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTripCategoryRequest;
use App\Http\Requests\StoreTripCategoryRequest;
use App\Http\Requests\UpdateTripCategoryRequest;
use App\Models\TripCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TripCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('trip_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tripCategories = TripCategory::all();

        return view('admin.tripCategories.index', compact('tripCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('trip_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tripCategories.create');
    }

    public function store(StoreTripCategoryRequest $request)
    {
        $tripCategory = TripCategory::create($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));


        return redirect()->route('admin.trip-categories.index');
    }

    public function edit(TripCategory $tripCategory)
    {
        abort_if(Gate::denies('trip_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tripCategories.edit', compact('tripCategory'));
    }

    public function update(UpdateTripCategoryRequest $request, TripCategory $tripCategory)
    {
        $tripCategory->update($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));


        return redirect()->route('admin.trip-categories.index');
    }

    public function show(TripCategory $tripCategory)
    {
        abort_if(Gate::denies('trip_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tripCategories.show', compact('tripCategory'));
    }

    public function destroy(TripCategory $tripCategory)
    {
        abort_if(Gate::denies('trip_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tripCategory->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));


        return back();
    }

    public function massDestroy(MassDestroyTripCategoryRequest $request)
    {
        TripCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
