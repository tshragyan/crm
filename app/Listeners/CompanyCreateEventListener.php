<?php

namespace App\Listeners;

use App\Events\CompanyCreatedEvent;
use App\Facades\CompanyFacade;
use App\Mail\CompanyCreatedEmail;
use App\Services\CompanyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CompanyCreateEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreatedEvent $event): void
    {
        CompanyFacade::sendEmail($event->company);
    }
}
