<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    /**
     * @var string
     */
    protected $table = 'user_infos';
    /**
     * @var array
     */
    protected $fillable = [
        'userId', 'fName', 'lName', 'doB',
        'civilStatus', 'phone', 'address', 'pictureUrl',
        'profession', 'professional', 'handyCap', 'uniqueKey',
        'socialKey', 'salary'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
