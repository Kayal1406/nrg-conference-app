<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use App\Apply;
use Mail;
use Carbon\Carbon;

class Reminder7 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:7';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminder Sent';
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
        $attendees = Apply::where('status_sm', 'Approved')->get();
        $attendees_decode = json_decode($attendees, true);

        foreach($attendees_decode as $a) {

            $end = Carbon::$a['confstart'];
            $now = Carbon::now();
            $length = $now->diffInDays($end);

            if($length == "7" && $end->gt($now))
            {
                $email = User::where('id', 1)->value('email');
                $data = array('participants' => $attendees_decode, 'formdata' => $a, 'email' => $email);

                Mail::send('cron_emails.preconference_7', $data, function ($mail) use ($data) {
                    $mail->to($data['formdata']['email']);
                    $mail->from($data['email']);
                    $mail->subject('Your Upcoming Conference '.$data['formdata']['confname']);
                });
            }
            else
            {
                //
            }
        }
        $this->info('Reminder before 7 days sent successfully!');
    }
}