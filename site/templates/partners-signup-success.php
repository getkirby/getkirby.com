<?php layout() ?>

<article>
	<?php if (param('partnership') === 'renewed'): ?>
		<header class="mb-6">
			<h1 class="h1">Thank your for renewing your partnership 💛</h1>
		</header>
		<div class="prose text-xl text-base">
			<p>It means a lot to us that you stick around for another year. If you have made changes to your plan, we will update your listing as soon as possible. Please, let us know if you want to update your texts, image or reference projects and we will take care of it. Otherwise, we will add your changes as soon as possible. Let us know if you have any questions or comments about your renewal in the meantime: <a href="mailto:partners@getkirby.com">partners@getkirby.com</a></p>
		</div>
	<?php else: ?>
		<header class="mb-6">
			<h1 class="h1">Thank you for your application 💛</h1>
		</header>
		<div class="prose text-xl text-base">
			<p>We review each application manually. Please, give us a few days to get in touch with you for the next steps. Let us know if you have any questions or comments about your application in the meantime: <a href="mailto:partners@getkirby.com">partners@getkirby.com</a></p>
		</div>
	<?php endif ?>

</article>

