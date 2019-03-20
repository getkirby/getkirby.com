<?php snippet('header') ?>

<style>

html {
  background: #313741;
}

.header, .footer {
  display: none;
}

.editor {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #313741;
  width: 1024px;
  height: 1024px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.editor .toolbar {
  display: none;
}
.editor-window {
  max-width: 80%;
  box-shadow: rgba(0,0,0, .5) 5px 10px 50px;
  border-radius: 5px;
  overflow: hidden;
  background: #000;
}
.editor-window pre {
  font-size: 1.5em;
  margin-bottom: .25rem;
  padding-right: 1rem;
}
.editor-buttons {
  display: flex;
  padding: 1rem;
}
.editor-buttons span {
  display: block;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: red;
  margin-right: 8px;
}
.editor-buttons .red {
  background: #ff5f56;
}
.editor-buttons .yellow {
  background: #ffbd2e;
}
.editor-buttons .green {
  background: #26c83f;
}

</style>


<figure class="editor">
  <div class="editor-window">
    <div class="editor-buttons">
      <span class="red"></span>
      <span class="yellow"></span>
      <span class="green"></span>
    </div>
    <?= $page->text()->kt() ?>
  </div>
</figure>

<?php snippet('footer') ?>
