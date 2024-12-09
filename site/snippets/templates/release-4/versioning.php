<style>
.diff {
	display: flex;
	flex-direction: column;
}

.diff-table {
	table-layout: fixed;
	align-self: flex-end;
}

.diff-table.old {
	color: var(--color-red-500);
}
.diff-table.new {
	color: var(--color-green-500);
}

.diff-table th,
.diff-table td {
	position: relative;
	font-weight: normal;
	width: 7rem;
}
.diff-table th:not(:last-child):after,
.diff-table td:not(:last-child):after {
	position: absolute;
	content: ".";
	right: 1rem;
	color: var(--color-gray-600);
}

.diff-table.new th:first-child:after,
.diff-table.new td:first-child:after {
	display: none;
}

.diff-table .generation {
	width: 10rem;
}

.diff-table del {
	color: var(--color-gray-700);
}

.diff-table caption {
	color: var(--color-gray-500);
	text-align: left;
}
.diff-table caption::before {
	content: "// "
}

#versioning .release-code-box {
	overflow-x: auto;
}
#versioning .release-code-box ul {
	list-style:disc;
	margin-left: 1ch;
}

@media screen and (max-width: 80rem) {
	#versioning .release-code-box {
		padding: var(--spacing-6);
		font-size: var(--text-sm);
	}

	#versioning th,
	#versioning td {
		width: 6rem;
	}

	#versioning .generation {
		width: 8.5rem;
	}
}
</style>

<section id="versioning" class="mb-36">

	<?php snippet('hgroup', [
		'title'    => 'New Versioning Scheme',
		'subtitle' => 'Semantic Versioning',
		'mb'       => 12
	]) ?>

	<div class="columns" style="--columns: 2">
		<div class="release-code-box p-12 diff-box">
			<div class="code diff font-mono">
				<table class="diff-table old mb-6">
					<caption>before</caption>
					<tr>
						<th class="generation">{generation}</th>
						<th>{major}</th>
						<th>{minor}</th>
						<th>{patch}</th>
					</tr>
					<tr>
						<td class="generation">3</td>
						<td>9</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr>
						<td class="generation">3</td>
						<td>10</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr>
						<td class="generation">3</td>
						<td>11</td>
						<td>0</td>
						<td>0</td>
					</tr>
				</table>
				<table class="diff-table new">
					<caption>after</caption>
					<tr>
						<th class="generation"><del>{generation}</del></th>
						<th>{major}</th>
						<th>{minor}</th>
						<th>{patch}</th>
					</tr>
					<tr>
						<td><del>3</del> &rarr;</td>
						<td>3</td>
						<td>9</td>
						<td>0</td>
					</tr>
					<tr>
						<td></td>
						<td>4</td>
						<td>0</td>
						<td>0</td>
					</tr>
					<tr>
						<td></td>
						<td>5</td>
						<td>0</td>
						<td>0</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="release-code-box p-12 font-mono color-white">
			<div>
				<h3 class="h4 mb-3" style="color: var(--color-purple-500)">Key points</h3>
				<ul class="mb-12">
					<li>Kirby now follows <a class="underline" href="https://semver.org/">semantic versioning</a></li>
					<li>Major versions will be released on a yearly cycle to bring continuity and planning security.</li>
					<li>Licenses <a class="underline" href="<?= url('license/2023-11-28/summary#new-licensing-model') ?>">include three years of feature updates</a></li>
				</ul>

				<h3 class="h4 mb-3" style="color: var(--color-purple-500)">Example roadmap</h3>
				<ul>
					<li>4.0.0: late 2023</li>
					<li>5.0.0: late 2024</li>
					<li>6.0.0: late 2025</li>
				</ul>
			</div>
		</div>
	</div>
</section>
