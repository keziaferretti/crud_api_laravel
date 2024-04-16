<?php

namespace App;

use Illuminate\Http\Request;

interface ProductControllerInterface
{
    public function index();
    public function rules();
    public function messages();
    public function store(Request $request);
    public function show(string $id);
    public function update(Request $request, string $id);
    public function destroy(string $id);
}
