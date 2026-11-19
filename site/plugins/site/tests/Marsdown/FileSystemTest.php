<?php

namespace Kirby\Marsdown;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(FileSystem::class)]
class FileSystemTest extends TestCase
{
	/**
	 * Reduces the rendered tree to its structure
	 * by replacing each label with `[type]name`
	 */
	protected function structure(string $html): string
	{
		$html = preg_replace(
			'!<span role="presentation" class="filesystem-label" data-type="([^"]*)">(?:<svg.*?</svg>)?(.*?)</span>!',
			'[$1]$2',
			$html
		);

		return $html;
	}

	public function testParse(): void
	{
		$html = FileSystem::parse(<<<TEXT
			content/
			  1_projects/
			    project.txt
			  site.txt
			site/
			TEXT);

		$this->assertSame(
			'<ul>' .
				'<li><details open><summary>[folder-expanded]content</summary><ul>' .
					'<li><details open><summary>[folder-expanded]1_projects</summary><ul>' .
						'<li>[text]project.txt</li>' .
					'</ul></details>' .
					'<li>[text]site.txt</li>' .
				'</ul></details>' .
				'<li>[folder-collapsed]site</li>' .
			'</ul>',
			$this->structure($html)
		);
	}

	public function testParseEllipsis(): void
	{
		$html = FileSystem::parse("content/\n  ...\n  …");

		$this->assertSame(
			'<ul><li><details open><summary>[folder-expanded]content</summary><ul><li>[]...</li><li>[]…</li></ul></details></ul>',
			$this->structure($html)
		);
	}

	public static function iconProvider(): array
	{
		return [
			['README.md', 'readme'],
			['LICENSE', 'readme'],
			['index.js', 'javascript'],
			['index.css', 'css'],
			['blueprint.yml', 'database'],
			['index.html', 'html'],
			['font.woff2', 'font'],
			['composer.json', 'code'],
			['notes.md', 'markdown'],
			['.gitignore', 'git'],
			['index.php', 'php'],
			['note.txt', 'text'],
			['Field.vue', 'vue'],
			['image.jpg', 'image'],
			['archive.zip', 'archive'],
			['file.unknown', 'file'],
		];
	}

	#[DataProvider('iconProvider')]
	public function testParseIcons(string $filename, string $type): void
	{
		$this->assertSame(
			'<ul><li>[' . $type . ']' . $filename . '</li></ul>',
			$this->structure(FileSystem::parse($filename))
		);
	}
}
