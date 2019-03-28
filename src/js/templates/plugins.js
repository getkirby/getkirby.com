import List from 'list.js';

var options = {
  listClass: "plugins-directory",
  valueNames: [
    "plugin-card-title",
    "plugin-card-author",
    "plugin-card-description",
    "plugin-card-footer",
  ],
};

var list      = new List('plugins', options);
var container = document.getElementById('plugins');

list.on("updated", function (event) {
  if (event.searched === true) {
    container.classList.add("searching");
  } else {
    container.classList.remove("searching");
  }
});
