<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $domain = Domain::all();
        return view('Admin.domain')->with('domain',$domain);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'domain' => 'required|max:999',
            'paydate' => 'required|max:999',
            'expiredate' => 'required|max:999',
            'paymethod' => 'required|max:999',
            'paysumma' => 'required|max:999',
            'email' => 'required|max:999'

        ]);
        $domain = new Domain();
        $domain->domain = $request->input('domain');
        $domain->paydate = $request->input('paydate');
        $domain->expiredate = $request->input('expiredate');
        $domain->paymethod = $request->input('paymethod');
        $domain->paysumma = $request->input('paysumma');
        $domain->email = $request->input('email');

        $domain->save();

        return redirect('/domain')->with('success', 'Все данные сохранены');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $domain=Domain::findOrFail($id);
        return view('Admin.domain-edit')->with('domain',$domain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'domain' => 'required|max:999',
            'paydate' => 'required|max:999',
            'expiredate' => 'required|max:999',
            'paymethod' => 'required|max:999',
            'paysumma' => 'required|max:999',
            'email' => 'required|max:999'

        ]);
        $domain = Domain::find($id);
        $domain->domain = $request->input('domain');
        $domain->paydate = $request->input('paydate');
        $domain->expiredate = $request->input('expiredate');
        $domain->paymethod = $request->input('paymethod');
        $domain->paysumma = $request->input('paysumma');
        $domain->email = $request->input('email');

        $domain->update();
        return redirect('/domain')->with('success','Все данные обновлены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $domain =Domain::findOrFail($id);
        $domain ->delete();
        return redirect('/domain')->with('status','Все данные данного дамена удалены');
    }
}
