<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;

class StatusController extends Controller
{
    public function index()
    {
        return response()->json(Status::all());
    }

    public function store(StoreStatusRequest $request)
    {

      if (!Auth::check() || Auth::user()->role !== 'admin') {
        return response()->json(['message' => 'Unauthorized'], 403);
      }
        $status = Status::create($request->validated());

        return response()->json($status, 201);
    }

    public function show(Status $status)
    {
        return response()->json($status);
    }

    public function update(UpdateStatusRequest $request, Status $status)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $status->update([
            'name' => $request->name,
        ]);

        return response()->json($status);
    }

    public function destroy(Status $status)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $status->delete();

        return response()->json(['message' => 'Status deleted successfully']);
    }
}
