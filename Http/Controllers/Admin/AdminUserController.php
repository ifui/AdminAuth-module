<?php

namespace Modules\AdminAuth\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Modules\AdminAuth\Entities\AdminUser;
use Modules\AdminAuth\Http\Requests\Admin\AdminUserRequest;
use Modules\AdminAuth\QueryBuilder\Models\AdminUserQuery;
use Spatie\QueryBuilder\QueryBuilder;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $this->authorize('onlySuperAdmin');

        $model = QueryBuilder::for(AdminUser::class)
            ->allowedFilters(AdminUserQuery::filter())
            ->allowedSorts(AdminUserQuery::sort())
            ->allowedIncludes(AdminUserQuery::include())
            ->paginate(request()->get('pageSize'));

        return success($model);
    }

    /**
     * Store a newly created resource in storage.
     * @param AdminUserRequest $request
     * @return Response
     */
    public function store(AdminUserRequest $request)
    {
        $this->authorize('onlySuperAdmin');

        $model = new AdminUser();
        $model->fill($request->validated());
        $model->uuid = (string) Str::uuid();
        $admin_user = $model->save();

        return resultStatus($admin_user);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $model = QueryBuilder::for(AdminUser::class)
            ->allowedIncludes(AdminUserQuery::include())
            ->findOrFail($id);

        $this->authorize('isOwner', $model);


        return result($model);
    }

    /**
     * Update the specified resource in storage.
     * @param AdminUserRequest $request
     * @param int $id
     * @return Response
     */
    public function update(AdminUserRequest $request, $id)
    {
        $model = AdminUser::findOrFail($id);

        $this->authorize('isOwner', $model);

        $model->fill($request->validated());

        return resultStatus($model->save());
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('onlySuperAdmin');

        $model = AdminUser::findOrFail($id);

        return resultStatus($model->delete());
    }
}
