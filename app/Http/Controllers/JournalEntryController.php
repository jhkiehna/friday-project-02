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

    public function show($journalId)
    {
        $journal = JournalEntry::findOrFail($journalId);

        return response($journal->toArray(), 200);
    }

    public function updateWebhook(Request $request)
    {
        $fromEmail = $request->get('To');
        $emailContent = $request->get('body-plain');
        $emailHistoryId = $request['event-data']['user-variables']['history_id'];

        $user = User::where('email', $fromEmail);

        $user->journalEntries->where('email_history_id', $emailHistoryId)->update([
            'content' => $emailContent
        ]);

        return response('recieved', 200);
    }
}
