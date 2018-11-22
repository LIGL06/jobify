<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobInfo extends Model
{
    protected $table = 'job_infos';
    /**
     * @var array
     */
    protected $fillable = [
        'jobId', 'skills'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(Job::class, 'jobId');
    }
}
