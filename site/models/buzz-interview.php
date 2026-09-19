<?php

use Kirby\Cms\File;
use Kirby\Cms\Structure;

class BuzzInterviewPage extends BuzzEntryPage
{
	/**
	 * Portrait of the interviewee, shown next to every answer
	 */
	public function avatar(): File|null
	{
		return $this->images()->findBy('name', 'avatar');
	}

	/**
	 * The question and answer pairs that make up the interview
	 */
	public function qa(): Structure
	{
		return $this->interview()->toStructure();
	}
}
