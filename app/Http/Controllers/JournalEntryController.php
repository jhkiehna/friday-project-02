<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\JournalEntry;

class JournalEntryController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);

        $response = [
            'journal_entries' => $user->journalEntries->map(function($journal) {
                return $journal->toArray();
            })->toArray()
        ];

        return response($response, 200);
    }

    public function show($userId, $journalId)
    {
        $journal = JournalEntry::findOrFail($journalId);

        return response($journal->toArray(), 200);
    }

    public function updateWebhook()
    {
        
    }
}
