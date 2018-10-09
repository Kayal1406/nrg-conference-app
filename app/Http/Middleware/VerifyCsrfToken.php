<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/addnew', 
        '/apply/*',
        '/apply', 
        '/survey/*',
        '/survey',
        '/leads/*', 
        '/saveleads', 
        '/feedback', 
        '/appliedconference/*', 
        '/managerapprove/*',
        '/registeruser',
        '/approve/*',
        '/edit/*',
        '/logout',
        '/approved_conference/*',
        '/login',
        '/relativesearch',
        '/password/email',
        '/addnotes',
        '/reject_newconference/*',
        '/reject_appliedconference/*',
        '/manager_reject_appliedconference/*',
        '/feedback/*',
        '/reject_new_conference',
        '/reject_applied_conference',
        '/sponsorshipsurvey'
    ];
}
