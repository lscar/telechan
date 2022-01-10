<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use File;

class DailyBonusController extends Controller
{
    public function index()
    {
        $rawData = File::get('/home/vagrant/code/result.txt');

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

        $summaryFormat = [];
        foreach ($summary[0] as $item) {
            $summaryFormat[] = str_replace(PHP_EOL, '', $item);
        }
        $detailFormat = $detail[0];

        return view('mails.DailyBonusMail', [
            'summary' => $summaryFormat,
            'detail'  => $detailFormat,
        ]);
    }
}
