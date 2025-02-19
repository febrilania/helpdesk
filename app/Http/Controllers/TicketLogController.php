<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketLogController extends Controller
{
    public function ubah_status(Request $request, $id){
        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $userId = auth()->user()->id;
        
        $ticket = Ticket::findOrfail($id);
        $ticket->update($validated);

        TicketLogs::create([
            'ticket_id' => $ticket->id,
            'user_id' => $userId,
            'aksi' => 'perubahan status pada tiket' . $ticket->subject
        ]);

        if(Auth::user()->role == "staff"){
            return redirect()->route('get_ticket.staff')->with('success', 'perubahan status berhasil');
        } else {
            return redirect()->route('get_ticket.admin')->with('success', 'perubahan status berhasil');
        }
    }
}
