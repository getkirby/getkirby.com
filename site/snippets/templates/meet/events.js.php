<script>
class LocalizedDatetimeElement extends HTMLElement {
	connectedCallback() {
		this.utc = new Date(this.getAttribute("date"));
		this.timezone = this.getAttribute("timezone");
		this.innerText = this.format(this.utc, this.timezone);
	}

	format(datetime, timezone) {
		const options = {
			weekday: "short",
			day: "numeric",
			month: "long",
			year: "numeric",
			hour12: false,
			hour: "2-digit",
			minute: "2-digit",
			timeZoneName: "short"
		};

		if (timezone) {
			options.timeZone = timezone;
		}

		return datetime.toLocaleString("en-US", options)
	}
}

customElements.define("localized-datetime", LocalizedDatetimeElement);
</script>
