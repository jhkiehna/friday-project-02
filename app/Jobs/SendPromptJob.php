<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\JournalEntry;
use App\EmailHistory;
use App\Mailers\MailgunMailer;

class SendPromptJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $journalEntry;
    public $prompt;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $emailhistory = EmailHistory::create([
            'recipient_id' => $this->journalEntry->user_id,
            'prompt' => $this->prompt
        ]);

        $this->journalEntry->update([
            'email_history_id' => $emailhistory->id
        ]);

        $mailer = new MailgunMailer();

        $mailer->sendEmail($this->journalEntry);
    }
}
