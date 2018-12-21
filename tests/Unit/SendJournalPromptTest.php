<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\SendJournalPrompt;
use App\User;
use Illuminate\Support\Facades\Queue;
use App\Jobs\JournalPromptEmailJob;

class SendJournalPromptTest extends TestCase
{

    public function testSendJournalPromptCreatesABlankDailyJournalEntryAllUsers()
    {
        Queue::fake();
        $service = new SendJournalPrompt();
        $users = factory(User::Class, 3)->create();

        $service->handle();

        $users->each(function($user) {
            $this->assertDatabaseHas('journal_entries', ['user_id' => $user->id]);
        });
        Queue::assertPushed(JournalPromptEmailJob::class);
    }
}
