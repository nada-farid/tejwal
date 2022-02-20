<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTouristRequest;
use App\Http\Requests\StoreTouristRequest;
use App\Http\Requests\UpdateTouristRequest;
use App\Models\Tourist;
use App\Models\User;
use App\Models\Language;
use App\Models\Country;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;

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

        $name='name_'.app()->getlocale();

        $naitev_languages = Language::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $speaking_languages = Language::all();
        
        $countries=Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tourists.create', compact('users','naitev_languages','speaking_languages','countries'));
    }

    public function store(StoreTouristRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),   
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'city' => $request->city,
            'dob' => $request->dob,
            'naitev_language_id'=> $request->naitev_language_id,
            'gender' => $request->gender,
            'user_type' => 'tourist',
        ]);
        $user->roles()->sync($request->input('roles', []));
        $user->speaking_languages()->sync($this->mapLevels($request['levels']));
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

        $name='name_'.app()->getlocale();

        $naitev_languages = Language::pluck($name, 'id')->prepend(trans('global.pleaseSelect'), '');

        $speaking_languages = collect(Language::get())->map(function($speaking_language) use ($tourist) {
            $check =$tourist->user->speaking_languages()->wherePivot('language_id',$speaking_language['id'])->first();
            $speaking_language['value'] = $check ? 1 : null;
            $speaking_language['level'] = $check ? $check->pivot->level : null; 

            return $speaking_language;
        });

        $countries=Country::pluck('name', 'id');

        $tourist->load('user');

        return view('admin.tourists.edit', compact('users', 'tourist','naitev_languages','speaking_languages','countries'));
    }

    public function update(UpdateTouristRequest $request, Tourist $tourist)
    {
    
        $user=User::findOrfail($tourist->user_id);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->speaking_languages()->sync($this->mapLevels($request['levels']));
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

    private function mapLevels($levels)
    {
        return collect($levels)->map(function ($i) {
            return ['level' => $i];
        });
    }
    }
    
