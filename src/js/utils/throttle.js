/**
 * Rate-limites a function.
 *
 * @param {function} fn A callback function.
 * @param {Number} limit How often the function may be executed.
 * @return {undefined}
 */
export default function(fn, limit) {
  
  let inThrottle = false;
  
  return function () {
    if(!inThrottle) {
      fn();
      inThrottle = true;
      
      setTimeout(function() {
        inThrottle = false;
      }, limit);

    }
  };
}