<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Person
 * @package App\Model
 */
class Person extends Model
{
    /**
     * @var string
     */
    protected $table = 'people';
    /**
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * @var array
     * need to compare within ['rent_start_date','rent_end_data', 'contract_start_date', 'contract_end_date']
     * so set these four fields to date format automatically
     */
    protected $dates = [
        'rent_start_date',
        'rent_end_date',
        'contract_start_date',
        'contract_end_date',
    ];

    /**
     * a person belongs to a room
     */
    public function room()
    {
        return $this->belongsTo('App\Model\Room');
    }

    /**
     * a person has many bills
     */
    public function bills()
    {
        return $this->hasMany('App\Model\Bill', 'person_id');
    }

    /**
     * need format like '2017-10-02'
     * @param $value
     * @return string
     */
    public function getRentStartDateAttribute($value)
    {
        return substr($value, 0, 10);
    }

    /**
     * need format like '2017-10-02'
     * @param $value
     * @return string
     */
    public function getRentEndDateAttribute($value)
    {
        return substr($value, 0, 10);
    }

    /**
     * need format like '2017-10-02'
     * @param $value
     * @return string
     */
    public function getContractStartDateAttribute($value)
    {
        return substr($value, 0, 10);
    }

    /**
     * need equals '无固定期' or  format like '2017-10-02'
     * @param $value
     * @return string
     */
    public function getContractEndDateAttribute($value)
    {
        if ($value == '9000-12-31' || $value == '9000-12-31 00:00:00') {
            return '无固定期';
        }
        return substr($value, 0, 10);
    }

    /**
     * @param $value
     */
    public function setContractEndDateAttribute($value)
    {
        if ($value == '无固定期') {
            $this->attributes['contract_end_date'] = '9000-12-31';
        } else {
            $this->attributes['contract_end_date'] = $value;
        }
    }

    /**
     * automatically set short_name by name if short_name doesn't exist
     * @param $value
     */
    public function setNameAttribute($value)
    {
        if (! isset($this->attributes['short_name'])) {
            $this->attributes['short_name'] = pinyin_abbr($value);
        }
        $this->attributes['name'] = $value;
    }
}
