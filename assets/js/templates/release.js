window.addEventListener('DOMContentLoaded', () => {
	const observer = new IntersectionObserver(entries => {
		entries.forEach(entry => {
			const id = entry.target.getAttribute('id');
			if (entry.intersectionRatio > 0) {
				document.querySelector(`nav.release-menu li a[href="#${id}"]`)?.setAttribute('aria-current', 'true');
			} else {
				document.querySelector(`nav.release-menu li a[href="#${id}"]`)?.removeAttribute('aria-current');
			}
		});
	});

	// Track all sections that have an `id` applied
	document.querySelectorAll('section[id]').forEach((section) => {
		observer.observe(section);
	});
});
