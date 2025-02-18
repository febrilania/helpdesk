<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function get()
    {
        $tickets = Ticket::all();
        $categories = Category::all();
        if (Auth::user()->role == 'mahasiswa') {
            return view('mahasiswa/ticket', compact('tickets', 'categories'));
        } else if (Auth::user()->role == 'staff') {
            return view('staff/ticket', compact('tickets', 'categories'));
        } else {
            return view('admin/ticket', compact('tickets', 'categories'));
        }
    }

    public function form_ticket()
    {
        $categories = Category::all();

        return view('mahasiswa/form_ticket', compact('categories'));
    }

    public function detail($id)
    {
        $ticket = Ticket::with(['user', 'category', 'bagian'])->findOrFail($id);
        if (Auth::user()->role == 'mahasiswa') {
            return view('mahasiswa/detail_ticket', compact('ticket'));
        } else if (Auth::user()->role == 'staff') {
            return view('staff/detail_ticket', compact('ticket'));
        } else {
            return view('admin/detail_ticket', compact('ticket'));
        }
    }

    public function add(Request $request)
    {

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subject' => 'required|string|',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $userId = auth()->user()->id;

        Ticket::create([
            'user_id' => $userId,
            'category_id' => $validated['category_id'],
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'bagian' => $request->bagian ?? null,
        ]);

        return redirect()->route('get_ticket.mahasiswa')->with('success', 'Tiket berhasil dibuat!');
    }

    public function delete($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('get_ticket.mahasiswa')->with('success', 'data berhasil dihapus');
    }
}
