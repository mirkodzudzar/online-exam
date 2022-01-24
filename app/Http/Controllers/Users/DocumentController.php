<?php

namespace App\Http\Controllers\Users;

use App\Models\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $this->authorize($candidate->document);

        Storage::delete($candidate->document->path);
        $candidate->document()->delete();

        return redirect()->back()
                         ->withStatus('You have removed your CV document successfully.');
    }
}
