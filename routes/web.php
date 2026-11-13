<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\{OfferedSubject, Result, Layout, Session, User, Subjects, StudentRequest, StudentDetail, Payment, AccessPermission, CandidateAndUciNumber, SeatingArrangement, CandidateInvoice};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// test
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();


Route::get('/all-papers', [App\Http\Controllers\PublicController::class, 'allpapers'])->name('allpapers');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/view-students', [App\Http\Controllers\HomeController::class, 'viewStudent'])->name('viewStudent');
Route::get('/add-session', [App\Http\Controllers\HomeController::class, 'addSession'])->name('addSession');
Route::post('/store-session', [App\Http\Controllers\HomeController::class, 'storeSession'])->name('storeSession');
Route::get('/view-sessions', [App\Http\Controllers\HomeController::class, 'viewSession'])->name('viewSession');
Route::delete('/delete-session/{id}', [App\Http\Controllers\HomeController::class, 'deleteSession']);
Route::get('/edit-session/{id}', [App\Http\Controllers\HomeController::class, 'editSession']);
Route::put('/update-session', [App\Http\Controllers\HomeController::class, 'updateSession'])->name('updateSession');
Route::get('/add-student', [App\Http\Controllers\HomeController::class, 'addStudent'])->name('addStudent');
// Route::post('/submit-student', [App\Http\Controllers\HomeController::class, 'submitStudent'])->name('submitStudent');
Route::get('/student-request', [App\Http\Controllers\HomeController::class, 'studentRequest'])->name('studentRequest');
Route::delete('/delete-request/{id}', [App\Http\Controllers\HomeController::class, 'deleteRequest'])->name('student-requests.delete');
Route::get('/edit-request/{id}', [App\Http\Controllers\HomeController::class, 'editRequest'])->name('editRequest');
Route::post('/approve-proceed/{id}', [App\Http\Controllers\HomeController::class, 'approveProceed'])->name('approveProceed');
Route::get('/get-timetable-subjs', [App\Http\Controllers\HomeController::class, 'getTimetableSubjs'])->name('get.timetable.subjs');
Route::get('/approved-request', [App\Http\Controllers\HomeController::class, 'approvedRequest'])->name('approvedRequest');
Route::get('/modify-approved-student/{id}', [App\Http\Controllers\HomeController::class, 'modifyApprovedStudent'])->name('modifyApprovedStudent');
Route::post('/update-approved-student/{id}', [App\Http\Controllers\HomeController::class, 'updateApprovedStudent'])->name('updateApprovedStudent');
Route::get('/help', [App\Http\Controllers\HomeController::class, 'help'])->name('help');
Route::get('/view-request/{id}', [App\Http\Controllers\HomeController::class, 'viewRequest'])->name('viewRequest');
Route::get('/view-request-studentReq/{id}', [App\Http\Controllers\HomeController::class, 'viewRequestStu'])->name('viewRequest');
Route::post('student-requests/send-exam-registration-email', [App\Http\Controllers\HomeController::class, 'sendExamRegistrationEmail'])->name('student-requests.send-exam-registration-email');


Route::get('/migrate-student/{student_id}', [App\Http\Controllers\HomeController::class, 'migrateStudent'])->name('migrateStudent');


Route::post('/custom-login', [App\Http\Controllers\CustomLoginController::class, 'customLogin'])->name('customLogin');
Route::get('/generate-timetable', [App\Http\Controllers\HomeController::class, 'generateTimetable'])->name('generateTimetable');
Route::get('/view-datesheet', [App\Http\Controllers\HomeController::class, 'viewDatesheet'])->name('viewDatesheet');
Route::get('get-board', [App\Http\Controllers\HomeController::class, 'getBoard'])->name('getBoard');
Route::get('create-payment', [App\Http\Controllers\HomeController::class, 'createayments'])->name('createayments');
Route::post('/payments/store', [App\Http\Controllers\HomeController::class, 'paymentStore'])->name('paymentStore');

Route::post('/get-student', [App\Http\Controllers\HomeController::class, 'getStudent'])->name('get-student');

Route::get('/view-payments', [App\Http\Controllers\HomeController::class, 'viewPayment'])->name('viewPayment');

Route::get('/payments/{payment}/edit', [App\Http\Controllers\HomeController::class, 'editPayment'])->name('payments.edit');
Route::delete('/payments/{payment}', [App\Http\Controllers\HomeController::class, 'destroyPayment'])->name('payments.destroy');
Route::put('/payments/{payment}', [App\Http\Controllers\HomeController::class, 'updatePayment'])->name('payments.update');

Route::get('export-all-timetables', [App\Http\Controllers\HomeController::class, 'exportAllTimetable']);


