<form action="<?= option('keys.mailcoach.form_url') ?>" method="post" class="kosmos-form highlight bg-light rounded">
	<div class="kosmos-fields">
		<input type="hidden"
					 name="redirect_after_subscribed"
					 value="<?= 'https://' . option('keys.mailcoach.api_domain') . '/subscribed' ?>"/>
		<input type="hidden"
					 name="redirect_after_already_subscribed"
					 value="<?= 'https://' . option('keys.mailcoach.api_domain') . '/already-subscribed' ?>"/>
		<input
			type="hidden"
			name="redirect_after_subscription_pending"
			value="<?= 'https://' . option('keys.mailcoach.api_domain') . '/redirect-after-pending' ?>"
		/>
		<div class="kosmos-field">
			<label class="h5 mb-3 block" for="email">Email <small>(required)</small></label>
			<input class="input mb-3" id="email" name="email" required type="email">
			<p class="text-sm">By subscribing you agree to receiving the Kosmos newsletter (usually once per month). We won't ever spam you! You can unsubscribe at any time.</p>
		</div>
		<div class="kosmos-field">
			<label class="h5 mb-3 block" for="first_name">First name</label>
			<input class="input mb-3" id="name" name="first_name" type="text">
			<p class="text-sm">We use Mailcoach to collect subscribers and send out newsletters. Find out more in our <a class="underline" href="<?= url('privacy#newsletter') ?>">privacy policy</a>.</p>
		</div>
		<div class="hidden">
			<label for="email_confirm">Field for spam protection, please leave it empty.</label>
			<input id="email_confirm" name="email_confirm" type="email">
		</div>
		<div class="kosmos-field">
			<button class="btn btn--filled w-100%">
				<?= icon('bolt') ?>
				Subscribe
			</button>
		</div>
	</div>
</form>
