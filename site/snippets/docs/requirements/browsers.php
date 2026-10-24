<?php

// readable names for the browserslist entries
// the Panel is built against
$names = [
	'Chrome'        => ['desktop', 'Chrome'],
	'Edge'          => ['desktop', 'Edge'],
	'Firefox'       => ['desktop', 'Firefox'],
	'Safari'        => ['desktop', 'Safari'],
	'Opera'         => ['desktop', 'Opera'],
	'iOS'           => ['mobile', 'Safari on iOS'],
	'ChromeAndroid' => ['mobile', 'Chrome for Android'],
	'Android'       => ['mobile', 'Android Browser'],
];

$lists = ['desktop' => [], 'mobile' => []];

foreach ($kirby->panel()->browsers() as $browser => $version) {
	[$type, $name] = $names[$browser] ?? ['desktop', $browser];
	$lists[$type][] = $name . ' ' . $version . '+';
}

?>
Kirby does not modify the output of your site's templates and thus has no effect on the browser requirements for your site's frontend. However, the Panel is built on modern browser features and has a couple browser requirements which need to be met by your site's editors

<div class="table">
	<table>
		<tr>
			<th>Desktop</th>
			<th>Mobile</th>
		</tr>
		<tr>
			<?php foreach ($lists as $list): ?>
			<td class="prose">
				<ul>
					<?php foreach ($list as $browser): ?>
					<li><?= esc($browser) ?></li>
					<?php endforeach ?>
				</ul>
			</td>
			<?php endforeach ?>
		</tr>
	</table>
</div>
