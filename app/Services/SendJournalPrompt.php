<?php

namespace App\Services;

use App\User;
use App\JournalEntry;
use App\Jobs\SendPromptJob;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class SendJournalPrompt
{
    public function handle()
    {
        $users = User::all();

        $users->each(function ($user) {
            $journalEntry = new JournalEntry([
                'user_id' => $user->id
            ]);

            $user->journalEntries()->save($journalEntry);

            SendPromptJob::dispatch($journalEntry);
            
            // Mail::to($user->email)
            // ->queue(new JournalPromptMail($journalEntry));
        });
    }
}
