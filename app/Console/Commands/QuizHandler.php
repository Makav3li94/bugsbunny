<?php

namespace App\Console\Commands;

use App\Models\Quiz;
use App\Models\QuizHeader;
use App\Models\Section;
use App\Models\Setting;
use App\Models\TotalScore;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class QuizHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handel:quiz';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'hande quizzes when they expire';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $challenges = Section::with('quizHeaders')->has('quizHeaders')->where('status', 2)->whereDate('expire_date', '<=', Carbon::today())->get();
        foreach ($challenges as $challenge) {
            $quizHeaders = QuizHeader::where('section_id', $challenge->id)->get();
            foreach ($quizHeaders as $quizHeader) {

                $score = 0;
                $quizzes = Quiz::where('quiz_header_id', $quizHeader->id)->get();
                foreach ($quizzes as $quiz) {
                    if ($quiz->is_correct == '1') {
                        $score += $quiz->unit;
                    } else {
                        $score -= $quiz->unit;
                    }
                }
                $quizHeader->update(['score' => $score]);
                TotalScore::create([
                    'user_id' => $quizHeader->user_id,
                    'score' => -$score,
                    'type' => $score >= 0 ? 1:0,
                    'is_for' => 'partiSection'
                ]);
            }

            $quizHeaders = QuizHeader::where('section_id', $challenge->id)->get()->pluck('user_id')->toArray();
            $users = User::where('id', '!=', 1)->whereJsonContains('cats', strval($challenge->user_id))->get()->pluck('id')->toArray();
            $unique = array_unique(array_merge($quizHeaders, $users));
            $master_arr = array_diff($unique, $quizHeaders);
            $setting = Setting::all()->first();
            foreach ($master_arr as $bad_user) {
                TotalScore::create([
                    'user_id' => $bad_user,
                    'score' => $setting->skip_section_score,
                    'type' => 0,
                    'is_for' => 'skipSection'
                ]);
            }
            $challenge->update(['status' => 4]);
        }
    }
}
