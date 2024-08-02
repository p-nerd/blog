<?php

namespace App\Services;

use App\Contracts\EmailMarketer;
use MailchimpMarketing\ApiClient as Mailchimp;

class MailchimpEmailMarketer implements EmailMarketer
{
    public function __construct(
        protected mixed $mailchimp,
        protected string $newsletterAudienceID
    ) {
        //
    }

    public static function build(): static
    {
        $mailchimp = new Mailchimp;

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.api_key'),
            'server' => config('services.mailchimp.server_prefix'),
        ]);

        return new static(
            mailchimp: $mailchimp,
            newsletterAudienceID: config('services.mailchimp.newsletter_audience_id')
        );
    }

    public function subscribeToNewsletter(string $email)
    {
        return $this->mailchimp->lists->addListMember(
            $this->newsletterAudienceID,
            [
                'email_address' => $email,
                'status' => 'subscribed',
            ]
        );
    }
}
