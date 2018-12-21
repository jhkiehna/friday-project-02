<?php

namespace App\Mailers;

use Exception;
use Mailgun\Mailgun;
use App\User;
use App\EmailHistory;

class MailgunMailer
{
    protected $auth;
    protected $domain;
    protected $mailgun;

    /**
     * MailgunMailer constructor.
     */
    public function __construct()
    {
        $this->auth = config('services.mailgun.secret');
        $this->domain = config('services.mailgun.domain');
        $this->mailgun = Mailgun::create($this->auth);
    }

    public function sendEmail($journalEntry)
    {
        try {
            $result = $this->mailgun->messages()->send(
                $this->domain,
                $this->buildEmail($journalEntry)
            );
            return $result;
        } catch (Exception $e) {
            info($e->getCode() . ': ' . $e->getMessage());
            return [];
        }
    }

    public function buildEmail($journalEntry)
    {
        $user = User::findOrFail($journalEntry->user_id);
        $history = EmailHistory::findOrFail($journalEntry->email_history_id);

        $mailParams = [
            'from'          => 'JournalApp@kimmel.digital.com',
            'to'            => $user->email,
            'subject'       => 'Journal Prompt',
            'text'          => view('email.journalPrompt', $history)->render(),
            'html'          => view('email.journalPrompt', $history)->render(),
            'v:history_id'  => $journalEntry->email_history_id,
        ];

        return $mailParams;
    }

    public function setResponse($response, $history)
    {
        if (isset($response->http_response_body)) {
            $history->message_id = $response->http_response_body->id;
            $history->save();
        }
    }
}
