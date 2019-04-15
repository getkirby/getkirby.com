import List from "list.js";

var options = {
  listClass: "recipe-cards",
  valueNames: [
    "recipe-card-title",
    "recipe-card-description",
    "recipe-card-footer"
  ]
};

new List("cookbook", options);
