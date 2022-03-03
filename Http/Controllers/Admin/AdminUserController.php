<?php

namespace Modules\AdminAuth\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminAuth\Entities\AdminUser;
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
