<?php

namespace App\Console\Commands;

use App\Models\Quiz;
use App\Models\QuizHeader;
use App\Models\Section;
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

            }
            $challenge->update(['status' => 4]);
        }
    }
}
