<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use App\Apply;
use Mail;
use Carbon\Carbon;
use App\Feedback;

class feedbackReminders3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feedback3:reminder';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Feedback Reminder3 Sent';
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
            
            if($fb == "" && $length == "15")
            {
                Mail::send('cron_emails.feedbackreminder', $data, function ($mail) use ($data) {
                    $mail->to($data['email'])->cc($data['mngemail']);
                    $mail->subject('Final Reminder: Your post-conference feedback is requested');
                });
            }
            else
            {
                //
            }
        }
        $this->info('Feedback Reminder sent successfully!');
    }
}