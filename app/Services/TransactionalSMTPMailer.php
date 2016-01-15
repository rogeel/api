<?php
namespace App\Services;
use App\Services\TransactionalMailer;
use App\Models\User;
use Mail;


class TransactionalSMTPMailer implements TransactionalMailer{
  /**
   * Sends a verification email to an specific user
   * @param  array   $user user to whom is intended the email
   * @return void
   */
  public function sendVerificationEmail(User $user){
    Mail::send('emails.confirmacion', ['user' => $user, 'web' => env('WEB_ADDRESS')], function ($m) use ($user) {
        $m->from('info@quepartido.com', 'quepartido.com');
        $m->bcc('info@quepartido.com', 'Soporte');
        $m->to($user->email, $user->full_name())
            ->subject('Verficación de cuenta');
    });
  }

}
