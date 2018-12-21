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
        list($journalEntry1, $journalEntry2) = factory(JournalEntry::class, 2)->states(['withUser'])->create();

        $response = $this->get('/journal-entries/{userId}');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'username' => $user->username,
            'journal_entires' => [$journalEntry1->id, $journalEntry2->id]
        ]);
    }

    public function testShowEndpointReturnsASingleJournalEntry()
    {
        $user = factory(User::class)->create();
        $journalEntry = factory(JournalEntry::class)->create();

        $response = $this->get('/journal-entries/{userId}/{journalEntryId}');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'journalEntry_id' => $journalEntry->id,
            'journalEntryContent' => $journalEntry->content
        ]);
    }
}
