<!DOCTYPE html>
<html>

<head>
    <title>Pengesahan Pendaftaran</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Terima Kasih, {{ $submission->applicant_name }}!</h2>

    <p>Pendaftaran anda untuk <strong>{{ ucfirst(str_replace('_', ' ', $submission->form_type)) }}</strong> telah
        berjaya diterima.</p>

    <p>Bersama e-mel ini, kami lampirkan resit pendaftaran anda dalam format PDF untuk rujukan anda.</p>

    <p>Status pendaftaran anda kini adalah: <strong>{{ ucfirst($submission->status) }}</strong>.</p>

    <p>Jika anda mempunyai sebarang pertanyaan, sila balas e-mel ini.</p>

    <hr>
    <p style="font-size: 12px; color: #777;">&copy; {{ date('Y') }} Cahaya Ad Din via Sistem Pendaftaran.</p>
</body>

</html>
