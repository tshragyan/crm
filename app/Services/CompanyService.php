<?php


namespace App\Services;


use App\Models\Company;
use Illuminate\Support\Facades\Log;
use Mailgun\Mailgun;

class CompanyService
{

    public function create(array $data): Company
    {
        $path = null;
        if (!empty($data['logo'])) {
            $path = $data['logo']->store('logos', 'public');
        }

        $company = new Company();
        $company->name = $data['name'];
        $company->email = $data['email'] ?? null;
        $company->website = $data['website'] ?? null;
        $company->logo = $path;
        $company->save();

        return $company;
    }

    public function update(array $data, Company $company): Company
    {
        $company->name = $data['name'];
        $company->email = $data['email'];
        $company->website = $data['website'];

        if (!empty($data['logo'])) {
            $path = $data['logo']->store('logos', 'public');
            if ($company->logo) {
                \File::delete(public_path('storage/'.$company->logo));
            }
            $company->logo = $path;
        }

        $company->save();

        return $company;
    }

    public function delete(Company $company): void
    {
        \File::delete(public_path('storage/'.$company->logo));
        $company->delete();
    }

    public function sendEmail(Company $company): void
    {
        try {
            $mailgun = Mailgun::create(config('mail.mailers.mailgun.api_key'), 'https://api.eu.mailgun.net');
            $mailgun->messages()->send(config('mail.mailers.mailgun.domain'), [
                'from'    => config('mail.mailers.mailgun.from_email'),
                'to'      => config('app.admin_email'),
                'subject' => 'The Company Added',
                'text'    => view('company.email', compact('company'))->render()
            ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }


    }

}
