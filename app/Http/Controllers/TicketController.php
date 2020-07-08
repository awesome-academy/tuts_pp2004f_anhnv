<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::paginate(50);

        return view('admin_default.pages.ticket_index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_default.pages.ticket_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $validator = $request->validated();

        $request['slug'] = uniqid();
        $request['user_id'] = Auth::user()->id;
        $ticket = Ticket::create($request->all());
        
        $save = $ticket->save();

        if ($save) {
            try {
                Mail::send('emails.ticket_created', ['ticket' => $ticket['slug']], function($message){
                    $message->from('vietanh.dev88@gmail.com', 'Laravel Ticket Manager App');
                    $message->to('wetagik475@frost2d.net')->subject('Hi! There is a new ticket created');
                    // go to https://temp-mail.org/vi for test with this email address
                });
            } catch(\Exception $e) {

            }

            return redirect()->route('admin.tickets.index')
                ->withMessage('Congrats! You have created a ticket successfully')
                ->withTicket($ticket->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->with(['comments.user'])->first();
        return view('admin_default.pages.ticket_details', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return view('admin_default.pages.ticket_edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketFormRequest $request, $id)
    {
        $request->validated();

        try {
            $ticket = Ticket::find($id)->fill($request->all());
            $ticket->status = $request->status ? 0 : 1;
            $ticket->save();
        } catch(\Exception $e) {
            
        }

        return redirect()->route('admin.tickets.show', $id)
            ->withMessage('Congrats! You have update this ticket successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::withTrashed()->find($id);

        try {
            $ticket->forceDelete();
            throw new \Exception('Ko the xoa ticket nay');
        } catch(\Exception $e) {
            
        }
        return redirect()->route('admin.tickets.trash')
            ->withMessage('You have deleted a ticket successfully');
    }

    public function trash()
    {
        $tickets = Ticket::onlyTrashed()->get();

        return view('admin_default.pages.ticket_trash', compact('tickets'));
    }

    public function delete($id)
    {
        $ticket = Ticket::find($id)->delete();
        
        if (Ticket::withTrashed()->find($id)) {
            return redirect()->route('admin.tickets.index')
                ->withMessage('Congrats! You have sent a ticket to trash successfully');
        }
    }

    public function showTrashed($id)
    {
        $ticket = Ticket::withTrashed()->find($id);

        return view('admin_default.pages.ticket_details', compact('ticket'));
    }

    public function editTrashed($id)
    {
        $ticket = Ticket::withTrashed()->find($id);

        return view('admin_default.pages.ticket_edit', compact('ticket'));
    }

    public function updateTrashed(TicketFormRequest $request, $id)
    {
        $request->validated();

        try {
            $ticket = Ticket::withTrashed()->find($id)->fill($request->all());
            $ticket->status = $ticket->status ? 0 : 1;
            $ticket->save();
        } catch(\Exception $e) {

        }
        
        return redirect()->route('admin.tickets.showTrashed', $id)
            ->withMessage('You have updated a ticket successfully!');
    }

    public function restore($id)
    {
        $ticket = Ticket::withTrashed()->find($id)->restore();

        if (Ticket::withoutTrashed()->find($id)) {
            return redirect()->route('admin.tickets.index')
                ->withMessage('Congrats! You have restored a ticket successfully');
        }
    }
}
