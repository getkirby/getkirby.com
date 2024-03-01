<menu>
	<?php foreach ($tabs as $key => $tab): ?>
	<button
		:aria-current="current === '<?= $key ?>'"
		@click="current = '<?= $key ?>'"
	>
		<?= $tab['title'] ?>
	</button>
	<?php endforeach ?>
</menu>

<?php foreach ($tabs as $key => $tab): ?>
<div v-show="current === '<?= $key ?>'">
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
