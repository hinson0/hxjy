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

//        $this->score = $this->infoScore();
        $this->score = 0;

        $exps = TeacherExperience::where('teacher_id', $this->teacher_id)->count();
        $this->exps = $exps;
        $this->score += self::SCORE_EXPS;

        $features = TeacherFeature::where('teacher_id', $this->teacher_id)->count();
        $this->features = $features;
        $this->score += self::SCORE_FEATURES;

        $cases = TeacherCase::where('teacher_id', $this->teacher_id)->count();
        $this->cases = $cases;
        $this->score += self::SCORE_CASES;

        $schools = TeacherSchool::where('teacher_id', $this->teacher_id)->count();
        $this->schools = $schools;
        $this->score += self::SCORE_SCHOOLS;

        $honours = TeacherHonour::where('teacher_id', $this->teacher_id)->count();
        $this->honours = $honours;
        $this->score += self::SCORE_HONOURS;

        $tags = TeacherTag::where('teacher_id', $this->teacher_id)->count();
        $this->tags = $tags;
        $this->score += self::SCORE_TAGS;

        $presences = TeacherPresence::where('teacher_id', $this->teacher_id)->count();
        $this->presences = $presences;
        $this->score += self::SCORE_PRESENCES;

        $this->save();
    }

    public function infoScore(TeacherInformation $info)
    {
        $score = 0;
        !empty($info->avatar) && $score += self::SCORE_AVATAR;
        !empty($info->nickname) && $score += self::SCORE_NICKNAME;
        !empty($info->GENDER) && $score += self::SCORE_GENDER;
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