Route::get('create-user', [App\Http\Controllers\HomeController::class, 'createUser']);
Route::post('store-user', [App\Http\Controllers\HomeController::class, 'storeUser']);
Route::get('view-users', [App\Http\Controllers\HomeController::class, 'viewUser']);
Route::get('/users/{user}/edit', [App\Http\Controllers\HomeController::class, 'editUser'])->name('users.edit');
Route::put('/update-user/{user}', [App\Http\Controllers\HomeController::class, 'updateUser'])->name('users.update');
Route::delete('/users/{user}', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('users.destroy');

Route::get('view-sheet-data', [App\Http\Controllers\HomeController::class, 'viewSheetData']);
Route::get('seat-tags', [App\Http\Controllers\HomeController::class, 'seatTag']);
Route::get('store-layout', [App\Http\Controllers\HomeController::class, 'storeLayout']);
Route::get('get-layouts', [App\Http\Controllers\HomeController::class, 'getLayout']);

use App\Http\Controllers\PermissionController;

Route::get('/users/{id}/permissions', [App\Http\Controllers\HomeController::class, 'allowPermission'])->name('allow.permission');
Route::post('/store/permission/access', [App\Http\Controllers\HomeController::class, 'storePermission'])->name('store.permission');

Route::get('getClassData', [App\Http\Controllers\HomeController::class, 'getClassData'])->name('getClassData');

Route::post('/student-requests/send-email', [App\Http\Controllers\HomeController::class, 'sendEmailIndividualPendingCandidate'])->name('student-requests.send-email');


Route::get('/view-sheet-data', [App\Http\Controllers\HomeController::class, 'viewSheetData'])->name('view.sheet.data');
Route::get('/edit-candidate/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('candidates.edit');
Route::put('/candidates/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('candidates.update');
Route::get('/delete-candidate/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('candidates.destroy');


Route::get('/exam-report', [App\Http\Controllers\HomeController::class, 'examReport'])->name('examReport');

Route::get('/exam/report/{year}/{month}/{day}', [App\Http\Controllers\HomeController::class, 'examReportDetail'])
    ->name('exam.report.detail');
Route::get('get-details', [App\Http\Controllers\HomeController::class, 'getDetails'])->name('getDetails');


Route::get('internal-timetable', [App\Http\Controllers\HomeController::class, 'internalTimetable']);

Route::get('spoken-coursework', [App\Http\Controllers\HomeController::class, 'spokenCourseWork']);
Route::get('search-candidate', [App\Http\Controllers\HomeController::class, 'searchCandidate']);
Route::get('exam-report-by-subject', [App\Http\Controllers\HomeController::class, 'examReportBySubject'])->name('examReportBySubject');
Route::get('get-filtered-candidate-count', [App\Http\Controllers\HomeController::class, 'getFilteredCandidateCount'])->name('getFilteredCandidateCount');
Route::get('access-arrangement-report', [App\Http\Controllers\HomeController::class, 'accessArrangementReport'])->name('accessArrangementReport');
Route::get('candidate-approval-report', [App\Http\Controllers\HomeController::class, 'candidateApprovalReport'])->name('candidateApprovalReport');

Route::get('/get-candidate-data/{id}', [App\Http\Controllers\HomeController::class, 'getCandidatedata']);
Route::get('/upload-result-pdf', [App\Http\Controllers\HomeController::class, 'uploadresultPDf'])->name('upload.result.pdf');
Route::post('/upload-result-pdf', [App\Http\Controllers\HomeController::class, 'uploadResults'])->name('upload.result.store');
Route::get('delete-pdf-data/{id}', [App\Http\Controllers\HomeController::class, 'deletePdfData']);

Route::get('send-results', [App\Http\Controllers\HomeController::class, 'sendResults'])->name('sendResults');
Route::get('/email-logs', [App\Http\Controllers\HomeController::class, 'emailLogs'])->name('email.logs');

// ── Important Message Email Tracking ─────────────────────────────────────────
// These must be outside auth middleware so email clients can load the pixel freely.
Route::get('/email-track/{id}', [App\Http\Controllers\HomeController::class, 'trackEmailOpen'])->whereNumber('id')->name('email.track.open');
Route::get('/email-track/{id}.png', [App\Http\Controllers\HomeController::class, 'trackEmailOpen'])->whereNumber('id')->name('email.track.open.png');
Route::get('/important-message-report', [App\Http\Controllers\HomeController::class, 'importantMessageEmailReport'])->name('important.message.report');

Route::post('/send-emails', [App\Http\Controllers\HomeController::class, 'sendEmails']);
Route::post('send-individual-email/{id}', [App\Http\Controllers\HomeController::class, 'sendSingleMail']);
Route::post('ignore-candidate/{id}', [App\Http\Controllers\HomeController::class, 'ignoreEmail']);

Route::get('/modify-records', [App\Http\Controllers\HomeController::class, 'modifyRecords']);
Route::post('add-candidate', [App\Http\Controllers\HomeController::class, 'addCandidate'])->name('addCandidate');

Route::get('/ignored-emails', [App\Http\Controllers\HomeController::class, 'rejectEmail']);
Route::post('/undo-reject/{candidateId}', [App\Http\Controllers\HomeController::class, 'undoReject'])->name('undo.reject');


Route::get('widthraw-student/{id}', [App\Http\Controllers\HomeController::class, 'widthrawStudent']);
Route::get('undo-student/{id}', [App\Http\Controllers\HomeController::class, 'undoStudent']);
Route::get('unapprove-student/{id}', [App\Http\Controllers\HomeController::class, 'unapproveStudent']);
Route::post('send-timetable', [App\Http\Controllers\HomeController::class, 'sendTimeTable']);



Route::get('/testmailing', function () {

    $toEmails = [
       
        'inaam.chishti2@gmail.com',
    ];

    $subject = 'Test Email - Time Verification';
    $currentTime = now()->format('Y-m-d H:i:s');

    $message = "
        <h3>Test Email - Time Verification</h3>
        <p><strong>Current Timestamp:</strong> {$currentTime}</p>
        <p>This email was dispatched from the server at the above time.</p>
    ";

    \Mail::html($message, function ($mail) use ($toEmails, $subject) {
        $mail->to($toEmails)->subject($subject);
    });

    return "Test email sent successfully at {$currentTime}";
})->name('testmailing');


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

// ── Referrals CRUD ──────────────────────────────────────────────────────────
Route::get('/referrals',          [App\Http\Controllers\ReferralController::class, 'index'])->name('referrals.index');
Route::post('/referrals',         [App\Http\Controllers\ReferralController::class, 'store'])->name('referrals.store');
Route::get('/referrals/{id}',     [App\Http\Controllers\ReferralController::class, 'show'])->name('referrals.show');
Route::put('/referrals/{id}',     [App\Http\Controllers\ReferralController::class, 'update'])->name('referrals.update');
Route::delete('/referrals/{id}',  [App\Http\Controllers\ReferralController::class, 'destroy'])->name('referrals.destroy');

// ── Referral Report ─────────────────────────────────────────────────────────
Route::get('/referral-report',    [App\Http\Controllers\ReferralController::class, 'report'])->name('referrals.report');

// customLogin
Route::post('/update-session', function (Request $request) {
    $validated = $request->validate([
        'session' => 'required|string'
    ]);

    session(['current_session' => $validated['session']]);

    return response()->json([
        'success' => true,
        'message' => 'Session updated successfully'
    ]);
});


Route::get('/check-session', function (Request $request) {
    dd(session('current_session'));
});

// Route::get('/changes', function(Request $request) {
//     dd(DB::table('offered_subjects')
//     ->where('examboard', 'Perason')
//     ->where('qualification', 'A Level')
//     ->where('code', '9HT0')
//     ->where('description', 'History Of Art')
//     ->first());

// });



Route::get('/cred', function () {
    $email = 'admin@gmail.com';
    $password = 'Abdul@46$L45gHF4892*&';

    // Check if user already exists
    $existingUser = User::where('email', $email)->first();
    if ($existingUser) {
        return "User with this email already exists.";
    }

    // Create new user
    $admin = new User();
    $admin->name = 'Admin'; // You can customize this
    $admin->email = $email;
    $admin->password = Hash::make($password);
    $admin->save();

    return "New admin user has been created.";
});


Route::get('/public-page', [App\Http\Controllers\PublicController::class, 'showPublicPage'])->name('public.page');
Route::post('/submit-student', [App\Http\Controllers\PublicController::class, 'submitStudent'])->name('submitStudent');
Route::get('import-offered-subjects', [App\Http\Controllers\PublicController::class, 'showImportForm'])->name('showImportForm');
Route::get('import-datesheet-subjects', [App\Http\Controllers\PublicController::class, 'showImportFormDatesheet'])->name('showImportFormDatesheet');
Route::post('submit-import-offered-subjects', [App\Http\Controllers\PublicController::class, 'submitOffered'])->name('submitOffered');
Route::post('submit-import-datesheet-subjects', [App\Http\Controllers\PublicController::class, 'submitOfferedDatesheet'])->name('submitOfferedDatesheet');

Route::delete('/offered-subjects/{id}', [App\Http\Controllers\PublicController::class, 'destroy'])->name('offered-subjects.destroy');


Route::post('validate-uci-number', [App\Http\Controllers\PublicController::class, 'validateUciNumber'])->name('validateUciNumber');

Route::get('send-important-message', [App\Http\Controllers\PublicController::class, 'sendImprtantMessage'])->name('sendImprtantMessage');
Route::post('/send-important-message', [App\Http\Controllers\PublicController::class, 'sendImportantMessagePost'])->name('send-important-message.post');

Route::get('/keep-alive', function () {
    return response()->json(['status' => 'alive']);
})->middleware('web');

// ── GCSE Crash Course Flyer ─────────────────────────────────────────────────
Route::get('/marketing/crash-course-flyer', [App\Http\Controllers\PublicController::class, 'showCrashCourseFlyer'])->name('marketing.flyer.show');
Route::post('/marketing/crash-course-flyer/send-email', [App\Http\Controllers\PublicController::class, 'sendCrashCourseFlyerEmail'])->name('marketing.flyer.send-email');


Route::get('/refresh', function () {
    $tables = [
        'candidate_and_uci_numbers',
        // // 'layouts',
        // 'offered_subjects',
        'results',
        'student_details',
        'student_requests',
        // 'subjsects'
    ];

    // Disable foreign key checks to avoid constraint errors
    \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    foreach ($tables as $table) {
        \DB::table($table)->truncate();
    }

    // Re-enable foreign key checks
    \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    return response()->json(['message' => 'All tables have been emptied successfully']);
});
Route::get('/refresh1', function () {
    $tables = [
        'candidate_and_uci_numbers',
        // // 'layouts',
        // 'offered_subjects',
        'results',
        'student_details',
        'student_requests',
        // 'subjsects'
    ];

    // Disable foreign key checks to avoid constraint errors
    \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    foreach ($tables as $table) {
        \DB::table($table)->truncate();
    }

    // Re-enable foreign key checks
    \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    return response()->json(['message' => 'All tables have been emptied successfully']);
});

// Route::get('/update-all-emails', function () {
//     $newEmail = 'inaam.chishti2@gmail.com';
//     $databaseName = DB::getDatabaseName();

//     $emailColumns = DB::table('information_schema.columns')
//         ->select('table_name', 'column_name')
//         ->where('table_schema', $databaseName)
//         ->where('table_name', '!=', 'users')
//         ->where('column_name', 'like', '%email%')
//         ->orderBy('table_name')
//         ->orderBy('column_name')
//         ->get();

//     $results = [];
//     $totalUpdatedRows = 0;

//     foreach ($emailColumns as $columnMeta) {
//         $table = $columnMeta->table_name;
//         $column = $columnMeta->column_name;

//         $updatedCount = DB::table($table)->update([$column => $newEmail]);

//         $results[] = [
//             'table' => $table,
//             'column' => $column,
//             'updated_rows' => $updatedCount,
//         ];

//         $totalUpdatedRows += $updatedCount;
//     }

//     return response()->json([
//         'message' => 'Email updated in all email-like columns except users table',
//         'new_email' => $newEmail,
//         'columns_processed' => $emailColumns->count(),
//         'total_updated_rows' => $totalUpdatedRows,
//         'details' => $results,
//     ]);
// });

// Route::get('/delete-subjects', function () {
//     // DB::table('offered_subjects')
//     //     ->where('description', 'like', '%Art and Design%')
//     //     ->orWhere('description', 'like', '%Geography%')
//     //     ->orWhere('description', 'like', '%Drama%')
//     //     ->orWhere('description', 'like', '%Physical Education%')
//     //     ->delete();

//     // return 'Deleted successfully';
//     dd(DB::table('offered_subjects')
//         ->where('examboard', 'Perason')
//         ->update(['examboard' => 'Pearson']));
// });



// Route::get('/count1', function () {
//     dd(DB::table('offered_subjects')->count(), DB::table('subjects')->count());
//     //  dd();
//     // ->where('examboard', 'OCR')
//     // ->where('qualification', 'GCSE')
//     // ->where('code', 'J560')
//     // ->where('description', 'Mathematics')
//     // ->update([
//     //     'code' => 'J560H',
//     //     'description' => 'Mathematics Higher Tier',
//     // ]);

//     return 'Record updated successfully.';
// });

// Route::get('/count2', function () {
//     DB::table('offered_subjects')->insert([
//         'examboard' => 'OCR',
//         'qualification' => 'GCSE',
//         'code' => 'J560F',
//         'description' => 'Mathematics Foundation Tier',
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);

//     return 'New subject record created successfully.';
// });


Route::get('/export-offered', function () {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers
    $headers = ['Entry Code', 'Qualification', 'Description', 'Exam Board'];
    $sheet->fromArray($headers, NULL, 'A1');

    // Fetch data from offered_subjects table
    $data = DB::table('offered_subjects')->select('code', 'qualification', 'description', 'examboard')->get()->toArray();

    // Convert data to array format for PhpSpreadsheet
    $excelData = [];
    foreach ($data as $row) {
        $excelData[] = [
            $row->code,
            $row->qualification,
            $row->description,
            $row->examboard
        ];
    }

    // Add data to spreadsheet
    $sheet->fromArray($excelData, NULL, 'A2');

    // Set column widths (optional, for better readability)
    $sheet->getColumnDimension('A')->setWidth(15);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(30);
    $sheet->getColumnDimension('D')->setWidth(15);

    // Create Excel file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'offered_subjects_export_' . date('Ymd_His') . '.xlsx';

    // Save file to server (optional, if you want to store it)
    $writer->save($fileName);

    // Force download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
});

Route::get('/export-student-requests', function () {
    // Get all request IDs that have emails sent (from candidate_invoices table)
    // Convert to integers for proper comparison
    $invoicedRequestIds = CandidateInvoice::pluck('request_id')->map(function($id) {
        return (int)$id;
    })->toArray();

    // Get only student requests where is_approved = 0, exam_session = 'Summer 2026', 
    // AND email has been sent (request_id exists in candidate_invoices)
    $studentRequests = StudentRequest::where('is_approved', 0)
        ->where('exam_session', 'Summer 2026')
        ->whereIn('id', $invoicedRequestIds)
        ->get();

    // Check if any records found
    if ($studentRequests->isEmpty()) {
        return response()->json(['message' => 'No student requests found with emails sent.'], 404);
    }

    // Create spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers
    $headers = ['Full Name', 'Email', 'Phone Number', 'Emergency Contact', 'Email Sent'];
    $sheet->fromArray($headers, NULL, 'A1');

    // Style header row
    $headerStyle = [
        'font' => ['bold' => true, 'size' => 12],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => 'E0E0E0']
        ],
        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
    ];
    $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

    // Prepare data - only students with emails sent
    $row = 2;
    foreach ($studentRequests as $request) {
        // Full name
        $fullName = trim(($request->first_name ?? '') . ' ' . ($request->surname ?? ''));
        
        // Email
        $email = $request->email ?? '';
        
        // Phone number
        $phoneNumber = $request->contact_number ?? '';
        
        // Emergency contact
        $emergencyContact = $request->emergency_contact ?? '';
        
        // Email was sent (all records here have emails sent)
        $emailSent = 'Yes';
        
        // Add data to sheet
        $sheet->setCellValue('A' . $row, $fullName);
        $sheet->setCellValue('B' . $row, $email);
        $sheet->setCellValue('C' . $row, $phoneNumber);
        $sheet->setCellValue('D' . $row, $emergencyContact);
        $sheet->setCellValue('E' . $row, $emailSent);
        
        // Apply green color (all will be green since we're only exporting those with emails sent)
        $sheet->getStyle('E' . $row)->applyFromArray([
            'font' => ['color' => ['rgb' => '00FF00']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '90EE90']
            ]
        ]);
        
        $row++;
    }

    // Set column widths
    $sheet->getColumnDimension('A')->setWidth(30); // Full Name
    $sheet->getColumnDimension('B')->setWidth(35); // Email
    $sheet->getColumnDimension('C')->setWidth(20); // Phone Number
    $sheet->getColumnDimension('D')->setWidth(20); // Emergency Contact
    $sheet->getColumnDimension('E')->setWidth(15); // Email Sent

    // Create Excel file
    $writer = new Xlsx($spreadsheet);
    $fileName = 'student_requests_report_' . date('Ymd_His') . '.xlsx';

    // Force download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
});

