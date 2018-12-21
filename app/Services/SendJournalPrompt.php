<?php

namespace App\Services;

use App\User;
use App\JournalEntry;

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
        });
    }
}
