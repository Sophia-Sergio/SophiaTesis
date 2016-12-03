<?php

namespace Sophia;

use Illuminate\Database\Eloquent\Model;

class OauthIdentity extends Model
{
    protected $fillable = [
        'provider', 'provider_user_id', 'access_token', 'avatar', 'user_id'
    ];
}
