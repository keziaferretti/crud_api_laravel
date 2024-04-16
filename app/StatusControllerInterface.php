<?php

namespace App;
use Illuminate\Http\Request;

interface StatusControllerInterface
{
    public function searchStatus();
    public function createStatus(Request $request);
    public function searchIdStatus(string $id);
    public function updateStatus(Request $request, string $id);
    public function deleteStatus(string $id);
}
