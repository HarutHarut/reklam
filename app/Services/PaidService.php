<?php

namespace App\Services;

/**
 * Class PaidService
 * @package App\Services
 */
class PaidService
{
    /**
     * @return bool
     */
    public static function checkPremiumPackage()
    {
        $customer = auth()->user()->customer;
        $package = $customer->activePackage->paidItem->title;
        if (strpos($package, 'Premium') !== false) {
            return 1;
        }
        return 0;
    }

    /**
     * @param $query
     * @param $data
     * @return mixed
     */
    public static function orderFilters($query, $data)
    {
        if(isset($data['status']) && $data['status'] !== '' && $data['status'] !== null){
            $query = $query->where('cu_status_placila', $data['status']);
        }

        if (isset($data['search']) && $data['search'] !== '') {
            $query = $query->where(function ($q) use ($data) {
                $q->where('cu_naziv', 'like', '%' . $data['search'] . '%')
                    ->orWhereHas('customer.user', function ($query) use ($data) {
                        $query->where('name', 'like', '%' . $data['search'] .'%');
                    })
                    ->orWhere('id', 'like', '%' . $data['search'] . '%')
                    ->orWhere('cu_posta', 'like', '%' . $data['search'] . '%')
                    ->orWhere('cu_naslov', 'like', '%' . $data['search'] . '%');
            });
        }
        return $query;
    }
}
