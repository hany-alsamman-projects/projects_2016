<?php namespace ScubaClick\Pages\Contracts;

interface PagesInterface
{
    /**
     * Get all pages for a listing
     *
     * @param int $static
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
	public function get($static = 1, $perPage = 12);

    /**
     * Get all posts for a listing
     *
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index($perPage = 12);

    /**
     * Get an author
     *
     * @param string $username
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getAuthor($username);

    /**
     * Get all posts for an author
     *
     * @param object $author
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function authorPages($author, $perPage = 12);

    /**
     * Get all comments for a post
     *
     * @param object $post
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getComments($post, $perPage = 20);

    /**
     * Get the front page
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getFront();

    /**
     * Get a single page
     *
     * @param string $slug
     * @param string $category
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getPage($slug, $category = null);

    /**
     * Get all pages for a search listing
     *
     * @param string $search
     * @param int $static
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
	public function search($search, $static = 1, $perPage = 12);

    /**
     * Get all trashed pages
     *
     * @param int $static
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
	public function trashed($static = 1, $perPage = 12);

    /**
     * Finally delete a page
     *
     * @param int $id
     * @return boolean
     */
	public function forceDelete($id);

    /**
     * Restore a page from the trash
     *
     * @param int $id
     * @return boolean
     */
	public function restore($id);

    /**
     * Empty the trash
     *
     * @param int $static
     * @return void
     */
	public function emptyTrash($static = 1);

    /**
     * Create a page
     *
     * @param array $input
     * @param mixed $tags
     * @return Illuminate\Database\Eloquent\Model
     */
	public function create($input, $tags = false);

    /**
     * Find a page or throw an exception
     * 
     * @param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
	public function findOrFail($id);

    /**
     * Update a page
     *
     * @param int $id
     * @param mixed $tags
     * @return Illuminate\Database\Eloquent\Model
     */
	public function update($id, $tags = false);

    /**
     * Soft delete a page
     *
     * @param int $id
     * @return boolean
     */
	public function delete($id);

    /**
     * Add a comment
     *
     * @param int $postID
     * @return Illuminate\Database\Eloquent\Model
     */
    public function addComment($postId);
}
