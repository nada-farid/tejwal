<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrganizationRequest;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Models\Organization;
use App\Models\Specialization;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrganizationsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('organization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Organization::with(['user', 'specializations'])->select(sprintf('%s.*', (new Organization)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'organization_show';
                $editGate      = 'organization_edit';
                $deleteGate    = 'organization_delete';
                $crudRoutePart = 'organizations';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('organization_name', function ($row) {
                return $row->organization_name ? $row->organization_name : '';
            });
            $table->editColumn('commerical_record', function ($row) {
                return $row->commerical_record ? $row->commerical_record : '';
            });
            $table->editColumn('activites', function ($row) {
                return $row->activites ? $row->activites : '';
            });
            $table->editColumn('specialization', function ($row) {
                $labels = [];
                foreach ($row->specializations as $specialization) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $specialization->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('website', function ($row) {
                return $row->website ? $row->website : '';
            });
            $table->editColumn('latitude', function ($row) {
                return $row->latitude ? $row->latitude : '';
            });
            $table->editColumn('longitude', function ($row) {
                return $row->longitude ? $row->longitude : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'specialization', 'logo']);

            return $table->make(true);
        }

        return view('admin.organizations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('organization_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = Specialization::pluck('name', 'id');

        return view('admin.organizations.create', compact('specializations', 'users'));
    }

    public function store(StoreOrganizationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),   
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city, 
            'user_type' => 'organization',
        ]);
        
        $organization = Organization::create([ 
            'user_id' => $user->id,
            'organization_name' => $request->organization_name,
            'commerical_record' => $request->commerical_record,
            'activites' => $request->activites,
            'website' => $request->website,
        ]);

        $organization->specializations()->sync($request->input('specializations', []));
        if ($request->input('logo', false)) {
            $organization->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $organization->id]);
        }

        return redirect()->route('admin.organizations.index');
    }

    public function edit(Organization $organization)
    {
        abort_if(Gate::denies('organization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = Specialization::pluck('name', 'id');

        $organization->load('user', 'specializations');

        return view('admin.organizations.edit', compact('organization', 'specializations', 'users'));
    }

    public function update(UpdateOrganizationRequest $request, Organization $organization)
    {
        $organization->update([ 
            'organization_name' => $request->organization_name,
            'commerical_record' => $request->commerical_record,
            'activites' => $request->activites,
            'website' => $request->website,
        ]);
        $user = User::find($organization->user_id);
        $user->update([
            'name' => $request->name,
            'last_name'=>$request->last_name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password, 
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city, 
        ]);
        $organization->specializations()->sync($request->input('specializations', []));
        if ($request->input('logo', false)) {
            if (! $organization->logo || $request->input('logo') !== $organization->logo->file_name) {
                if ($organization->logo) {
                    $organization->logo->delete();
                }
                $organization->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($organization->logo) {
            $organization->logo->delete();
        }

        return redirect()->route('admin.organizations.index');
    }

    public function show(Organization $organization)
    {
        abort_if(Gate::denies('organization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organization->load('user', 'specializations');

        return view('admin.organizations.show', compact('organization'));
    }

    public function destroy(Organization $organization)
    {
        abort_if(Gate::denies('organization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organization->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganizationRequest $request)
    {
        $organizations = Organization::find(request('ids'));

        foreach ($organizations as $organization) {
            $organization->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('organization_create') && Gate::denies('organization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Organization();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
