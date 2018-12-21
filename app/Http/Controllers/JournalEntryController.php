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
        $journals = collect(JournalEntry::where('user_id', $user->id)->get());

        $response = [
            'user' => $user->toArray(),
            'journal_entries' => $journals->map(function($journal) {
                return $journal->toArray();
            })->toArray()
        ];

        return response($response, 200);
    }

    public function show()
    {
        return response('test', 200);
    }

    public function updateWebhook()
    {
        
    }
}
