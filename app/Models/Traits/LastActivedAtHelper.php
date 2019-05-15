<?php
/**
 * Created by PhpStorm.
 * User: hero
 * Date: 2018/10/23
 * Time: 下午9:24
 */
namespace App\Models\Traits;

use Redis;
use Carbon\Carbon;

trait LastActivedAtHelper
{
    // 缓存相关
    protected $hash_prefix = 'larabbs_last_actived_at_';
    protected $field_prefix = 'user_';

    public function recordLastActivedAt(){
        $date = Carbon::now()->toDateString();
        $hash = $this->hash_prefix . $date;
        $field = $this->field_prefix . $this->id;
        $now = Carbon::now()->toDateTimeString();
        Redis::hset($hash,$field,$now);
    }

    public function syncUserActivedAt()
    {

        $yesterday_date = Carbon::now()->toDateString();
        $hash = $this->hash_prefix . $yesterday_date;

        $dates = Redis::hGetAll($hash);

        // 遍历，并同步到数据库中
        foreach ($dates as $user_id => $actived_at) {
            $user_id = str_replace($this->field_prefix, '', $user_id);

            // 只有当用户存在时才更新到数据库中
            if ($user = $this->find($user_id)) {
                $user->last_actived_at = $actived_at;
                $user->save();
            }
        }
        Redis::del($hash);
    }
    public function getLastActivedAtAttribute($value)
    {

        $date = Carbon::now()->toDateString();
        $hash = $this->hash_prefix . $date;
        $field = $this->field_prefix . $this->id;
        $datetime = Redis::hGet($hash, $field) ? : $value;

        // 如果存在的话，返回时间对应的 Carbon 实体
        if ($datetime) {
            return new Carbon($datetime);
        } else {
            // 否则使用用户注册时间
            return $this->created_at;
        }
    }
    public function getHashFromDateString($date)
    {
        // Redis 哈希表的命名，如：larabbs_last_actived_at_2017-10-21
        return $this->hash_prefix . $date;
    }

    public function getHashField()
    {
        // 字段名称，如：user_1
        return $this->field_prefix . $this->id;
    }
}