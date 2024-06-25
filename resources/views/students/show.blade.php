@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $student->nama }}</h1>
    <p><strong>School:</strong> {{ $student->sekolah }}</p>
    <p><strong>Date of Birth:</strong> {{ $student->tanggal_lahir }}</p>
    <p><strong>Start Date:</strong> {{ $student->tanggal_mulai }}</p>
    <p><strong>Class Schedule:</strong> {{ $student->jadwal_kelas }}</p>
    <p><strong>Level:</strong> {{ $student->level }}</p>
    <p><strong>Phone Number:</strong> {{ $student->no_hp }}</p>
    <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection