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
        'mobile2',
        'mobile3',
        'phone',
        'phone2',
        'phone3',
        'address',
        'address2',
        'address3',
        'email',
        'job',
        'skill',
        'description',
        'type',
        'sts'
    ];


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
        return $value;
        if (is_null($value)) {
            return NULL;
        }
        return array_get(User::$STATUS, $value, 'تعریف نشده');

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
