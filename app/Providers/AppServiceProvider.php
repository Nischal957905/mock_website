<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SubjectService;
use App\Services\QuestionService;
use App\Services\AnswerService;
use App\Services\MockService;
use App\Services\UserService;
use App\Services\UserAnswerService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SubjectService::class, function () {
            return new SubjectService();
        });
        $this->app->bind(QuestionService::class, function () {
            return new QuestionService();
        });
        $this->app->bind(AnswerService::class, function () {
            return new AnswerService();
        });
        $this->app->bind(MockService::class, function () {
            return new MockService();
        });
        $this->app->bind(UserService::class, function () {
            return new UserService();
        });
        $this->app->bind(UserAnswerService::class, function () {
            return new UserAnswerService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
