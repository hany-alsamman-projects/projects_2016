<?php namespace ScubaClick\Pages\Contracts;

interface TagsInterface
{
    /**
     * Get paginated tags
     *
     * @return array
     */
    public function get($perPage = 20);

    /**
     * Get a tag
     *
     * @param string $tag
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($tag);

    /**
     * Get all pages for a tag
     *
     * @param object $tag
     * @param int $perPage
     * @param bool $feed
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getPages($tag, $perPage = 12, $feed = false);

    /**
     * Get all tag titles as a json array
     *
     * Useful for use with select2 or chosen
     *
     * @return string
     */
    public function toJson();

    /**
     * Create a tag
     *
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
	public function create($input);

    /**
     * Update a tag
     *
     * @param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
	public function update($id);

    /**
     * Delete a tag
     *
     * @param int $id
     * @return boolean
     */
	public function delete($id);
}
