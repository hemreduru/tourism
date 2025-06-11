<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Status;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Admin\ContactRequest;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::with('status')->select('contacts.*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($contact) {
                    $actions = '<div class="btn-group" role="group" aria-label="Basic example">';

                    if (auth()->user()->hasPermission('contacts.view')) {
                        $showUrl = route('admin.contacts.show', $contact->id);
                        $actions .= '<a href="' . $showUrl . '" class="btn btn-primary btn-sm" title="' . __('common.view') . '"><i class="fas fa-eye"></i></a>';
                    }

                    if (auth()->user()->hasPermission('contacts.edit')) {
                        $editUrl = route('admin.contacts.edit', $contact->id);
                        $actions .= ' <a href="' . $editUrl . '" class="btn btn-info btn-sm" title="' . __('common.edit') . '"><i class="fas fa-edit"></i></a>';
                    }

                    if (auth()->user()->hasPermission('contacts.delete')) {
                        $actions .= ' <button data-id="' . $contact->id . '" class="btn btn-danger btn-sm delete-contact" title="' . __('common.delete') . '"><i class="fas fa-trash"></i></button>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->editColumn('date', function ($contact) {
                    return $contact->date->format('d.m.Y');
                })
                ->addColumn('date_time', function ($contact) {
                    return $contact->date_time;
                })
                ->editColumn('is_read', function ($contact) {
                    return $contact->is_read ? '<span class="badge badge-success">' . __('common.yes') . '</span>' : '<span class="badge badge-danger">' . __('common.no') . '</span>';
                })
                ->editColumn('is_responded', function ($contact) {
                    return $contact->is_responded ? '<span class="badge badge-success">' . __('common.yes') . '</span>' : '<span class="badge badge-danger">' . __('common.no') . '</span>';
                })
                ->addColumn('status', function ($contact) {
                    $color = $contact->status ? $contact->status->color : '#333';
                    if ($contact->status) {
                        return '<span class="badge" style="background-color: ' . $color . '; color: #fff;">' .
                               $contact->status['name_' . app()->getLocale()] . '</span>';
                    }
                })
                ->editColumn('created_at', function ($contact) {
                    return $contact->created_at->format('d.m.Y H:i:s');
                })
                ->rawColumns(['action', 'is_read', 'is_responded', 'status'])
                ->make(true);
        }

        return view('admin.contacts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Saat aralıkları için önceden tanımlanmış değerler
        $timeSlots = self::getTimeSlots();
        // Tüm durumları getir
        $statuses = Status::all();

        return view('admin.contacts.create', compact('timeSlots', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
        DB::beginTransaction();
        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date' => $request->date,
                'time_slot' => $request->time_slot,
                'message_en' => $request->message_en,
                'message_tr' => $request->message_tr,
                'message_nl' => $request->message_nl,
                'status_id' => $request->status_id,
                'language' => $request->language,
                'is_read' => $request->has('is_read'),
                'is_responded' => $request->has('is_responded'),
            ]);

            DB::commit();
            Log::info('Contact record created. Created by: ' . auth()->id());

            return redirect()->route('admin.contacts.index')
                ->with('success', __('common.created_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating contact record: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', __('common.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        // Eğer daha önce okunmadıysa, okundu olarak işaretle
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        // Eager load status
        $contact->load('status');

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        // Saat aralıkları için önceden tanımlanmış değerler
        $timeSlots = self::getTimeSlots();
        // Tüm durumları getir
        $statuses = Status::all();

        return view('admin.contacts.edit', compact('contact', 'timeSlots', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        DB::beginTransaction();
        try {
            $contact->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date' => $request->date,
                'time_slot' => $request->time_slot,
                'message_en' => $request->message_en,
                'message_tr' => $request->message_tr,
                'message_nl' => $request->message_nl,
                'status_id' => $request->status_id,
                'language' => $request->language,
                'is_read' => $request->has('is_read'),
                'is_responded' => $request->has('is_responded'),
            ]);

            DB::commit();
            Log::info('Contact record updated. Contact->id: ' . $contact->id . '. Updated by: ' . auth()->id());

            return redirect()->route('admin.contacts.index')
                ->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating contact record: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', __('common.error_updating'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        DB::beginTransaction();
        try {
            $contact->delete();

            DB::commit();
            Log::info('Contact record deleted. Contact->id: ' . $contact->id . '. Deleted by: ' . auth()->id());
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting contact record: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => __('common.error_deleting') . ' ' . $e->getMessage()]);
        }
    }

    /**
     * Önceden tanımlanmış saat aralıklarını döndürür
     */
    public static function getTimeSlots()
    {
        return [
            '09:00 - 09:30' => '09:00 - 09:30',
            '09:30 - 10:00' => '09:30 - 10:00',
            '10:00 - 10:30' => '10:00 - 10:30',
            '10:30 - 11:00' => '10:30 - 11:00',
            '11:00 - 11:30' => '11:00 - 11:30',
            '11:30 - 12:00' => '11:30 - 12:00',
            '13:00 - 13:30' => '13:00 - 13:30',
            '13:30 - 14:00' => '13:30 - 14:00',
            '14:00 - 14:30' => '14:00 - 14:30',
            '14:30 - 15:00' => '14:30 - 15:00',
            '15:00 - 15:30' => '15:00 - 15:30',
            '15:30 - 16:00' => '15:30 - 16:00',
            '16:00 - 16:30' => '16:00 - 16:30',
            '16:30 - 17:00' => '16:30 - 17:00',
            '17:00 - 17:30' => '17:00 - 17:30',
            '17:30 - 18:00' => '17:30 - 18:00',
        ];
    }
}
