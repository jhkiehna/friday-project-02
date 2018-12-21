<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\SendJournalPrompt;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\JournalPromptMail;


class SendJournalPromptTest extends TestCase
{

    public function testSendJournalPromptCreatesABlankDailyJournalEntryAllUsers()
    {
        Mail::fake();
        $service = new SendJournalPrompt();
        $users = factory(User::Class, 3)->create();

        $service->handle();

        $users->each(function($user) {
            $this->assertDatabaseHas('journal_entries', ['user_id' => $user->id]);
        });
        Mail::assertQueued(JournalPromptMail::class);
    }
}
