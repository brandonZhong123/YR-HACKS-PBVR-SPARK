<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingTutorSession;
use App\Models\ArchivedTutorSession;
use Carbon\Carbon;

class ArchiveSessions extends Command
{
    protected $signature = 'sessions:archive';
    protected $description = 'Archive session requests that are approved or denied within a day';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $yesterday = Carbon::yesterday();

        $sessions = PendingTutorSession::whereIn('status', ['Approved', 'Denied'])
            ->whereDate('updated_at', $yesterday)
            ->get();

        foreach ($sessions as $session) {
            ArchivedTutorSession::create([
                'tutor_id' => $session->tutor_id,
                'tutoree_id' => $session->tutoree_id,
                'subject' => $session->subject,
                'location' => $session->location,
                'date' => $session->date,
                'start_time' => $session->start_time,
                'end_time' => $session->end_time,
                'status' => $session->status,
                'reason' => $session->reason,
            ]);

            $session->delete();
        }

        $this->info('Archived session requests that were approved or denied within a day.');
    }
}