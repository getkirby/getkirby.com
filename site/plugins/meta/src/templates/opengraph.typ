// OpenGraph image, rendered by Thumbnail.php
// (`--ppi 72`: 1pt = 1px, paths relative to the index root)

#let input(key, default: "") = sys.inputs.at(key, default: default)

#let lead       = input("lead").replace(" / ", "  ·  ")
#let title      = input("title")
#let image-path = input("image")
#let has-image  = image-path != ""

#let width  = 1200pt
#let height = 630pt
#let pad    = 72pt

#set page(width: width, height: height, margin: 0pt)

// no `calt`: Inter would turn `->` into an arrow
#set text(
  font: "Inter",
  fill: white,
  features: (calt: 0),
  top-edge: "cap-height",
  bottom-edge: "baseline",
)

// Background is placed first, not via `page(background:)`,
// which skips images this much larger than the page

// Seed picks the pattern and its section ("sky" is too pale)
#let patterns = (
  "abyss", "beach", "blobs", "darkness", "deepsea", "lagoon", "lava",
  "pinkblue", "purple", "rainforest", "sea", "space", "turmoil", "viscera",
)
#let seed    = int(input("seed", default: "0"))
#let pattern = patterns.at(calc.rem(seed, patterns.len()))

// Patterns are 3000 x 2000
#place(
  dx: -calc.rem(seed, 3000 - 1200) * 1pt,
  dy: -calc.rem(seed, 2000 - 630) * 1pt,
  image(
    "/assets/patterns/" + pattern + ".jpg",
    width: 3000pt,
    height: 2000pt,
  ),
)

// Calmer pattern behind a page image
#if has-image {
  place(rect(width: 100%, height: 100%, fill: black.transparentize(45%)))
}

// Shade for readable text
#place(rect(width: 100%, height: 100%, fill: gradient.linear(
  (black.transparentize(100%), 0%),
  (black.transparentize(60%), 45%),
  (black.transparentize(20%), 100%),
  angle: 90deg,
)))

// Page image sits on the title's baseline; tall ones show their top
#if has-image {
  context {
    let natural = measure(image(image-path, width: 620pt)).height
    let h       = calc.min(natural, height - 2 * pad)
    place(
      dx: 700pt,
      dy: height - pad - h,
      box(radius: 8pt, clip: true, height: h, image(image-path, width: 620pt, height: natural)),
    )
  }
}

#let signet = read("/assets/images/kirby-signet.svg").replace("<path ", "<path fill=\"#ffffff\" ")
#place(dx: pad, dy: pad, image(bytes(signet), format: "svg", height: 80pt))

// Allow breaks after `/`, `\`, `::` and `->`
#let breakable(string) = string.replace(
  regex("(\\S)(/|\\\\|::|->)"),
  match => match.captures.join() + "\u{200B}",
)

#let headline   = breakable(title)
#let column     = if has-image { 580pt } else { 960pt }
#let title-text = (weight: "bold", tracking: -0.022em)

#let render(size) = block(width: column, {
  set text(size: size, ..title-text)
  set par(leading: 0.24em)
  headline
})

// Largest size that fits without overflowing words
#let fit(sizes) = {
  let words = headline.split(regex("[\\s\u{200B}]+"))

  for size in sizes {
    let widest = words
      .map(word => measure(text(size: size, ..title-text, word)).width)
      .fold(0pt, calc.max)

    if widest <= column and measure(render(size)).height <= 260pt {
      return size
    }
  }

  sizes.last()
}

#place(bottom + left, dx: pad, dy: -pad, context stack(
  block(width: column, text(size: 30pt, fill: white.transparentize(12%), lead)),
  36pt,
  render(fit(range(88, 40, step: -2).map(size => size * 1pt))),
))
