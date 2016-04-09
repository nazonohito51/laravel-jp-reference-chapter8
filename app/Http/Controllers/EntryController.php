<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\EntryService;

class EntryController extends Controller
{
    /** @var EntryService */
    protected $entry;

    /** @var CommentService */
    protected $comment;

    /**
     * @param EntryService $entry
     */
    public function __construct(EntryService $entry, CommentService $comment)
    {
        $this->entry = $entry;
        $this->comment = $comment;
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $result = $this->entry
            ->getPage($request->get('page', 1), 20)
            ->setPath($request->getBasePath());
        return view('entry.index', ['page' => $result]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $attributes = [
            'entry' => $this->entry->getEntry($id),
            'comments' => $this->comment->getCommentsByEntry($id)
        ];
        return view('entry.show', $attributes);
    }
}
