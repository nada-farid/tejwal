<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLanguageRequest;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class LanguageController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('language_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $languages = Language::with(['media'])->get();

        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        abort_if(Gate::denies('language_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.languages.create');
    }

    public function store(StoreLanguageRequest $request)
    {
        $language = Language::create($request->all());

        if ($request->input('icon', false)) {
            $language->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $language->id]);
        }

        return redirect()->route('admin.languages.index');
    }

    public function edit(Language $language)
    {
        abort_if(Gate::denies('language_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.languages.edit', compact('language'));
    }

    public function update(UpdateLanguageRequest $request, Language $language)
    {
        $language->update($request->all());

        if ($request->input('icon', false)) {
            if (!$language->icon || $request->input('icon') !== $language->icon->file_name) {
                if ($language->icon) {
                    $language->icon->delete();
                }
                $language->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($language->icon) {
            $language->icon->delete();
        }

        return redirect()->route('admin.languages.index');
    }

    public function show(Language $language)
    {
        abort_if(Gate::denies('language_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.languages.show', compact('language'));
    }

    public function destroy(Language $language)
    {
        abort_if(Gate::denies('language_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $language->delete();

        return back();
    }

    public function massDestroy(MassDestroyLanguageRequest $request)
    {
        Language::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('language_create') && Gate::denies('language_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Language();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
