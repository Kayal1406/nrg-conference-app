<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use App\Apply;
use Mail;
use Carbon\Carbon;

class feedbackReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback:reminder';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feedback Reminder Sent';
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
        $currentDate = Carbon::now();
        $feedback = Apply::where('confend', '<', $currentDate)->where('status_m', 'Approved')->get();
        $feedback_decoded = json_decode($feedback, true);

        foreach($feedback_decoded as $data) {
            $fb = Feedback::where('user_id', $data['user_id'])->where('conferencename', $data['confname'])->exists();

            $end = Carbon::parse($data['confend']);
            $now = Carbon::now();
            $length = $now->diffInDays($end);
            
            if($fb == "" && $length == "5")
            {
                Mail::send('cron_emails.feedbackreminder', $data, function ($mail) use ($data) {
                    $mail->to($data['email']);
                    $mail->subject('Your post-conference feedback is requested');
                });
            }
            else
            {
                //
            }
        }
    }
}