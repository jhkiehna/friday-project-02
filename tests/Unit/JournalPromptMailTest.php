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
        $journalEntry = factory(JournalEntry::class)->create();
        $mail = new JournalPromptMail($journalEntry);

        $mail->build();

        $this->assertDatabaseHas('email_histories', ['recipient_id' => $journalEntry->user_id]);
    }
}
