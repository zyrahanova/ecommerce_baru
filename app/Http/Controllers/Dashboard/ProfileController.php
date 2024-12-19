<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

class ProfileController extends DashboardController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setTitle('Profile');

        $this->addBreadcrumb('Dashboard', route('dashboard.index'));
        $this->addBreadcrumb('Profile');

        $this->data['profile'] = auth()->user();

        return view('dashboard.profile.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
