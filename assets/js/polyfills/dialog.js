window.polyfillDialog = (dialog) => {
  if (typeof HTMLDialogElement !== "function") {
    dialog.show  = () => dialog.setAttribute("open", "");
    dialog.close = () => dialog.removeAttribute("open");
  }
};

const dialogs = document.querySelectorAll("dialog");
[...dialogs].forEach(dialog => polyfillDialog(dialog));
