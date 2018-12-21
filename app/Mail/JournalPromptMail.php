<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\JournalEntry;

class JournalPromptMail extends Mailable
{
    use Queueable, SerializesModels;

    private $journalEntry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(JournalEntry $journalEntry)
    {
        $this->journalEntry = $journalEntry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }
}
