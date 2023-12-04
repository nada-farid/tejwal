<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Tourist;
use App\Models\Language;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;
use App\Models\LanguagePost;

class PostsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $posts = Post::with(['Tourist','languages.language'])->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = Tourist::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');
        $langs = Language::pluck('name_ar', 'id');

        return view('admin.posts.create', compact('users','langs'));
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        foreach($request->langs as $lang){
            $postlang = LanguagePost::Create([
                'post_id' => $post->id,
                'language_id' => $lang,
            ]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post)
    {
        abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = Tourist::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $langs = Language::pluck('name_ar', 'id');

        $post->load('Tourist');

        return view('admin.posts.edit', compact('users', 'post','langs'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        $post->languages()->delete();
        foreach($request->langs as $lang){
            $postlang = LanguagePost::Create([
                'post_id' => $post->id,
                'language_id' => $lang,
            ]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));

        return redirect()->route('admin.posts.index');
    }

    public function show(Post $post)
    {
        abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->load('Tourist','language');

        return view('admin.posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));
        return back();
    }

    public function massDestroy(MassDestroyPostRequest $request)
    {
        Post::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
