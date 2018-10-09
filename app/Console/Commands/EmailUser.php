<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use App\Apply;
use Mail;
use Carbon\Carbon;
use App\User;

class EmailUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:user';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email to user';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $attendees = Apply::where('status_m', 'Approved')->get();
        $attendees_decode = json_decode($attendees, true);

        foreach($attendees_decode as $a) {
            $end = Carbon::parse($a['confstart']);
            $now = Carbon::now();
            $difference = $end->diffInDays($now);

            if($difference == "1" && $end->gt($now))
            {
                $email = User::where('id', 1)->value('email');
                $data = array('participants' => $attendees_decode, 'formdata' => $a, 'email' => $email);

                Mail::send('cron_emails.notesandleads', $data, function ($mail) use ($data) {
                    $mail->to($data['formdata']['email']);
                    $mail->from($data['email']);
                    $mail->subject('Reminder: Add conference notes and leads');
                });
            }
            else
            {
                //
            }
        }
        $this->info('Notes and Leads Reminder sent successfully!');
    }
}