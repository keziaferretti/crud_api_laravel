<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\StatusControllerInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StatusController extends Controller implements StatusControllerInterface
{
  private $status;

  public function __construct(Status $status)
  {
    $this->status = $status;
  }

  public function index()
  {
    $status = $this->status::all();

    return response()->json([
      'message' => 'Success',
      'data' => $status
    ]);
  }

  public function store(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'message' => 'Validation failed',
        'errors' => $validator->errors()
      ], 400);
    }

    $status = $this->status::create($validator->validated());

    if ($status) {
      return response()->json([
        'message' => 'Status created successfully',
        'data' => $status
      ], 200);
    }

    return response()->json([
      'message' => 'Failed to create status'
    ], 400);
  }

  public function show(string $id)
  {
    $status = $this->status::find($id);
    if ($status) {
      return response()->json([
        'message' => 'Success',
        'data' => $status
      ], 200);
    }

    return response()->json([
      'message' => 'Status not found'
    ], 404);
  }

  public function update(Request $request, string $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|min:3'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'message' => 'Validation failed',
        'errors' => $validator->errors()
      ], 400);
    }

    $validated = $validator->validated();
    $status = $this->status::find($id);

    if ($status) {
      $status->update($validated);
      return response()->json([
        'message' => 'Status updated successfully',
        'data' => $status
      ], 200);
    }

    return response()->json([
      'message' => 'Status not found'
    ], 404);
  }

  public function destroy(string $id)
  {
    $status = $this->status::find($id);

    if (!$status) {
      return response()->json([
        'message' => 'Status not found'
      ], 404);
    }

    if ($status->products()->exists()) {
      return response()->json([
        'message' => 'Cannot delete status because it is linked to one or more products'
      ], 400);
    }

    $status->delete();

    return response()->json([
      'message' => 'Status deleted successfully',
      'data' => 'ID delete ' . $id
    ], 200);
  }
}
