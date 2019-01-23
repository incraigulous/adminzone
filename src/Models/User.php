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
use Incraigulous\AdminZone\Models\Contracts\Revisionable as RevisionableContract;
use Spatie\Translatable\HasTranslations;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    RevisionableContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, Revisionable;

    protected $guarded = ['id', 'email_verified_at', 'remember_token', 'password'];
}
