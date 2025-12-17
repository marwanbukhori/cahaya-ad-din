<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Submission #{{ $submission->id }}</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Cahaya Ad Din</h1>
        <p>Registration Receipt</p>
    </div>

    <table class="table">
        <tr>
            <th colspan="2">Submission Details</th>
        </tr>
        <tr>
            <td><strong>ID</strong></td>
            <td>#{{ $submission->id }}</td>
        </tr>
        <tr>
            <td><strong>Date</strong></td>
            <td>{{ $submission->created_at->format('d M Y, H:i') }}</td>
        </tr>
        <tr>
            <td><strong>Type</strong></td>
            <td>{{ ucfirst(str_replace('_', ' ', $submission->form_type)) }}</td>
        </tr>
    </table>

    <table class="table">
        <tr>
            <th colspan="2">Applicant Information</th>
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            <td>{{ $submission->applicant_name }}</td>
        </tr>
        <tr>
            <td><strong>IC / ID</strong></td>
            <td>{{ $submission->applicant_ic }}</td>
        </tr>
        <tr>
            <td><strong>Phone</strong></td>
            <td>{{ $submission->phone }}</td>
        </tr>
        <tr>
            <td><strong>Address</strong></td>
            <td>{{ $submission->address }}</td>
        </tr>
    </table>

    @if ($submission->participant_name || $submission->quantity)
        <table class="table">
            <tr>
                <th colspan="2">Service Details</th>
            </tr>
            @if ($submission->participant_name)
                <tr>
                    <td><strong>Participant Name</strong></td>
                    <td>{{ $submission->participant_name }}</td>
                </tr>
            @endif
            @if ($submission->participant_ic)
                <tr>
                    <td><strong>Participant IC</strong></td>
                    <td>{{ $submission->participant_ic }}</td>
                </tr>
            @endif
            @if ($submission->relationship)
                <tr>
                    <td><strong>Relationship</strong></td>
                    <td>{{ $submission->relationship }}</td>
                </tr>
            @endif
            @if ($submission->package_type)
                <tr>
                    <td><strong>Package</strong></td>
                    <td>{{ $submission->package_type }}</td>
                </tr>
            @endif
            @if ($submission->animal_type)
                <tr>
                    <td><strong>Animal</strong></td>
                    <td>{{ ucfirst(str_replace('_', ' ', $submission->animal_type)) }}</td>
                </tr>
            @endif
            @if ($submission->quantity)
                <tr>
                    <td><strong>Quantity</strong></td>
                    <td>{{ $submission->quantity }}</td>
                </tr>
            @endif
            @if ($submission->notes)
                <tr>
                    <td><strong>Notes</strong></td>
                    <td>{{ $submission->notes }}</td>
                </tr>
            @endif
        </table>
    @endif

    <div class="footer">
        Generated on {{ now()->format('d M Y H:i:s') }}
    </div>
</body>

</html>
