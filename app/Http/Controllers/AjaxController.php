<?php
namespace App\Http\Controllers;

use App\Repositories\TeamRepository;
use Illuminate\Http\Request;

/**
 * Class AjaxController.
 */
class AjaxController extends Controller
{
    /**
     * @var teamRepository
     */
    public $teamRepository;


    /**
     * FrontendController constructor.
     *
     * @param TeamRepository $teamRepo
     */
    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepository = $teamRepo;

    }

    /**
     * Loead partial team view
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadTeamView(Request $request)
    {
        $teams = $request->data;

        $view = view("frontend.partial.teampartial",compact('teams'))->render();

        return response()->json(['status' => 'success', 'data' => $view]);
    }

    /**
     * Loead partial team player view
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadTeamPlayerView(Request $request)
    {
        $players = $request->data;

        $view = view("frontend.partial.teamdetailspartial",compact('players'))->render();

        return response()->json(['status' => 'success', 'data' => $view]);
    }

     /**
     * Load admin partial team view
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadAdminTeamView(Request $request)
    {
        $teams = $request->data;

        $view = view("backend.partial.teampartial",compact('teams'))->render();

        return response()->json(['status' => 'success', 'data' => $view]);
    }

     /**
     * Loead partial team player view
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadAdminPlayerView(Request $request)
    {
        $players = $request->data;
        $teams = $request->team;
        $view = view("backend.partial.playerpartial",compact('players','teams'))->render();

        return response()->json(['status' => 'success', 'data' => $view]);
    }

    
}
