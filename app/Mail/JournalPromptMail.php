<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\JournalEntry;
use App\EmailHistory;

class JournalPromptMail extends Mailable
{
    use Queueable, SerializesModels;

    private $journalEntry;
    public $prompt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JournalEntry $journalEntry)
    {
        $this->journalEntry = $journalEntry;
        $prompts = collect(config('journal.prompts'));
        $this->prompt = $prompts->random();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        EmailHistory::create([
            'recipient_id' => $this->journalEntry->user_id,
            'prompt' => $this->prompt
        ]);

        return $this->view('email.journalPrompt')
        ->text('email.journalPromptText');
    }
}