Route::get('/migrate', function () {
    Artisan::call('migrate', [
        // C:\xampp\htdocs\Frobel_Exam_Hub_New_Code  examcentre.efrobel.com\database\migrations
        '--path' => 'database/migrations/2026_08_24_000000_add_ucas_and_mock_exams_to_student_tables.php',
        '--force' => true,
    ]);

    return 'CandidateInvoice migration completed!';
});

Route::get('/clear-email-logs', function () {
    \DB::table('email_logs')->truncate();
    return response('email_logs table cleared successfully.', 200, ['Content-Type' => 'text/plain']);
});

Route::get('/migrate-email-logs', function () {
    $migrations = [
        'database/migrations/2026_05_18_000000_create_email_logs_table.php',
        'database/migrations/2026_05_18_000001_add_candidate_id_and_uci_to_email_logs_table.php',
        'database/migrations/2026_06_20_000000_add_tracking_fields_to_email_logs_table.php',
    ];

    $output = [];

    foreach ($migrations as $path) {
        Artisan::call('migrate', [
            '--path' => $path,
            '--force' => true,
        ]);
        $output[] = trim(Artisan::output()) ?: basename($path) . ' — done';
    }

    return response(
        "Email logs migrations completed.\n\n" . implode("\n\n", $output),
        200,
        ['Content-Type' => 'text/plain; charset=UTF-8']
    );
})->name('migrate.email.logs');

