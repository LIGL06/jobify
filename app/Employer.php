<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    /**
     * @var string
     */
    protected $table = 'employers';
    /**
     * @var array
     */
    protected $fillable = [
        'userId', 'companyId', 'approved'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class,'userId');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}
