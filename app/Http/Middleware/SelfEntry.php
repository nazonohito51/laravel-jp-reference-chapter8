<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\EntryService;

/**
 * @package App\Http\Middleware
 */
class SelfEntry
{
    /** @var EntryService $entry */
    protected $entry;
    
    /**
     * @param EntryService $entry
     */
    public function __construct(EntryService $entry)
    {
        $this->entry = $entry;
    }
    
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $result = $this->entry->getEntryAbility(
            $request->route()->getParameter('entry')
        );
        if (!$result) {
            return redirect()->route('admin.entry.index')
                ->with('message', '投稿者以外は編集できません');
        }
        
        return $next($request);
    }
}
