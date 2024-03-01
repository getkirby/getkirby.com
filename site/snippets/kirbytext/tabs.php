<nav role="tablist">
	<?php foreach ($tabs as $key => $tab): ?>
	<button
		:aria-selected="current === '<?= $key ?>'"
		aria-controls="tabs-<?= $id ?>-<?= $key ?>"
		id="tabs-<?= $id ?>-<?= $key ?>-label"
		role="tab"
		@click="current = '<?= $key ?>'"
	>
		<?= $tab['title'] ?>
	</button>
	<?php endforeach ?>
</nav>

<?php foreach ($tabs as $key => $tab): ?>
<div
	v-show="current === '<?= $key ?>'"
	aria-labelledby="tabs-<?= $id ?>-<?= $key ?>-label"
	id="tabs-<?= $id ?>-<?= $key ?>"
	role="tabpanel"
>
	<?= $tab['content'] ?>
</div>
<?php endforeach ?>

<script type="module">
import {
	createApp
} from '<?= url('assets/js/libraries/petite-vue.js') ?>';

createApp({
	current: "<?= array_keys($tabs)[0] ?>",
}).mount("#tabs-<?= $id ?>")
</script>
