<?php namespace ScubaClick\Pages\Contracts;

interface CategoriesInterface
{
    /**
     * Get all categories for a listing
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
	public function all();

    /**
     * Get a category
     *
     * @param string $category
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findOrFail($category);

    /**
     * Get all pages for a category
     *
     * @param object $category
     * @param int $perPage
     * @param bool $feed
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getPages($category, $perPage = 12, $feed = false);

    /**
     * Create a category
     *
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
	public function create($input);

    /**
     * Update a category
     *
     * @param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
	public function update($id);

    /**
     * Delete a category
     *
     * @param int $id
     * @return boolean
     */
	public function delete($id);
}
