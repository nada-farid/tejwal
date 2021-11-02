<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTripRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Guide;
use App\Models\Trip;
use App\Models\TripCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TripsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('trip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trips = Trip::with(['guide', 'trip_categories', 'media'])->get();

        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        abort_if(Gate::denies('trip_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trip_categories = TripCategory::pluck('name_ar', 'id');

        return view('admin.trips.create', compact('guides', 'trip_categories'));
    }

    public function store(StoreTripRequest $request)
    {
        $trip = Trip::create($request->all());
        $trip->trip_categories()->sync($request->input('trip_categories', []));
        foreach ($request->input('photo', []) as $file) {
            $trip->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $trip->id]);
        }

        return redirect()->route('admin.trips.index');
    }

    public function edit(Trip $trip)
    {
        abort_if(Gate::denies('trip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        $trip_categories = TripCategory::pluck('name_ar', 'id');

        $trip->load('guide', 'trip_categories');

        return view('admin.trips.edit', compact('guides', 'trip_categories', 'trip'));
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $trip->update($request->all());
        $trip->trip_categories()->sync($request->input('trip_categories', []));
        if (count($trip->photo) > 0) {
            foreach ($trip->photo as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $trip->photo->pluck('file_name')->toArray();
        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $trip->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photo');
            }
        }

        return redirect()->route('admin.trips.index');
    }

    public function show(Trip $trip)
    {
        abort_if(Gate::denies('trip_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->load('guide', 'trip_categories');

        return view('admin.trips.show', compact('trip'));
    }

    public function destroy(Trip $trip)
    {
        abort_if(Gate::denies('trip_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trip->delete();

        return back();
    }

    public function massDestroy(MassDestroyTripRequest $request)
    {
        Trip::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('trip_create') && Gate::denies('trip_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Trip();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
