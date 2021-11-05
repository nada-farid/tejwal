<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyExperienceRequest;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use App\Models\Guide;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;


class ExperienceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('experience_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experiences = Experience::with(['guide'])->get();

        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        abort_if(Gate::denies('experience_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.experiences.create', compact('guides'));
    }

    public function store(StoreExperienceRequest $request)
    {
        $experience = Experience::create($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.experiences.index');
    }

    public function edit(Experience $experience)
    {
        abort_if(Gate::denies('experience_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $guides = Guide::pluck('brief_intro', 'id')->prepend(trans('global.pleaseSelect'), '');

        $experience->load('guide');

        return view('admin.experiences.edit', compact('guides', 'experience'));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->all());

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.experiences.index');
    }

    public function show(Experience $experience)
    {
        abort_if(Gate::denies('experience_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experience->load('guide');

        return view('admin.experiences.show', compact('experience'));
    }

    public function destroy(Experience $experience)
    {
        abort_if(Gate::denies('experience_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $experience->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));

        return back();
    }

    public function massDestroy(MassDestroyExperienceRequest $request)
    {
        Experience::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
