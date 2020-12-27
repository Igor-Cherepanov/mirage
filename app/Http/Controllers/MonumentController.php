<?php

namespace App\Http\Controllers;

use App\Models\Monument;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonumentController extends Controller
{
    /**
     * @var Monument $monuments
     */
    protected $monuments;

    /**
     * monumentController constructor.
     * @param Monument $monuments
     */
    public function __construct(Monument $monuments)
    {
        $this->monuments = $monuments;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $frd = $request->all();
        $monuments = $this->monuments->filter($frd)->orderBy($frd['ordering'] ?? 'id')->paginate(10);

        return view('monuments.index', compact('monuments', 'frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $frd = $request->all();

        return view('monuments.create', compact('frd'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $frd = $request->all();

        $frd['description'] = $frd['monument-trixFields']['description'] ?? '';
        $storageReceptionClient = Storage::disk('reception');

        $monument = $this->monuments->create($frd);

        foreach ($frd['slides']??[] as $images){
            foreach ($images as $image){
                $uploadFile = $image['file'] ?? null;
                if ($uploadFile !== null) {
                    $fileOriginalName = $uploadFile->getClientOriginalName();
                    $filePath = $monument->getKey().'/'.$image['ordering'].$fileOriginalName;
                    $storageReceptionClient->put($filePath, $uploadFile->getContent());
                }
            }
        }

//        dd($frd, storage_path('reception'));

//        dd($monument);

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $monument->getName() . '» сохранена']];

        return redirect()->route('monuments.edit', $monument)->with(compact('flashMessages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        $frd = $request->all();

        return view('monuments.store', compact('frd'));
    }

    /**
     * @param Request $request
     * @param Monument $monument
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, Monument $monument)
    {
        $frd = $request->all();

        return view('monuments.edit', compact('frd', 'monument'));
    }

    /**
     * @param Request $request
     * @param Monument $monument
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Monument $monument)
    {
        $frd = $request->all();
        $frd['description'] = $frd['monument-trixFields']['description'] ?? '';
        $monument->update($frd);

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $monument->getName() . '» сохранена']];

        return redirect()->back()->with(compact('flashMessages', 'monument', 'frd'));
    }

    /**
     * @param Request $request
     * @param Monument $monument
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Monument $monument)
    {
        $frd = $request->all();
        $monument->delete();

        $flashMessages = [['type' => 'success', 'text' => 'Валюта «' . $monument->getName() . '» удалена']];

        return redirect()->route('monuments.index')->with(compact('frd', 'flashMessages'));
    }
}
