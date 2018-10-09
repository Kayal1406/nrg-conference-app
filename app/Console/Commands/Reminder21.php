<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use App\Apply;
use Mail;
use Carbon\Carbon;

class Reminder21 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:21';
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
        $attendees = Apply::where('status_sm', 'Approved')->where('role', '!=', 'Training/Education')->get();
        $attendees_decode = json_decode($attendees, true);
        $start_date = Apply::orderBy('confstart', 'asc')->first();

        foreach($attendees_decode as $a) {
            $end = Carbon::parse($start_date['confstart']);
            $now = Carbon::now();
            $length = $end->diffInDays($now);

            if($length == "21")
            {
                Mail::send('cron_emails.preconference_21', $a, function ($mail) use ($a) {
                    $mail->to($a['email']);
                    $mail->from('kayalmanimohana@gmail.com');
                    $mail->subject($a['confname'].' Reminder: Upload Potential Leads');
                });
            }
            else
            {
                //
            }
        }
        $this->info('Reminder before 21 days sent successfully!');
    }

}