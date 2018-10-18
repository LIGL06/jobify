<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * @var string
     */
    protected $table = 'companies';
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'rotation', 'phone', 'email',
        'address', 'observations', 'noPenalties',
        'contact'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobs(){
        return $this->hasMany(Jobs::class,'companyId');
    }

}