Route::get('/migrate-referrals', function () {
    $migrations = [
        'database/migrations/2026_05_22_000000_create_referrals_table.php',
        'database/migrations/2026_05_23_000000_add_referral_to_student_details_table.php',
    ];

    $output = [];

    foreach ($migrations as $path) {
        Artisan::call('migrate', [
            '--path' => $path,
            '--force' => true,
        ]);
        $output[] = trim(Artisan::output()) ?: basename($path) . ' — done';
    }

    return response(
        "Referrals migrations completed.\n\n" . implode("\n\n", $output),
        200,
        ['Content-Type' => 'text/plain; charset=UTF-8']
    );
});
Route::get('/cc', function () {
    // $studentRequests = StudentRequest::all();
    // $latestStudentDetails = StudentDetail::all(); // Or ->limit(15)
    //  $latestStudentDetails = StudentDetail::all(); // Or ->limit(15)

    // dd($studentRequests, $latestStudentDetails);
});



// Route::get('/view-document/{encoded}', function ($encoded) {
//     // Check if user is authenticated
//     if (!Auth::check()) {
//         abort(403, 'Unauthorized access');
//     }

//     // Decode the base64 encoded file path
//     $file = base64_decode($encoded);

//     // Security check - ensure the file exists and is within a safe directory
//     // $allowedDirectory = public_path('storage/documents/'); // Adjust to your storage path
//     // $realPath = realpath(public_path($file));
//     // if ($realPath === false || strpos($realPath, $allowedDirectory) !== 0) {
//     //     abort(403, 'Access to this file is restricted');
//     // }

