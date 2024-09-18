<script>
class LocalizedDatetimeElement extends HTMLElement {
	connectedCallback() {
		this.utc = new Date(this.getAttribute("date"));
		this.innerText = this.format(this.utc);
	}

	format(datetime) {
		return datetime.toLocaleString("en-US", {
			weekday: "short",
			day: "numeric",
			month: "long",
			year: "numeric",
			hour12: false,
			hour: "2-digit",
			minute: "2-digit",
			timeZoneName: "short"
		})
	}
}

customElements.define("localized-datetime", LocalizedDatetimeElement);
</script>
