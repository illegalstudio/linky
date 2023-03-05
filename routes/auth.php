<?php

use Illegal\Linky\Http\Controllers\Auth\AuthenticatedSessionController;
use Illegal\Linky\Http\Controllers\Auth\ConfirmablePasswordController;
use Illegal\Linky\Http\Controllers\Auth\EmailVerificationNotificationController;
use Illegal\Linky\Http\Controllers\Auth\EmailVerificationPromptController;
use Illegal\Linky\Http\Controllers\Auth\NewPasswordController;
use Illegal\Linky\Http\Controllers\Auth\PasswordController;
use Illegal\Linky\Http\Controllers\Auth\PasswordResetLinkController;
use Illegal\Linky\Http\Controllers\Auth\RegisteredUserController;
use Illegal\Linky\Http\Controllers\Auth\VerifyEmailController;
use Illegal\Linky\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('linky/auth')->middleware('linky-guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('linky.auth.login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    if (config('linky.auth.functionalities.register')) {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('linky.auth.register');
        Route::post('register', [RegisteredUserController::class, 'store']);
    }

    if (config('linky.auth.functionalities.forgot_password')) {
        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('linky.auth.password.request');
        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('linky.auth.password.email');
    }

    if (config('linky.auth.functionalities.reset_password')) {
        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('linky.auth.password.reset');
        Route::post('reset-password', [NewPasswordController::class, 'store'])->name('linky.auth.password.store');
    }
});

Route::prefix('linky/auth')->middleware('linky-auth')->group(function () {

    if (config('linky.auth.functionalities.email_verification')) {

        Route::get('verify-email', EmailVerificationPromptController::class)->name('linky.auth.verification.notice');
        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('linky.auth.verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('linky.auth.verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('linky.auth.password.confirm');
        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('linky.auth.password.update');
    }

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('linky.auth.logout');
});

Route::middleware('linky-auth')->group(function () {
    if (config('linky.auth.functionalities.user_profile')) {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('linky.auth.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('linky.auth.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('linky.auth.profile.destroy');
    }
});