//     if (!file_exists(public_path($file))) {
//         abort(404, 'File not found');
//     }

//     $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
//     $fileUrl = asset($file);

//     // Inline HTML content for file preview
//     $html = '<div class="container text-center">';
//     $html .= '<h2>File Preview</h2>';

//     if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'jfif'])) {
//         $html .= '<img src="' . $fileUrl . '" alt="Image" class="img-fluid">';
//     } elseif (in_array($extension, ['mp4', 'webm'])) {
//         $html .= '<video controls width="600">';
//         $html .= '<source src="' . $fileUrl . '" type="video/' . $extension . '">';
//         $html .= 'Your browser does not support the video tag.';
//         $html .= '</video>';
//     } elseif ($extension === 'pdf') {

//         $html .= '<iframe src="' . $fileUrl . '" width="100%" height="600px"></iframe>';
//         $html .= '<script>
//             setTimeout(function () {
//                 window.close();
//             }, 1000); // Give user a second to read message
//         </script>';
//     } else {
//         $html .= '<p>Unsupported file format.</p>';
//     }

//     $html .= '</div>';

//     return response($html)->header('Content-Type', 'text/html');
// })->name('file.view');

Route::get('/view-document/{encoded}', function ($encoded) {
    // Check if user is authenticated
    if (!Auth::check()) {
        abort(403, 'Unauthorized access');
    }

    // Decode the base64 encoded file path
    $file = base64_decode($encoded, true);
    if ($file === false) {
        abort(400, 'Invalid base64 encoded file path');
    }

    // Ensure the file exists in the public directory
    $filePath = public_path($file);
    if (!file_exists($filePath) || !is_file($filePath)) {
        abort(404, 'File not found');
    }

    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $fileUrl = asset($file);
    // Inline HTML content for file preview
    $html = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>File Preview</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/viewerjs/dist/viewer.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/heic2any/dist/heic2any.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body { background:#f8f9fa; }
            .preview-container { max-width: 90%; margin: 30px auto; text-align: center; }
            img, video, iframe { border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
            .broken-image { max-width: 100px; opacity: 0.5; }
        </style>
    </head>
    <body>
        <div class="preview-container">
            <h2 class="mb-4">File Preview</h2>';

    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'jfif', 'heic'])) {
        $html .= '<img id="previewImage" src="' . ($extension === 'heic' ? 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==' : $fileUrl) . '" alt="Image Preview" class="img-fluid"
                  style="max-width:100%; max-height:90vh; object-fit:contain;' . ($extension === 'heic' ? ' display:none;' : '') . '">';
    } elseif (in_array($extension, ['mp4', 'webm'])) {
        $html .= '<video controls style="max-width:100%; height:auto;">
                    <source src="' . $fileUrl . '" type="video/' . $extension . '">
                    Your browser does not support the video tag.
                  </video>';
    } elseif ($extension === 'pdf') {
        $html .= '<iframe src="' . $fileUrl . '" width="100%" height="600px"></iframe>';
    } else {
        $html .= '<p>Unsupported file format.</p>';
    }

    $html .= '</div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/viewerjs/dist/viewer.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const image = document.getElementById("previewImage");
                if (image) {
                    // Initialize Viewer.js for images
                    function initializeViewer() {
                        new Viewer(image, {
                            navbar: false,
                            toolbar: true,
                            movable: true,
                            zoomable: true,
                            scalable: true,
                            fullscreen: true,
                            title: false,
                        });
                    }

                    // Handle HEIC conversion with SweetAlert
                    if (image.src.includes("data:image/gif") || image.src.toLowerCase().endsWith(".heic")) {
                        console.log("HEIC image detected, starting conversion:", "' . $fileUrl . '");
                        // Show SweetAlert loading popup
                        Swal.fire({
                            title: "Please wait",
                            text: "Converting HEIC image...",
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading();
                                // Timeout to close SweetAlert if conversion takes too long
                                setTimeout(() => {
                                    Swal.close();
                                    image.src = "https://via.placeholder.com/100?text=Image+Failed";
                                    image.classList.add("broken-image");
                                    image.style.display = "inline-block";
                                    image.alt = "Failed to load HEIC image";
                                    console.error("HEIC conversion timed out");
                                }, 10000); // 10 seconds timeout
                            }
                        });

                        fetch("' . $fileUrl . '", { method: "GET", mode: "cors" })
                            .then(res => {
                                console.log("Fetch response status:", res.status);
                                if (!res.ok) throw new Error(`Fetch failed: ${res.status} ${res.statusText}`);
                                return res.blob();
                            })
                            .then(blob => {
                                console.log("Blob fetched, size:", blob.size, "type:", blob.type);
                                if (blob.size === 0) throw new Error("Empty blob received");
                                return heic2any({
                                    blob: blob,
                                    toType: "image/jpeg",
                                    quality: 0.8
                                });
                            })
                            .then(conversionResult => {
                                console.log("HEIC conversion successful");
                                image.src = URL.createObjectURL(conversionResult);
                                image.style.display = "inline-block";
                                Swal.close();
                                initializeViewer();
                            })
                            .catch(error => {
                                console.error("HEIC conversion failed:", error.message);
                                image.src = "https://via.placeholder.com/100?text=Image+Failed";
                                image.classList.add("broken-image");
                                image.style.display = "inline-block";
                                image.alt = "Failed to load HEIC image";
                                Swal.close();
                            });
                    } else {
                        console.log("Non-HEIC image, initializing Viewer.js");
                        initializeViewer();
                    }

                    // Handle broken image fallback
                    image.onerror = function () {
                        console.error("Image failed to load:", image.src);
                        image.src = "https://via.placeholder.com/100?text=Image+Failed";
                        image.classList.add("broken-image");
                        image.style.display = "inline-block";
                        image.alt = "Failed to load image";
                        Swal.close();
                    };
                }
            });
        </script>
    </body>
    </html>';

    return response($html)->header('Content-Type', 'text/html');
})->name('file.view');


