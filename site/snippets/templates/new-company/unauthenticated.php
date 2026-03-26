<div id="form" class="columns mb-24" style="--columns: 2; --gap: var(--spacing-1)">
	<form method="GET" action="<?= option('hub.url') . '/login' ?>" class="highlight bg-white shadow-xl flex flex-column justify-between">
		<header>
			<h2 class="h2 mb-6">Customers</h2>
			<div class="prose mb-12">
				<p>
					<mark>If you are an existing customer, you can find a magic approval button in the email we sent you.</mark>
				</p>
				<p>
					If you didn't get the email, you can log in to our brand new customer hub for approval.
				</p>
			</div>
		</header>
		<footer>
			<input type="hidden" name="redirect" value="true">
			<button type="submit" class="btn btn--filled"><?= icon('key') ?> Login</button>
		</footer>
	</form>
</div>
