<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lists;

class ListsController extends Controller
{
    // Create a new list
    public function create(Request $request) {
        $list = new lists();
        $list->list_name = $request->list_name;
        $list->save();

        return response()->json($list, 201);
    }

    // Update an existing list
    public function update(Request $request, $id) {
        $list = lists::findOrFail($id);
        $list->list_name = $request->list_name;
        $list->save();

        return response()->json($list, 200);
    }

    // Delete a list
    public function delete($id) {
        $list = lists::findOrFail($id);
        $list->delete();

        return response()->json(null, 204);
    }
}