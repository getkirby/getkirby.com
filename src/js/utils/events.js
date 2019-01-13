function on(element, eventName, selector, fn) {
  
  element.addEventListener(eventName, (event) => {
    
    const possibleTargets = element.querySelectorAll(selector);
    const target          = event.target;

    for(let i = 0, l = possibleTargets.length; i < l; i++) {
      let el   = target;
      const p  = possibleTargets[i]; 

      while(el && el !== element) {
        if(el === p) {
          return fn.call(p, event);
        }

        el = el.parentNode;
      }
    }

  });
}

export { on };