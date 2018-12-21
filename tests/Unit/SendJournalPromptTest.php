<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\SendJournalPrompt;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendPromptJob;
use Illuminate\Support\Facades\Queue;


class SendJournalPromptTest extends TestCase
{

    public function testSendJournalPromptCreatesABlankDailyJournalEntryAllUsers()
    {
        // Mail::fake();
        Queue::fake();
        $service = new SendJournalPrompt();
        $users = factory(User::Class, 3)->create();

        $service->handle();

        $users->each(function($user) {
            $this->assertDatabaseHas('journal_entries', ['user_id' => $user->id]);
        });
        // Mail::assertQueued(JournalPromptMail::class);
        Queue::assertPushed(SendPromptJob::class);
    }
}
