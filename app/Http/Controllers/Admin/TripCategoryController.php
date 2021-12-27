<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTripCategoryRequest;
use App\Http\Requests\StoreTripCategoryRequest;
use App\Http\Requests\UpdateTripCategoryRequest;
use App\Models\TripCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TripCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('trip_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tripCategories = TripCategory::with(['media'])->get();

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

        if ($request->input('icon', false)) {
            $tripCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $tripCategory->id]);
        }

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

        if ($request->input('icon', false)) {
            if (!$tripCategory->icon || $request->input('icon') !== $tripCategory->icon->file_name) {
                if ($tripCategory->icon) {
                    $tripCategory->icon->delete();
                }
                $tripCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($tripCategory->icon) {
            $tripCategory->icon->delete();
        }

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

        return back();
    }

    public function massDestroy(MassDestroyTripCategoryRequest $request)
    {
        TripCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('trip_category_create') && Gate::denies('trip_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TripCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}










