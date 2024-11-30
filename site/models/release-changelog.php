<?php

class ReleaseChangelogPage extends DefaultPage
{
	public function release()
	{
		return $this->parents()->not('releases')->last();
	}
}
