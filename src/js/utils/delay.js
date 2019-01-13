const delay = (function() {

  let timer = 0;
  
  return function(ms) {
    return new Promise((resolve) => {
      clearTimeout(timer);
      timer = setTimeout(resolve(), ms);
    });
  }

})();

export default delay;