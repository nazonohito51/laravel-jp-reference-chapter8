<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->middleware('exists.entry', ['only' => ['edit', 'update']]);
        $this->middleware('self.entry', ['only' => ['edit', 'update']]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $result = $this->entry
            ->getPage($request->get('page', 1), 20)
            ->setPath($request->getBasePath());
        return view('admin.entry.index', ['page' => $result]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.entry.create');
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $attributes = [
            'entry' => $this->entry->getEntry($id),
            'id' => $id
        ];

        return view('admin.entry.edit', $attributes);
    }

    /**
     * @param                    $id
     * @param EntryUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, EntryUpdateRequest $request)
    {
        $input = $request->only(['title', 'body']);
        $input['user_id'] = $this->guard->user()->id;
        $input['id'] = $id;
        $this->entry->addEntry($input);

        return redirect()->route('admin.entry.index');
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
