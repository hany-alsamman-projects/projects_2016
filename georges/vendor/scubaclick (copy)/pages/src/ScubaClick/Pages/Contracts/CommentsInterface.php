<?php namespace ScubaClick\Pages\Contracts;

interface CommentsInterface
{
    /**
     * Get comments
     *
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
	public function get($perPage = 25);

    /**
     * Get all trashed comments
     *
     * @param int $perPage
     * @return Illuminate\Database\Eloquent\Collection
     */
	public function trashed($perPage = 12);

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
     * @return void
     */
	public function emptyTrash();

    /**
     * Soft delete a comment
     * 
     * @param int $id
     * @return void
     */
    public function delete($id);

    /**
     * Approve a comment
     * 
     * @param int $id
     * @return void
     */
    public function approve($id);

    /**
     * Disapprove a comment
     * 
     * @param int $id
     * @return void
     */
    public function disapprove($id);

    /**
     * Mark a comment as spam
     * 
     * @param int $id
     * @return void
     */
    public function spam($id);

    /**
     * Mark a comment as ham
     * 
     * @param int $id
     * @return void
     */
    public function ham($id);
}
