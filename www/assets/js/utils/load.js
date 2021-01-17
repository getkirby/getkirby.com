
export async function component(source, selector) {

  // If no selector was passed, just load and invoke the element
  if (!selector) {
    const { default: Component } = await import(source);
    return new Component();
  }

  // If selector string was passed, query document for elements
  const elements = document.querySelectorAll(selector);

  if (elements.length > 0) {
    const { default: Component } = await import(source);
    for (let i = 0; i < elements.length; i++) {
      new Component(elements[i]);
    }
  }
}

export function external(url, callback) {
  const at = document.getElementsByTagName("script")[0];
  const script = document.createElement("script");
  script.src = url;
  at.parentNode.insertBefore(script, at);
  script.onload = () => { if (callback) callback(); };
}
