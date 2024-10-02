<?php layout() ?>

<style>
.team {
	margin-bottom: var(--spacing-12);
}
.team figure img {
	border-radius: var(--rounded);
	box-shadow: var(--shadow-lg);
	margin-bottom: var(--spacing-3);
}
.team figcaption {
	line-height: 1.25;
}
.team figcaption a {
	font-size: var(--text-xs);
	font-family: var(--font-mono);
	text-decoration: underline;
	color: var(--color-blue-800);
}
.team section + section {
	margin-top: var(--spacing-12);
	padding-top: var(--spacing-12);
	border-top: 1px solid var(--color-border);
}
.team section .h2 {
	margin-bottom: var(--spacing-8);
}
.team .box {
	--prose-size: var(--text-sm);
	background: none;
}
.team-members,
.team-info {
	grid-template-columns: repeat(1, 1fr);
}
.team-members {
	--gap: var(--spacing-6);
}
.team-info {
	--gap: var(--spacing-12);
}

@media screen and (min-width: 40rem) {
	.team-info {
		grid-template-columns: repeat(2, 1fr);
	}
}
@media screen and (min-width: 70rem) {
	.team-info {
		grid-template-columns: repeat(4, 1fr);
	}
}

@media screen and (min-width: 22rem) {
	.team-members {
		grid-template-columns: repeat(2, 1fr);
	}
}
@media screen and (min-width: 35rem) {
	.team-members {
		grid-template-columns: repeat(3, 1fr);
	}
}
@media screen and (min-width: 40rem) {
	.team-members {
		--gap: var(--spacing-12);
	}
}
@media screen and (min-width: 57rem) {
	.team-members {
		grid-template-columns: repeat(5, 1fr);
	}
}


</style>

<article class="team">
	<header class="mb-12 max-w-xl">
		<h1 class="h1 mb-6">Behind Kirby</h1>
	</header>

	<section>
		<ul class="team-members columns">
			<li>
				<figure>
					<?= image('bastian.jpg')->crop(250, 350) ?>
					<figcaption>
						<p><strong>Bastian</strong> Allgeier</p>
						<p><a href="mailto:bastian@getkirby.com">bastian@getkirby.com</a></p>
					</figcaption>
				</figure>
			</li>
			<li>
				<figure>
					<?= image('sonja.jpg')->crop(250, 350) ?>
					<figcaption>
						<p><strong>Sonja</strong> Broda</p>
						<p><a href="mailto:sonja@getkirby.com">sonja@getkirby.com</a></p>
					</figcaption>
				</figure>
			</li>
			<li>
				<figure>
					<?= image('lukas.jpg')->crop(250, 350) ?>
					<figcaption>
						<p><strong>Lukas</strong> Bestle</p>
						<p><a href="mailto:lukas@getkirby.com">lukas@getkirby.com</a></p>
					</figcaption>
				</figure>
			</li>
			<li>
				<figure>
					<?= image('nico.png')->crop(250, 350) ?>
					<figcaption>
						<p><strong>Nico</strong> Hoffmann</p>
						<p><a href="mailto:nico@getkirby.com">nico@getkirby.com</a></p>
					</figcaption>
				</figure>
			</li>
			<li>
				<figure>
					<?= image('ahmet.png')->crop(250, 350) ?>
					<figcaption>
						<p><strong>Ahmet</strong>s Bora</p>
						<p><a href="mailto:ahmet@getkirby.com">ahmet@getkirby.com</a></p>
					</figcaption>
				</figure>
			</li>
		</ul>
	</section>

	<section>
		<h2 class="h2">About the company</h2>
		<div class="team-info columns">
			<div class="box prose">
				<h3>Est. 2012</h3>
				<p>
					Kirby started in <a href="/10" class="link">2012</a> as a side project by Bastian. Over the years, the team has grown from within our <a href="/meet" class="link">community</a>.
					Together, we move Kirby forward.
				</p>
			</div>
			<div class="box prose">
				<h3>Company form</h3>
				<p>Kirby is maintained by the <a href="/contact">Content Folder GmbH & Co. KG.</a> Bastian, Sonja, Lukas and Nico are the owners. Ahmet is working as a freelancer for the company.</p>
			</div>
			<div class="box prose">
				<h3>Kirby’s funding</h3>
				<p>Kirby is 100% self-funded. We are profitable for more than a decade with our commercial license model. Since 2023, our partner network supports us with a secondary revenue stream. Our revenue is directly reinvested in the development of Kirby and its ecosystem.</p>
			</div>
			<div class="box prose">
				<h3>Fully remote</h3>
				<p>We are a fully remote operating team, split between Germany and Turkey. We don’t own a company office. Our office is online.</p>
				<p>You can contact us directly via email: <a href="mailto:support@getkirby.com">support@getkirby.com</a> or find us on in the <a href="https://forum.getkirby.com">Forum</a> or on <a href="https://chat.getkirby.com">Discord</a>.</p>
			</div>
		</div>
	</section>

	<section>
		<h2 class="h2">Our values</h2>
		<div class="team-info columns">
			<div class="box prose">
				<h3>Small & caring</h3>
				<p>We are happy to be a small team. We are working together in the same formation for many years and believe in the power and efficiency of this small group. We are not just one anonymous corporate entity. We express our personal values through our actions as a company. We believe that tech is always political and that we need to be careful about our decisions and our impact.</p>
			</div>
			<div class="box prose">
				<h3>Longevity</h3>
				<p>We are around for more than a decade and we plan to be around for years to come. We really think that stability and longevity is a feature. We also truly love our long-term relationships with our customers. We know a lot of you for many, many years - some of you even since Kirby’s beta in 2011. That’s beautiful.</p>
			</div>
			<div class="box prose">
				<h3>Community</h3>
				<p>Kirby’s community is known for being open and welcoming and we are very proud of that. We know that this can't be taken for granted on the web and especially in tech. We want people to feel safe when they interact with us or our community and we will do everything we can to keep this place friendly and open for everyone.</p>
			</div>
			<div class="box prose">
				<h3>Responsibility</h3>
				<p>We feel personally responsible to keep Kirby save and thriving. But we also care about a better society and the future of our planet. We offer free licenses for students, selected educational projects, social and environmental organizations, charities and non-profits with insufficient funding. We also donate a substantial amount each year to the Amadeu Antonio foundation to help protect our democracy.</p>
			</div>
		</div>
	</section>

	<section>
		<h2 class="h2">It’s not just us</h2>
		<div class="team-info columns">
			<div class="box prose">
				<h3>Partners</h3>
				<p>Kirby is supported by a network of reliable partner agencies and freelancers. Our <a href="/partners">partners</a> build a solid foundation to help you with your next project.</p>
			</div>
			<div class="box prose">
				<h3>Contributors</h3>
				<p>We have received hundreds of voluntary code contributions over the years from more than <a href="https://github.com/getkirby/kirby/graphs/contributors">60 contributors</a> in the community. Their help with issue reports and pull requests is invaluable for us as a team.</p>
			</div>
			<div class="box prose">
				<h3>Translators</h3>
				<p>Kirby’s interface is translated by an amazing team of <a href="https://translation.getkirby.com">community translators</a> from all over the world.</p>
			</div>
			<div class="box prose">
				<h3>Moderators</h3>
				<p>While we are constantly around on <a href="https://chat.getkirby.com">Discord</a>, <a href="https://github.com/getkirby">Github</a> and in our <a href="https://forum.getkirby.com">forum</a>, our community has turned into a really friendly, self-regulating little society. We are more than thankful for all the help and guidance that Kirby users provide for each other.</p>
			</div>
		</div>
	</section>

</article>
