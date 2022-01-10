<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Mail,File;

class DailyBonusMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DailyBonusReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily bonus report mail';

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
        $rawData = File::get('/Users/scar/Code/JD_DailyBonus/result.txt');

        preg_match_all(
            '/(【[\x{4e00}-\x{9fa5}]{4}】:\s{2}\S+)(\s\S+)?\n/u',
            $rawData,
            $summary
        );
        preg_match_all(
            '/[\x{4e00}-\x{9fa5}]{4}-[\x{4e00}-\x{9fa5}]{2}:\s(成功|失败),\s((\S{3}\s\S+\s\S)|(\S+\s\S))/u',
            $rawData,
            $detail
        );

        Mail::to(['lscar@icloud.com'])
            ->send(new \App\Mail\DailyBonus([
                'summary' => $summary[0],
                'detail'  => $detail[0],
            ]));

        return 0;
    }
}
