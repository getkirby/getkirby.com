const AFFILIATE_STORAGE_KEY = "kirby_affiliate_id";

function parseQuery(search) {
  const hashes = search.slice(search.indexOf("?") + 1).split("&");
  let params = {};
  hashes.map((hash) => {
      const [key, val] = hash.split("=");
      params[key] = decodeURIComponent(val);
  });

  return params;
}

function setAffiliate() {

  const query = parseQuery(window.location.search);

  if (typeof query.affiliate === "undefined") {
    // return, if affiliate parameter was not passed to the page
    return;
  }

  if (affiliate === "") {
    // remove affiliate key, when an empfy `affiliate` parameter was passed to the page
    sessionStorage.removeItem(AFFILIATE_STORAGE_KEY);
  }

  const affiliate = parseInt(query.affiliate, 10);

  if (isNaN(affiliate) || affiliate === 0) {
    // abort, if passed affiliate value is not a number or zero
    return;
  }

  // store affiliate id in session storage
  sessionStorage.setItem(AFFILIATE_STORAGE_KEY, affiliate);
}

setAffiliate();
