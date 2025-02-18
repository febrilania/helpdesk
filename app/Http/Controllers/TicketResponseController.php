<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;

class TicketResponseController extends Controller
{

    public function form_response($ticketId){
        $ticket = Ticket::findORfail($ticketId);
        return view('staff/form_response', compact('ticket'));        
    }

    public function create(Request $request, $ticketId)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:5',
        ]);

        $user_id = auth()->id();

        $response = TicketResponse::create([
            'message' => $validated['message'],
            'user_id' => $user_id,
            'ticket_id' => $ticketId
        ]);

        return redirect()->route('get_ticket.staff')->with('success', 'respon berhasil dikirim');
    }
}
