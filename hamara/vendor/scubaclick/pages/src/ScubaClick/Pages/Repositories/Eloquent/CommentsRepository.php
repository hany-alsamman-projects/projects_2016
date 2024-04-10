<?php namespace ScubaClick\Pages\Repositories\Eloquent;

use ScubaClick\Pages\Models\Comment;
use ScubaClick\Pages\Contracts\CommentsInterface;

class CommentsRepository implements CommentsInterface
{
    /**
     * {@inheritdoc}
     */
	public function get($perPage = 25)
	{
		return Comment::paginate($perPage);
	}

    /**
     * {@inheritdoc}
     */
	public function trashed($perPage = 12)
	{
        return Comment::onlyTrashed()
            ->paginate($perPage);
    }

    /**
     * {@inheritdoc}
     */
	public function forceDelete($id)
	{
        $comment = Comment::withTrashed()
            ->where('id', $id)
            ->first();

        $comment->forceDelete();

        return !$comment->exists;
	}

    /**
     * {@inheritdoc}
     */
	public function restore($id)
	{
        $comment = Comment::withTrashed()
            ->where('id', $id)
            ->first();

        $comment->restore();
        
        return $comment->isSaved() ? true : $comment->getErrors();
	}

    /**
     * {@inheritdoc}
     */
	public function emptyTrash($static = 1)
	{
        return Comment::onlyTrashed()
            ->forceDelete();
	}

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return !$comment->exists;
    }

    /**
     * {@inheritdoc}
     */
    public function approve($id)
    {
        $comment = Comment::find($id);
        $comment->update([
            'approved' => 1
        ]);

        return $comment->isSaved() ? true : $comment->getErrors();
    }

    /**
     * {@inheritdoc}
     */
    public function disapprove($id)
    {
        $comment = Comment::find($id);
        $comment->update([
            'approved' => 0
        ]);

        return $comment->isSaved() ? true : $comment->getErrors();
    }

    /**
     * {@inheritdoc}
     */
    public function spam($id)
    {
        $comment = Comment::find($id);
        $comment->update([
            'spam' => 1
        ]);

        return $comment->isSaved() ? true : $comment->getErrors();
    }

    /**
     * {@inheritdoc}
     */
    public function ham($id)
    {
        $comment = Comment::find($id);
        $comment->update([
            'spam' => 0
        ]);

        return $comment->isSaved() ? true : $comment->getErrors();
    }
}
