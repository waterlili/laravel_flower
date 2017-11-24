<?php

namespace App\DB;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'fname',
        'lname',
        'name',
        'gender',
        'mobile',
        'phone',
        'address',
        'email',
        'job_id',
        'skill_id',
        'description',
        'type_attraction_id',
        'sts'
    ];
    public static $SELECT_STS_STR = 'sts as sts_str';
    public static $SELECT_Gender_STR = 'gender as gender_str';

    public static $Gender = [
        1 => 'آقا',
        2 => 'خانم',
    ];


    public static $JOBTYPES = [
        1 => 'دکتر',
        2 => 'وکیل',
        3 => 'دفتر مهندسی',
        4 => 'دفتر اسناد رسمی',
        5 => 'آژانس',
        6 => 'دفتر بیمه',
    ];


    public static $STATUS = [
        1 => 'فعال',
        -1 => 'غیر فعال'
    ];


    public function getStsStrAttribute($value)
    {

        if (is_null($value)) {
            return NULL;
        }
        return array_get(self::$STATUS, $value, 'تعریف نشده');

    }

    public function getTypeStrAttribute($value)
    {
        if (is_null($value)) {
            return NULL;
        }
        return array_get(User::$TYPES, $value, 'تعریف نشده');
    }

    public function getGenderStrAttribute($value)
    {
        if (is_null($value)) {
            return NULL;
        }
        return array_get(User::$Gender, $value, 'تعریف نشده');
    }


}
