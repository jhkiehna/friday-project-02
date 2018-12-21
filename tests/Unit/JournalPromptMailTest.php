<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\JournalEntry;
use App\Mail\JournalPromptMail;

class JournalPromptMailTest extends TestCase
{

    public function testThisCreatesAMailable()
    {
        $user = factory(User::class)->create();
        $journalEntry = factory(JournalEntry::class)->create([
            'user_id' => $user->id
        ]);


        $job->handle();
    }
}
