<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Testmodule extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'testmodules';

    protected $hidden = [
        'passwordx',
    ];

    protected $appends = [
        'file_multix',
        'file_singlex',
    ];

    const SELECTX_SELECT = [
        'v1' => 'l1',
        'v2' => 'l2',
    ];

    const RADIOX_RADIO = [
        'value1' => 'label1',
        'value2' => 'label2',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'datepickerx',
        'datetimepickerx',
    ];

    protected $fillable = [
        'textx',
        'radiox',
        'moneyx',
        'emailx',
        'floatx',
        'selectx',
        'integerx',
        'passwordx',
        'checkboxx',
        'textareack',
        'created_at',
        'updated_at',
        'deleted_at',
        'tetareanock',
        'datepickerx',
        'timepickerx',
        'category_id',
        'datetimepickerx',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getDatepickerxAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDatepickerxAttribute($value)
    {
        $this->attributes['datepickerx'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDatetimepickerxAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDatetimepickerxAttribute($value)
    {
        $this->attributes['datetimepickerx'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getFileSinglexAttribute()
    {
        return $this->getMedia('file_singlex')->last();
    }

    public function getFileMultixAttribute()
    {
        return $this->getMedia('file_multix');
    }

    public function category()
    {
        return $this->belongsTo(Xcategory::class, 'category_id');
    }

    public function categoryxes()
    {
        return $this->belongsToMany(Category::class);
    }
}
