<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EntryUpdateRequest;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Services\EntryService;
use App\Http\Requests\EntryStoreRequest;

class EntryController extends Controller
{
    /** @var EntryService */
    protected $entry;

    /** @var Guard */
    protected $guard;

    /**
     * @param EntryService $entry
     * @param Guard $guard
     */
    public function __construct(EntryService $entry, Guard $guard)
    {
        $this->entry = $entry;
        $this->guard = $guard;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.entry.create');
    }

    /**
     * @param EntryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(EntryStoreRequest $request)
    {
        $input = $request->only(['title', 'body']);
        $input['user_id'] = $this->guard->user()->id;
        $this->entry->addEntry($input);
        return redirect()->route('admin.entry.index');
    }
}