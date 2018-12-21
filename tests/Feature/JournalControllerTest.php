<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\JournalEntry;

class JournalControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexEndpointReturnsJournalEntriesForUser()
    {
        $user = factory(User::class)->create();
        list($journalEntry1, $journalEntry2) = factory(JournalEntry::class, 2)->create([
            'user_id' => $user->id
        ]);

        $response = $this->get('/journal-entries/' . $user->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            $journalEntry1->toArray()
        ]);
        $response->assertJsonFragment([
            $journalEntry2->toArray()
        ]);
    }

    public function testShowEndpointReturnsASingleJournalEntryForAUser()
    {
        $journalEntry = factory(JournalEntry::class)->create();

        $response = $this->get('/journal-entries/'. $journalEntry->id);

        $response->assertStatus(200);
        $response->assertJsonFragment($journalEntry->toArray());
    }

    public function testUpdateWebhookEnpointCanUpdateAJournalEntry()
    {
        $journalEntry = factory(JournalEntry::class)->create([
            'content' => null
        ]);

        $webhookRequest = [
            'content' => 'Test Content'
        ];

        $response = $this->patch('/journal-entries/'. $journalEntry->id, $webhookRequest);

        $this->assertEquals($journalEntry->content, $webhookRequest['content']);
    }
}
