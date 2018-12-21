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
        $user = factory(User::class)->create();
        $journalEntry = factory(JournalEntry::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->get('/journal-entries/'. $journalEntry->user_id .'/' . $journalEntry->id);

        $response->assertStatus(200);
        $response->assertJsonFragment($journalEntry->toArray());
    }
}
