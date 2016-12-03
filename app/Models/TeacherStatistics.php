<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherStatistics extends Model
{
    use SoftDeletes;

    use TeacherStatisticsTrait;

    protected $dates = ['deleted_at'];

    protected $dateFormat = 'U';

    const SCORE_EXPS = 15;
    const SCORE_FEATURES = 10;
    const SCORE_SCHOOLS = 10;
    const SCORE_HONOURS = 15;
    const SCORE_CASES = 10;
    const SCORE_PRESENCES = 10;
    const SCORE_AVATAR = 10;
    const SCORE_NICKNAME = 5;
    const SCORE_GENDER = 5;
    const SCORE_TAGS = 10;

    public function autoUpdate() // 10分钟固定更新一次
    {

//        if (!empty($this->updated_at)) {
//            if (strtotime($this->updated_at) + 60 >= time()) {
//                 10分钟内不更新
//                return;
//            }
//        }


        $exps = TeacherExperience::where('teacher_id', $this->teacher_id)->count();
        $this->exps = $exps;

        $features = TeacherFeature::where('teacher_id', $this->teacher_id)->count();
        $this->features = $features;

        $cases = TeacherCase::where('teacher_id', $this->teacher_id)->count();
        $this->cases = $cases;

        $schools = TeacherSchool::where('teacher_id', $this->teacher_id)->count();
        $this->schools = $schools;

        $honours = TeacherHonour::where('teacher_id', $this->teacher_id)->count();
        $this->honours = $honours;

        $tags = TeacherTag::where('teacher_id', $this->teacher_id)->count();
        $this->tags = $tags;

        $presences = TeacherPresence::where('teacher_id', $this->teacher_id)->count();
        $this->presences = $presences;

        $this->score = $this->initScore();
        $this->save();
    }

    public function initScore()
    {
        $info = TeacherInformation::where('teacher_id', $this->teacher_id)->first();
        $score = 0;
        !empty($info->avatar) && $score += self::SCORE_AVATAR;
        !empty($info->nickname) && $score += self::SCORE_NICKNAME;
        !empty($info->gender) && $score += self::SCORE_GENDER;
        !empty($this->exps) && $score += self::SCORE_EXPS;
        !empty($this->fetaures) && $score += self::SCORE_FEATURES;
        !empty($this->cases) && $score += self::SCORE_CASES;
        !empty($this->schools) && $score += self::SCORE_SCHOOLS;
        !empty($this->honours) && $score += self::SCORE_HONOURS;
        !empty($this->tags) && $score += self::SCORE_TAGS;
        !empty($this->presences) && $score += self::SCORE_PRESENCES;
        return $score;
    }

    public function inc($field)
    {
        if (property_exists($this, $field)) {
            $this->$field += 1;
            $this->save();
        }
    }
}

trait TeacherStatisticsTrait
{
    public static function autoUpdateWhenEmpty($teacher_id)
    {
        $statistics = new TeacherStatistics();
        $statistics->teacher_id = $teacher_id;
        $statistics->autoUpdate();
        return $statistics;
    }

    public static function incStatistics($teacher_id, $field)
    {
        $statistics = TeacherStatistics::where('teacher_id', $teacher_id)->first();
        if (empty($statistics)) {
            $statistics = new TeacherStatistics();
        }
        $statistics->inc($field);

    }
}