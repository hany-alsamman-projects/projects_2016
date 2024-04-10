<?php namespace ScubaClick\Pages\Contracts;

interface AuthorInterface
{
    /**
     * Get the full name
     *
     * @return string
     */
	public function getFullNameAttribute();
}
