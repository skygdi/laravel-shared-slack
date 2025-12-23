<?php

namespace Pg\Slack\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Pg\Slack\SlackGate;

class SlackDashboardController extends Controller
{
    public function index()
    {
        return view('slack::dashboard', [
            'slackSuspended'           => (bool) SlackGate::isSuspended(),
            'inventoryUpdateSuspended' => (bool) cache('inventory_update_suspended', false),
        ]);
    }

    
    public function toggleInventory(Request $request)
    {
        $validated = $request->validate([
            'suspended' => 'required|boolean',
        ]);

        //cache(['inventory_update_suspended' => (bool) $validated['suspended']], now()->addDays(30));
        cache()->forever('inventory_update_suspended', (bool) $validated['suspended']);

        return response()->json([
            'success'   => true,
            'suspended' => (bool) $validated['suspended'],
        ]);
    }

    public function toggleSlack(Request $request)
    {
        $suspend = $request->boolean('suspended');

        if ($suspend) {
            // You can pass minutes here if you want a timed suspend
            SlackGate::suspend(); // or SlackGate::suspend(60);
        } else {
            SlackGate::resume();
        }

        return response()->json([
            'success'        => true,
            'slackSuspended' => $suspend,
        ]);
    }
}
