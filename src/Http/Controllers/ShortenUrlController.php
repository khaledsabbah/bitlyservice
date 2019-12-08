<?php
namespace Bilty\BiltyServices\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
/**
 * Created by PhpStorm.
 * User: khaledgamal
 * Date: 11/6/19
 * Time: 2:02 AM
 */

class ShortenUrlController extends Controller
{

    /**
     * List the all Google UTM links from Bilty.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd($request);
        return response()->json([
            'actions' => $request->newResource()->availableActions($request),
            'pivotActions' => [
                'name' => $request->pivotName(),
                'actions' => $request->newResource()->availablePivotActions($request),
            ],
        ]);
    }


    /**
     * Perform an action to Save short Url.
     * @param  \Laravel\Nova\Http\Requests\ActionRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Laravel\Nova\Exceptions\MissingActionHandlerException
     */
    public function store(ActionRequest $request)
    {
        $request->validateFields();

        return $request->action()->handleRequest($request);
    }
}