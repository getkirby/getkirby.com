// import tippy from 'tippy.js';
import ready from '../utils/ready';

const tippyOptions = {
  interactive: true,
  animation: 'shift-away',
  arrow: true,
  delay: [150, 300],
  theme: 'kirby',
  maxWidth: '25rem',
  performance: true,
  // trigger: "click", // Useful for layout debugging, as the tooltip will not fade away if this is active.
}

ready().then(() => {

  const tooltips = document.querySelectorAll('[data-tooltip]');

  if(!tooltips.length) {
    // stop here if page does not contain any tooltips
    return;
  }
    
  Promise.all([
    import(
      /* webpackChunkName: "tooltip" */
      /* webpackMode: "lazy" */
      'tippy.js'
    ),
  ]).then(([tippy]) => {

    for(let i = 0, l = tooltips.length; i < l; i++) {
      const tooltip   = tooltips[i];
      const htmlTitle = tooltip.getAttribute('data-tooltip');
      const htmlContent = `<div class="tippy-inner | text text-small -background:black">${htmlTitle}</div>`;
  
      tooltip.setAttribute('title', htmlContent);

      tippy(tooltip, tippyOptions);

    }

  });

});
