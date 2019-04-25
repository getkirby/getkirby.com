import ready from "../utils/ready";
import { $, $$ } from "../utils/selector";

ready(() => {

  const galleryImage = $(".home-panel-gallery .screenshot");
  const galleryLinks = $$(".home-panel-gallery-links a");

  galleryLinks.forEach(function (galleryLink) {
    galleryLink.addEventListener("click", function (e) {
      e.preventDefault();
      $(".home-panel-gallery-links a[aria-current]").removeAttribute("aria-current");

      while (galleryImage.firstChild) {
        galleryImage.removeChild(galleryImage.firstChild);
      }

      galleryImage.appendChild(this.querySelector(".intrinsic").cloneNode(true));

      galleryLink.setAttribute("aria-current", "true");
    }, true);
  });

});
