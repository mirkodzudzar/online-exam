<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Profession' => 'App\Policies\ProfessionPolicy',
        'App\Models\CandidateProfession' => 'App\Policies\CandidateProfessionPolicy',
        'App\Models\Candidate' => 'App\Policies\CandidatePolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Document' => 'App\Policies\DocumentPolicy',
        'App\Models\Location' => 'App\Policies\LocationPolicy',
        'App\Models\Exam' => 'App\Policies\ExamPolicy',
        'App\Models\CandidateExam' => 'App\Policies\CandidateExamPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
