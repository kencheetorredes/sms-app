<?php

namespace App\Console\Commands;

use CommonLib;
use App\Models\BulkSendings;
use App\Models\TwilioPhones;
use Illuminate\Console\Command;
use Bkt;
class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send bulk sms';

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
     * @return int
     */
    public function handle()
    {
        $bulks = BulkSendings::where('status',0)->first();
        if($bulks){
            $bulks->status = 1;
            $bulks->save();
            $twillio = TwilioPhones::where('id',$bulks->twillio_id)->first();
        
            $from = $twillio->mobile;
            $count = 0;
            if(isset($bulks->group->members)){
                foreach($bulks->group->members as $recipient){
                        $data['name'] = $recipient->name;
                        $message  = Bkt::shortcode($bulks->message,$data);
                        $to = $recipient->code->code.$recipient->mobile;
                        CommonLib::sendMessage($recipient->id,$from,$to,$message,$bulks->twillio_id,$bulks->created_by);
                        $count = $count + 1;
                        $bulks->send = $count;
                        $bulks->save();
                }
            }
            $bulks->send = $count;
            $bulks->status = 2;
            $bulks->save();
        }
        $this->info('sms send');
    }
}
