<?php

namespace App\Listeners;

use App\Events\SendMailResetPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
//----------------------------------------
use Mail;
use Exception;
class SendMailResetPasswordToUser
{

    /**
     * Handle the event.
     *
     * @param  SendMailResetPassword  $event
     * @return void
     */
    public function handle(SendMailResetPassword $event)
    {
         $email        = $event->email;
         $token        = $event->token;
         $text_soporte = trans('_app.TEXT_SOPORTE') ;

         Mail::send('mails.login.password-revovery', compact('token','text_soporte','email')  ,
              function($message) use ($text_soporte, $email) {
              $message->from  ( trans('_app.EMAIL_SOPORTE'),$text_soporte );
              $message->to    ( $email ,$text_soporte  );
              $message->subject ( trans('_app.asunto_pass_forget') );
          });
    }
}
