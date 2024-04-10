<?php namespace ScubaClick\Feeder\Contracts;

interface FeedInterface
{
    /**
     * Format a feed item
     *
     * @return array
     */
	public function getFeedItem();
}
