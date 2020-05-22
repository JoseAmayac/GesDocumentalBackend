<?php

namespace App\Http\Controllers\api;

use App\Document;
use App\Http\Controllers\Controller;
use App\ResponseDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResponseDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('filePath');

        if ($request->file('filePath')) {
            $file = $request->file('filePath');
            $name = 'file'. time() .$file->getClientOriginalName();

            $path = $file->storeAs('responses',$name,'local');
            $data['filePath'] = $name;
        }
        $document = ResponseDocument::create($data);

        $document = Document::findOrFail($request->get('document_id'));
        $document->status = 2;
        $document->update();

        
        return response()->json(['message' => 'La respuesta del documento ha sido registrada','id'=>$document->id],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResponseDocument  $responseDocument
     * @return \Illuminate\Http\Response
     */
    public function show(ResponseDocument $responseDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResponseDocument  $responseDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResponseDocument $responseDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResponseDocument  $responseDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResponseDocument $responseDocument)
    {
        //
    }

    public function getFileFromStorage($name){
        $file = Storage::disk('local')->get('/responses/'.$name);
        return response($file, 200)->header('Content-Type', 'application/pdf');
    }
}
