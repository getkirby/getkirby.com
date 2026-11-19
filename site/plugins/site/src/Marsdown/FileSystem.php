<?php

namespace Kirby\Marsdown;

use Kirby\Filesystem\F;

/**
 * Renders an indented list of files and folders
 * (two spaces per level, folders end with `/`)
 * as file tree
 */
class FileSystem
{
	/**
	 * File System Icons
	 */
	public static array $types = [
		'readme'     => '/^(readme|license)\.?/i',
		'javascript' => ['js'],
		'css'        => ['css'],
		'database'   => ['yml', 'yaml'],
		'html'       => ['html', 'htm', 'xhtml'],
		'font'       => ['woff', 'woff2', 'ttf', 'otf', 'eot'],
		'code'       => ['json'],
		'markdown'   => ['md', 'mdown', 'markdown'],
		'git'        => ['git', 'gitattributes', 'gitignore', 'gitmodules'],
		'php'        => ['php'],
		'text'       => ['txt'],
		'vue'        => ['vue'],
	];

	protected static function getIconByFilename(string $filename): string|null
	{
		if (in_array($filename, ['...', '…'])) {
			return null;
		}

		$extension = F::extension($filename);

		foreach (static::$types as $type => $extensions) {
			if (
				(
					is_string($extensions) === true &&
					preg_match($extensions, $filename)
				) || (
					is_array($extensions) === true &&
					in_array($extension, $extensions)
				)
			) {
				return $type;
			}
		}

		return F::type($filename) ?? 'file';
	}

	public static function parse(string $text): string
	{
		return static::renderBlock(static::parseBlock($text));
	}

	/**
	 * Converts the indented lines into a nested array
	 * @see http://stackoverflow.com/a/8882181
	 */
	protected static function parseBlock(string $text): array
	{
		$result = [];
		$path   = [];

		foreach (preg_split('/\n+/', trim($text)) as $line) {
			// two spaces per level
			$depth = intdiv(strspn($line, ' '), 2);
			$line  = substr($line, $depth * 2);

			// truncate path if needed
			while ($depth < count($path)) {
				array_pop($path);
			}

			// keep label (at depth)
			$path[$depth] = $line;

			// traverse path and add label to result
			$parent = &$result;

			foreach ($path as $key) {
				if (isset($parent[$key]) === false) {
					$parent[$line] = [];
					break;
				}

				$parent = &$parent[$key];
			}
		}

		return $result;
	}

	protected static function renderBlock(array $files): string
	{
		$html = '<ul>';

		foreach ($files as $name => $children) {
			$name = (string)$name;

			// files and empty folders
			if (str_ends_with($name, '/') === false) {
				$html .= '<li>' . static::renderLabel($name, static::getIconByFilename($name)) . '</li>';
				continue;
			}

			$name = substr($name, 0, -1);

			if ($children === []) {
				$html .= '<li>' . static::renderLabel($name, 'folder-collapsed') . '</li>';
				continue;
			}

			$html .= '<li><details open><summary>';
			$html .= static::renderLabel($name, 'folder-expanded');
			$html .= '</summary>';
			$html .= static::renderBlock($children);
			$html .= '</details></li>';
		}

		return $html . '</ul>';
	}

	protected static function renderLabel(
		string $name,
		string|null $type = null
	): string {
		$html = '<span role="presentation" class="filesystem-label" data-type="' . $type . '">';

		if ($type !== null) {
			$html .= icon($type);
		}

		return $html . htmlspecialchars($name) . '</span>';
	}
}
