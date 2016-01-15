<?php

namespace App\Services;
use App\Models\User;

interface TransactionalMailer {

  /**
   * Sends a verification email to an specific user
   * @param  User   $user user to whom is intended the email
   * @return [type]       [description]
   */
  public function sendVerificationEmail(User $user);

}
