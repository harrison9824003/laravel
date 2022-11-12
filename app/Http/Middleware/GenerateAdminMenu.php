<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\DataType;

class GenerateAdminMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $datatype = app(DataType::class);
        $data = $datatype->select(['name', 'icon', 'folder_id', 'router_path'])
            ->where('disabled', '=', '0')
            ->orderByDesc('folder_id')->get();
        $admin_menus = [];
        foreach ($data as $k => $v) {
            $admin_menus[$v->folder_id][] = $v;
        }
        View::share('admin_menus', $admin_menus);
        return $next($request);
    }
}
