<?php

namespace Incraigulous\AdminZone\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Incraigulous\AdminZone\Models\Traits\Revisionable;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Revisionable;

    protected $labelField = 'name';
    protected $descriptionField = 'email';
    protected $guarded = ['id', 'email_verified_at', 'remember_token', 'password'];

    public function avatar()
    {
        return $this->belongsTo(Asset::class, 'avatar_id');
    }
}
