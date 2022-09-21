<?php

namespace App\Http\Controllers;

use App\Models\Kategorije;
use App\Models\MaliOglasi;
use App\Models\Regije;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var array
     */
    protected array $shared = [];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->viewShare();

            return $next($request);
        });
    }

    /**
     * @return bool
     */
    protected function viewShare(): bool
    {
        if (count($this->shared)) return false;

        $categories = cache()->remember('header-categories', 60*60*24, function () {
            return Kategorije::query()
                ->where(['status' => true, 'parent_id' => null])
                ->whereHas('maliOglasesTip0')
                ->with(['children.maliOglasesTip1'])
                ->withCount(['maliOglasesTip0'])
                ->orderBy('vrstni_red')
                ->get();
        });
        $allProductsCount = cache()->remember('allProductsCount', 60*60*24, function () {
            return MaliOglasi::query()
                ->where(['status' => true])
                ->count();
        });
        $regions = Regije::getSlovenianRegions();

        $this->shared = [
            'categories' => $categories,
            'allProductsCount' => $allProductsCount,
            'regions' => $regions,
        ];

        view()->share($this->shared);

        if (Auth::check()) {
            $user = User::query()->where('id', auth()->user()->id)->first();

            if (!empty($user)) {
                //$user->last_activity_at = Carbon::now()->toDateTimeString();
                //$user->save();
            }
        }

        return true;
    }

    /**
     * @param $items
     * @param int $perPage
     * @param $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    public function paginate($items, int $perPage = 1000, $page = null, array $options = []): LengthAwarePaginator
    {
        if (!isset($options['path'])) {
            $options['path'] = LengthAwarePaginator::resolveCurrentPath();
        }
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
