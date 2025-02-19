<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketResponseController extends Controller
{

    public function form_response($ticketId)
    {
        $ticket = Ticket::findORfail($ticketId);
        if (Auth::user()->role == 'staff') {
            return view('staff/form_response', compact('ticket'));
        } elseif (Auth::user()->role == 'admin') {
            return view('admin/form_response', compact('ticket'));
        }
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
        if (Auth::user()->role == 'staff') {
            return redirect()->route('get_ticket.staff')->with('success', 'respon berhasil dikirim');
        } elseif (Auth::user()->role == 'admin') {
            return redirect()->route('get_ticket.admin')->with('success', 'respon berhasil dikirim');
        }
    }
}
