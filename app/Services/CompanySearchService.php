<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;

class CompanySearchService
{
    /**
     * @var string
     */
    private string $domain;

    /**
     * @var string
     */
    private string $key;

    public function __construct()
    {
        $this->domain = config('services.companySearch.domain');
        $this->key = config('services.companySearch.key');
    }

    /**
     * @param $taxNumber
     * @return mixed
     * @throws GuzzleException
     */
    public function getCompanyByTaxNumber($taxNumber): mixed
    {
        // TODO tmp varibale
//        $taxNumber = '91861276';
        try {
            $httpClient = new Client(['verify' => false ]);
            $request = $httpClient->get($this->buildHttpRequest($this->domain, $this->key, $taxNumber));

            return json_decode($request->getBody()->getContents());

        } catch (\Exception $e) {
            return redirect()->route('payment.status')->with('message', __('Something was wrong'));
        }
    }

    /**
     * @param $domain
     * @param $key
     * @param $taxNumber
     * @param int $limit
     * @return string
     */
    private static function buildHttpRequest($domain, $key, $taxNumber, int $limit = 1): string
    {
        return $domain . '?' . 'key=' . $key . '&search=' . $taxNumber . '&limit=' . $limit;
    }
}
