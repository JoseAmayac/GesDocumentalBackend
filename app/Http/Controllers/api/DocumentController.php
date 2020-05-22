<?php

namespace App\Http\Controllers\api;

use App\Dependency;
use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use PDF;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::with('response')->with('dependency.users')->get();
        return response()->json([
            'documents' => $documents
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('file');

        if ($request->file('file')) {
            $file = $request->file('file');
            $name = 'file'. time() .$file->getClientOriginalName();

            $path = $file->storeAs('uploads',$name,'local');

            $data['filePath'] = $name;
        }
        $data['status'] = 0;
        $document = Document::create($data);
        

        return response()->json(['message' => 'Documento creado correctamente','id'=>$document->id],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        Storage::disk('local')->delete('/uploads/'.$document->filePath);
        if ($document->response) {
            Storage::disk('local')->delete('/responses/'.$document->response->filePath);
        }

        $document->delete();

        return response()->json([
            'message' => 'Documento eliminado correctamente'
        ],200);
    }

    public function generateVoucher($idDocument)
    {
        $pdf = PDF::loadView('pdfVouser');
        return $pdf->download('comprobante.pdf')->header('Content-Type', 'application/pdf');
        
    }
     
    public function getForDependency(){
        $documents = Document::where('status',1)->where('dependency_id',Auth::user()->dependency_id)->get();

        return response()->json([
            'documents' => $documents
        ],200);
    }

    public function getWithOutDependency(){
        $documents = Document::where('status',0)->where('dependency_id',null)->get();
        
        return response()->json($documents,200);
    }

    public function getFileFromStorage($name){
        $file = Storage::disk('local')->get('/uploads/'.$name);
        return response($file, 200)->header('Content-Type', 'application/pdf');
    }

    public function asignDependency(Request $request){

        $request->validate([
            'id' => 'required',
            'dependency_id' => 'required'
        ],[
            'id.required' => 'El documento es requerido',
            'dependency_id.required' => 'La dependencia a asignar es obligatoria'
        ]);

        $document = Document::findOrFail($request->get('id'));
        $document->dependency_id = $request->get('dependency_id');
        $document->status = 1;
        $document->update();

        return response()->json([
            'message' => 'Dependencia asignada correctamente'
        ],201);
    }
}