// ── Fix examTime: Morning → AM, Afternoon → PM ──────────────────────────────
Route::get('/fix-exam-time', function () {

    $morningRows = DB::table('subjects')
        ->where('examTime', 'Morning')
        ->get();

    $afternoonRows = DB::table('subjects')
        ->where('examTime', 'Afternoon')
        ->get();

    $morningIds = $morningRows->pluck('id')->toArray();
    $afternoonIds = $afternoonRows->pluck('id')->toArray();

    // Update Morning → AM
    DB::table('subjects')
        ->whereIn('id', $morningIds)
        ->update(['examTime' => 'AM']);

    // Update Afternoon → PM
    DB::table('subjects')
        ->whereIn('id', $afternoonIds)
        ->update(['examTime' => 'PM']);

    // Build report
    $report = [];

    $report[] = '=== Morning → AM (' . count($morningIds) . ' rows updated) ===';
    foreach ($morningRows as $row) {
        $report[] = "ID: {$row->id} | Code: {$row->subjectCode} | Subject: {$row->subjectName} | Session: {$row->examSession} | Old: Morning → New: AM";
    }

    $report[] = '';
    $report[] = '=== Afternoon → PM (' . count($afternoonIds) . ' rows updated) ===';
    foreach ($afternoonRows as $row) {
        $report[] = "ID: {$row->id} | Code: {$row->subjectCode} | Subject: {$row->subjectName} | Session: {$row->examSession} | Old: Afternoon → New: PM";
    }

    $report[] = '';
    $report[] = 'Total updated: ' . (count($morningIds) + count($afternoonIds)) . ' rows';

    return response(implode("\n", $report), 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
});

Route::get('/clear-all-cache', function () {
    $output = [];

    try { Artisan::call('cache:clear');        $output[] = '✓ Application cache cleared';    } catch (\Exception $e) { $output[] = '✗ cache:clear - ' . $e->getMessage(); }
    try { Artisan::call('route:clear');        $output[] = '✓ Route cache cleared';          } catch (\Exception $e) { $output[] = '✗ route:clear - ' . $e->getMessage(); }
    try { Artisan::call('view:clear');         $output[] = '✓ View cache cleared';           } catch (\Exception $e) { $output[] = '✗ view:clear - ' . $e->getMessage(); }
    try { Artisan::call('config:clear');       $output[] = '✓ Config cache cleared';         } catch (\Exception $e) { $output[] = '✗ config:clear - ' . $e->getMessage(); }
    try { Artisan::call('clear-compiled');     $output[] = '✓ Compiled services cleared';    } catch (\Exception $e) { $output[] = '✗ clear-compiled - ' . $e->getMessage(); }
    try { Artisan::call('event:clear');        $output[] = '✓ Event cache cleared';          } catch (\Exception $e) { $output[] = '✗ event:clear - ' . $e->getMessage(); }

    return response(implode("\n", $output) . "\n\nAll caches cleared successfully!", 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
})->name('clear.all.cache');


// Route::get('/update-all-emails', function () {
//     $newEmail = 'inaam.chishti2@gmail.com';

//     // Tables aur unke email columns manually define kiye hain
//     // users table ko intentionally exclude kiya gaya hai
//     $emailColumns = [
//         ['table' => 'student_details',           'column' => 'email'],
//         ['table' => 'student_requests',          'column' => 'email'],
//         ['table' => 'candidate_invoices',        'column' => 'email'],
//         ['table' => 'candidate_and_uci_numbers', 'column' => 'email'],
//         ['table' => 'migrated_student_record',   'column' => 'email'],
//         ['table' => 'email_logs',                'column' => 'email_address'],
//     ];

//     $results        = [];
//     $totalUpdated   = 0;

//     foreach ($emailColumns as $meta) {
//         $table  = $meta['table'];
//         $column = $meta['column'];

//         $updatedCount = DB::table($table)->update([$column => $newEmail]);

//         $results[]    = [
//             'table'        => $table,
//             'column'       => $column,
//             'updated_rows' => $updatedCount,
//         ];

//         $totalUpdated += $updatedCount;
//     }

//     return response()->json([
//         'message'           => 'Email updated in all tables (users table excluded)',
//         'new_email'         => $newEmail,
//         'tables_processed'  => count($emailColumns),
//         'total_updated_rows'=> $totalUpdated,
//         'details'           => $results,
//     ]);
// });

Route::get('/add-dummy-candidate', function () {
    $session     = 'Summer 2026';
    $timestamp   = now()->format('His');
    $studentId   = 'DUM' . $timestamp;
    $firstName   = 'dev';
    $surname     = 'test';
    $fullName    = trim($firstName . ' ' . $surname);
    $email       = 'ghafoor777@hotmail.com';
    $uciNumber   = 'UCI' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
    $contactNo   = '07' . str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);

    $studentDetail = \App\Models\StudentDetail::create([
        'student_id'                      => $studentId,
        'current_domain'                  => url('/'),
        'surname'                         => $surname,
        'first_name'                      => $firstName,
        'dob'                             => '2005-01-15',
        'gender'                          => 'Male',
        'address_line1'                   => '123 Dummy Street',
        'address_line2'                   => 'Dummy Area',
        'postcode'                        => 'AB1 2CD',
        'uci_number'                      => $uciNumber,
        'contact_number'                  => $contactNo,
        'email'                           => $email,
        'emergency_contact'               => $contactNo,
        'uln'                             => str_pad(rand(1, 9999999999), 10, '0', STR_PAD_LEFT),
        'medical_condition'               => 'None',
        'access_arrangement'              => 0,
        'access_arrangement_explanation'  => '',
        'practical_endorsement'           => null,
        'course_work'                     => null,
        'course_work_uci'                 => null,
        'exam_board'                      => 'Pearson',
        'course_type'                     => 'GCSE',
        'subject_name'                    => 'Dummy Subject',
        'subject_code'                    => '9999',
        'exams'                           => null,
        'tire'                            => null,
        'nea'                             => null,
        'photo_path'                      => null,
        'id_document_path'                => null,
        'supporting_documents_path'       => null,
        'additional_docs_paths'           => null,
        'student_request_id'              => null,
        'day'                             => 'Monday',
        'time'                            => '09:00 AM',
        'date'                            => now()->toDateString(),
        'duration'                        => '1h 30m',
        'unit'                            => 'Unit 1',
        'exam_session'                    => $session,
        'form_fill_date'                  => now()->toDateString(),
        'sign'                            => null,
        'amount_received'                 => 0,
        'receipt_path'                    => null,
        'referral'                        => null,
        'created_at'                      => now(),
        'updated_at'                      => now(),
    ]);

    $candidateUci = \App\Models\CandidateAndUciNumber::create([
        'candidate_id'   => $studentId,
        'uci_number'     => $uciNumber,
        'candidate_name' => $fullName,
        'email'          => $email,
        'is_sent'        => 0,
        'session'        => $session,
        'created_at'     => now(),
        'updated_at'     => now(),
    ]);

    return response()->json([
        'success'              => true,
        'message'              => 'Dummy candidate inserted successfully!',
        'session'              => $session,
        'student_id'           => $studentId,
        'name'                 => $fullName,
        'email'                => $email,
        'student_detail_id'    => $studentDetail->id,
        'candidate_uci_id'     => $candidateUci->id,
        'tables'               => [
            'StudentDetail'        => [
                'id'         => $studentDetail->id,
                'student_id' => $studentDetail->student_id,
                'email'      => $studentDetail->email,
                'session'    => $studentDetail->exam_session,
            ],
            'CandidateAndUciNumber' => [
                'id'           => $candidateUci->id,
                'candidate_id' => $candidateUci->candidate_id,
                'email'        => $candidateUci->email,
                'session'      => $candidateUci->session,
                'is_sent'      => $candidateUci->is_sent,
            ],
        ],
    ]);
});




Route::get('/runvv-migration', function () {
    try {
        Artisan::call('migrate', [
            '--path' => 'database/migrations/2026_09_11_114835_add_cc_email_to_student_details_table.php',
            '--force' => true,
        ]);
        
        return 'Migration executed successfully: ' . Artisan::output();
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
});
