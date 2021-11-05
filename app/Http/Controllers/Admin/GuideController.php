<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGuideRequest;
use App\Http\Requests\StoreGuideRequest;
use App\Http\Requests\UpdateGuideRequest;
use App\Models\Guide;
use App\Models\User;
use App\Models\Role;
use App\Models\Language;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;

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

        $naitev_languages = Language::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speaking_languages = Language::pluck('name_en', 'id');
        
        $roles = Role::pluck('title', 'id');

        return view('admin.guides.create', compact('roles', 'naitev_languages', 'speaking_languages'));
    
    }

    public function store(StoreGuideRequest $request)
    {
   
     $user = User::create([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),   
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'user_type' => 'guide',
        ]);
        $user->roles()->sync($request->input('roles', []));
        $user->speaking_languages()->sync($request->input('speaking_languages', []));
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $guide = Guide::create([
                  'brief_intro'=>$request->brief_intro,
                  'driving_licence'=>$request->driving_licence,
                  'car'=>$request->car,
                  'degree'=>$request->degree,
                  'major'=>$request->major,
                  'cost'=>$request->cost,
                  'user_id'=>$user->id,

        ]);

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.guides.index');
    }

    public function edit(Guide $guide)
    {
        abort_if(Gate::denies('guide_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guide->load('user');

        
        $naitev_languages = Language::pluck('name_en', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speaking_languages = Language::pluck('name_en', 'id');

        return view('admin.guides.edit', compact('users', 'guide','naitev_languages','speaking_languages'));
    }

    public function update(UpdateGuideRequest $request, Guide $guide)
    {
        $guide->update($request->all());
        
        $user=User::findOrfail($guide->user_id);
        
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

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyGuideRequest $request)
    {
        Guide::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
