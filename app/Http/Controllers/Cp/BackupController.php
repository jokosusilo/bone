<?php

namespace App\Http\Controllers\Cp;

use Artisan;
use Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!count(config('backup.backup.destination.disks'))) {
            exit('Please specify destination disk in `backup.backup.destination.disks`');
        }

        $backups = collect(config('backup.backup.destination.disks'))
                    ->map(function($diskName){
                        return collect(Storage::disk($diskName)->allFiles(config('backup.backup.name')))
                            ->filter(function($file){
                                return substr($file, -4) == '.zip';
                            })
                            ->map(function($file) use ($diskName){
                                return [
                                    'disk' => $diskName,
                                    'file_date' => Carbon::createFromTimeStamp(Storage::lastModified($file))->formatLocalized('%d %B %Y, %H:%M'),
                                    'file_size' => number_format(Storage::size($file)/1048576,2).' MB',
                                    'file_path' => $file,
                                    'file_name' => str_replace(config('backup.backup.name').'/', '', $file)
                                ];
                            })
                            ->all();
                    })
                    ->flatten(1)
                    ->reverse()
                    ->all();

        return view('cp.backup.index', [
            'backups' => $backups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            ini_set('max_execution_time', 600);
            Artisan::call('backup:run');

            return redirect(route('cp.backups.index'))
                    ->with('success', 'Backup berhasil dilakukan.');

        } catch (Exception $e) {
            Response::make($e->getMessage(), 500);
        }
    }

    /**
     * Download backup from storage.
     *
     * @param  String disk
     * @param  String filename
     * @return \Illuminate\Http\Response
     */
    public function download($disk, $filename)
    {
        if ($disk !== 'local') {
            return redirect(route('cp.backups.index'))
                    ->with('error', "Download file hanya support untuk disk `local`.");
        }

        $filePath = storage_path('app/'.config('backup.backup.name').'/'.$filename);

        if (file_exists($filePath)) {
            return response()
                    ->download($filePath, config('backup.backup.name').'_'.$filename);
        }

        return redirect(route('cp.backups.index'))
                    ->with('error', "Download file `{$filename}` di disk `{$disk}` gagal. File tidak ditemukan.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $disk = Storage::disk($request->disk);

        if ($disk->exists($request->file_path)) {
            $disk->delete($request->file_path);

            return redirect(route('cp.backups.index'))
                    ->with('success', 'Backup berhasil dihapus.');
        }

        return redirect(route('cp.backups.index'))
                    ->with('error', "Backup file `{$request->file_path}` di disk `{$request->disk}` gagal dihapus.");
    }
}
