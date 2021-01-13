
export async function component(source, selector) {
  let element;

  // if selector string was passed, query document for element
  if (selector) {
    element = document.querySelector(selector);
  }

  // if the element was found or if no element was supposed to be selected,
  // load component module and initialize component class (with/withour element)
  if (element || !selector) {
    const { default: Component } = await import(source);
    new Component(element);
  }
}

export function external(url, callback) {
  const at = document.getElementsByTagName("script")[0];
  const script = document.createElement("script");
  script.src = url;
  at.parentNode.insertBefore(script, at);
  script.onload = () => { if (callback) callback(); };
}
