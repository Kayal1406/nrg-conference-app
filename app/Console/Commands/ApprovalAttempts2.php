<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use App\Apply;
use Mail;
use Carbon\Carbon;
use App\User;

class ApprovalAttempts2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approval2:reminder';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Approval2 Sent';
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
        $attendees = Apply::where('status_m', 'Pending')->where('status_sm', 'Approved')->get();
        $attendees_decode = json_decode($attendees, true);
        
        foreach($attendees_decode as $a) {

            $time = Carbon::parse($a['created_date'])->toDateTimeString();
            $end = Carbon::parse($a['created_date'])->toDateTimeString();
            $now = Carbon::now()->toDateTimeString();

            $ts1 = strtotime(str_replace('/', '-', $now));
            $ts2 = strtotime(str_replace('/', '-', $time));
            $diff = abs($ts1 - $ts2) / 3600;

            if($diff > "120" && $end->gt($now))
            {
                $email = User::where('id', 1)->value('email');
                $data = array('participants' => $attendees_decode, 'formdata' => $a, 'email' => $email);
                Mail::send('cron_emails.reminder_approve', $data, function ($mail) use ($data) {
                    $mail->to($data['formdata']['mngemail'])->cc($data['email']);
                    $mail->from($data['email']);
                    $mail->subject($data['formdata']['confname'].' Final Reminder: REVIEW NEEDED - Conference Request Submission');
                });  
            }
            else
            {
                //
            }
        }
    }
}