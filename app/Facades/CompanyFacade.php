<?php

namespace App\Facades;

use App\Models\Company;
use Illuminate\Support\Facades\Facade;

/**
 * Class CompanyFacade
 * @package App\Facades
 *
 * @method static Company create(array $data)
 * @method static Company update(array $data, Company $company)
 * @method static void delete(Company $company)
 * @method static void sendEmail(Company $company)
 */

class CompanyFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'company_service_facade';
    }
}
