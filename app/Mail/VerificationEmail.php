<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable
{
	use Queueable, SerializesModels;

	public $user;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->from('coronatime@test.com')
			->subject('Email Verification')
			->markdown('email.verification');
	}
}
