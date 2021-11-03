<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTouristRequest;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use App\Models\Tourist;
use App\Models\User;
use App\Models\Language;
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

        $naitev_languages = Language::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speaking_languages = Language::pluck('name_en', 'id');

        return view('admin.tourists.create', compact('users','naitev_languages','speaking_languages'));
    }

    public function store(StoreTouristRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->speaking_languages()->sync($request->input('speaking_languages', []));
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $tourist = Tourist::create([
            'user_id'=>$user->id,
        ]);

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.tourists.index');
    }

    public function edit(Tourist $tourist)
    {
        abort_if(Gate::denies('tourist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        
        $naitev_languages = Language::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speaking_languages = Language::pluck('name_en', 'id');

        $tourist->load('user');

        return view('admin.tourists.edit', compact('users', 'tourist','naitev_languages','speaking_languages'));
    }

    public function update(UpdateTouristRequest $request, Tourist $tourist)
    {
        
        $user=User::findOrfail($tourist->user_id);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->speaking_languages()->sync($request->input('speaking_languages', []));
        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }
        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));
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

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));


        return back();
    }

    public function massDestroy(MassDestroyTouristRequest $request)
    {
        Tourist::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
