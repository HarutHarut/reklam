<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MaliOglasi;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
//        dd(Carbon::today());
        $date = $date = Carbon::now()->subDays(365);
        $companyUser = User::query()
            ->where('created_at', '>=', $date)
            ->whereHas('customer.customersTrgovinas')
            ->count();

        $regularUser = User::query()
            ->where('created_at', '>=', $date)
            ->whereDoesntHave('customer.customersTrgovinas')
            ->count();

        $nonLoggedListing = MaliOglasi::query()
            ->where('datum_vnosa', '>=', $date)
            ->where('user_id', config('constants.nonLoggedUser'))
            ->count();

        $loggedListing = MaliOglasi::query()
            ->where('datum_vnosa', '>=', $date)
            ->where('user_id', '!=', config('constants.nonLoggedUser'))
            ->count();

        $deactivatedListings = MaliOglasi::query()
//            ->where('datum_vnosa', '>=', $date)
            ->where('status', 0)
            ->count();

        $expiredListings = MaliOglasi::query()
            ->where('datum_vnosa', '>=', $date)
            ->where('datum_poteka', '<=', now())
            ->count();

        $totalRevenue = Order::query()
            ->where('cu_datum', '>=', Carbon::today()->format('Y-m-d H:i:s'))
            ->sum('cu_znesek');

        return view('dashboard.index', compact(
            'regularUser',
            'companyUser',
            'nonLoggedListing',
            'loggedListing',
            'deactivatedListings',
            'expiredListings',
            'totalRevenue'
        ));
    }
}
