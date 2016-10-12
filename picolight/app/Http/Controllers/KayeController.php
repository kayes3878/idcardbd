<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Kaye;
use Illuminate\Http\Request;

class KayeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$kayes = Kaye::orderBy('id', 'desc')->paginate(10);

		return view('kayes.index', compact('kayes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('kayes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$kaye = new Kaye();

		$kaye->title = $request->input("title");
        $kaye->body = $request->input("body");

		$kaye->save();

		return redirect()->route('kayes.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$kaye = Kaye::findOrFail($id);

		return view('kayes.show', compact('kaye'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$kaye = Kaye::findOrFail($id);

		return view('kayes.edit', compact('kaye'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$kaye = Kaye::findOrFail($id);

		$kaye->title = $request->input("title");
        $kaye->body = $request->input("body");

		$kaye->save();

		return redirect()->route('kayes.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$kaye = Kaye::findOrFail($id);
		$kaye->delete();

		return redirect()->route('kayes.index')->with('message', 'Item deleted successfully.');
	}

}
