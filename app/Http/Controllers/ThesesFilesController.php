<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\These;
use App\Models\ThesesFiles;
use Illuminate\Support\Facades\Storage;

class ThesesFilesController extends Controller
{
    //

    /**
     * Gets a file by its id
     */
    function get($id){
        $these = These::with('files')->find($id);

        if (!$these) {
            return response()->json(['message' => 'These not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => "Files retrieved successfully",
            'data' => $these->files
        ], 200);
        // $file = $this->get_file_record(request()->id);

        // // if(!$file)
        // //     return NotFoundError::get("file");

        // return response()->json([
        //     'status' => 200,
        //     'message' => "File CRetrieved successfully",
        //     'data' => $file], 200);
    }

    /**
     * Gets all files
     */
    function get_all()
    {
        return response()->json([
            'status' => 200,
            'message' => "File CRetrieved successfully",
            'data' => ThesesFiles::get()], 200);
    }

    
    /**
     * downloads a file by its id
     */
    function download(){
        $file = $this->get_file_record(request()->id);

        // if(!$file)
        //     return NotFoundError::get("File");

        return Storage::disk('s3')->download($file->name);
    }


    /**
     * Creates a new file
     */
    function post()
    {

        // $facture = Facture::where([['id', request()->get('facture_id')], ['archived', 0]])->first();
        $facture = These::where([['id', request()->get('these_id')]])->first();

        if (!$facture) {
            return response()->json(['message' => 'These not found'], 404);
        }
    
        if (!request()->hasFile('files')) {
            return response()->json(['message' => 'No files uploaded'], 400);
        }
    
        $files = request()->file('files');
        foreach ($files as $file) {
            $fileName = Storage::disk('s3')->put("these_" . request()->get('these_id'), $file);
            $thesesFile = ThesesFiles::create([
                'name' => $fileName,
                'original_name' => $file->getClientOriginalName(),
            ]);
            $facture->files()->save($thesesFile);
        }
        // if(!$facture)
        //     return NotFoundError::get("facture");


        // foreach (json_decode(request()->get('files')) as $key => $value) {
            
        //     $file = ThesesFiles::create(
        //         [
        //             'name' => Storage::disk('s3')->put(
        //                 "these_" . request()->get('these_id'), 
        //                 request()->file($value)
        //             ),
        //             'original_name' => request()->file($value)->getClientOriginalName(),
        //         ]
        //     ); 

        //     $facture->files()->save($file);

        // }
        

        return  response()->json([
            'status' => 200,
            'message' => "File Created successfully",
            'data' => $facture], 200);;
    }

    /**
     * Deletes a file
     */
    function delete(){
        $file = $this->get_file_record(request()->id);

        // if(!$file)
        //     return NotFoundError::get("File");

        // $file->update(['archived' => 1]);
        $file->delete();

        return (new Response(
            true, 
            'File deleted successfully',
            $file
        ))->get();
    }

    /**
     * Gets a file by its id
     * 
     * @param file_id{int}
     * @return File
     */
    public function get_file_record($file_id){
        // return SubsiteFile::where([['id', $file_id], ['archived', 0]])->first();
        return ThesesFiles::where([['id', $file_id]])->first();
    }
}
