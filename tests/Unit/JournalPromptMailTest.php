<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\JournalEntry;
use App\Jobs\SendPromptJob;

class JournalPromptMailJobTest extends TestCase
{

    public function testThisCreatesAMailable()
    {
        $journalEntry = factory(JournalEntry::class)->create();
        $job = new SendPromptJob($journalEntry);

        $job->handle();

        $this->assertDatabaseHas('email_histories', ['recipient_id' => $journalEntry->user_id]);
    }
}
